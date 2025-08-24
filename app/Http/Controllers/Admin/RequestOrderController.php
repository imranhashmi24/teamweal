<?php
namespace App\Http\Controllers\Admin;

use App\Models\RequestOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestOrderController extends Controller
{
    // List all orders
    public function index(Request $request)
    {   
        $search = $request->search;
        $type = $request->type;
        $orders = RequestOrder::where('type', $type)->where('form_data', 'like', '%' . $search . '%')->latest()->paginate(10);
        return view('admin.request_orders.index', compact('orders'));
    }

    // Show single order
    public function show($id)
    {
        $order = RequestOrder::findOrFail($id);
        return view('admin.request_orders.show', compact('order'));
    }

    // Update status
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $order = RequestOrder::findOrFail($id);
        $order->update(['status' => $request->status]);

        $notify[] = ['success', 'Status updated successfully'];

        return to_route('admin.request_order.index', ['type' => $order->type])->withNotify($notify);
    }

    // Delete order
    public function destroy($id)
    {
        $order = RequestOrder::findOrFail($id);

        if($order->form_file){
            foreach(json_decode($order->form_file, true) ?? [] as $key => $files){  
                foreach($files as $file){
                    if(file_exists(public_path($file))){
                        unlink(public_path($file));
                    }
                }
            }
        }

        $order->delete();

        $notify[] = ['success', 'Order deleted successfully'];

        return to_route('admin.request_order.index', ['type' => $order->type])->withNotify($notify);
    }
}
