<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OurServiceList;
use App\Http\Controllers\Controller;

class OurServiceListController extends Controller
{
    public function index(Request $request, $service_id)
    {
        $our_service_lists = OurServiceList::where('our_service_id', $service_id)->searchable(request()->search, OurServiceList::$searchable)->latest()->paginate(10);
        return view('admin.our_service.lists.index', compact('our_service_lists', 'service_id'));
    }

    public function create($service_id)
    {
        return view('admin.our_service.lists.create', compact('service_id'));
    }

    public function store(Request $request, $service_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        OurServiceList::create([
            'our_service_id' => $service_id,
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'status' => $request->status,
        ]);

        $notify[] = ['success', __('Our Service List created successfully')];

        return redirect()->route('admin.our_service.lists.index', $service_id)->withNotify($notify);
    }

    public function edit($service_id, $id)
    {
        $our_service_list = OurServiceList::where('our_service_id', $service_id)->where('id', $id)->first();
        return view('admin.our_service.lists.edit', compact('our_service_list', 'service_id'));
    }

    public function update(Request $request, $service_id, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $our_service_list = OurServiceList::where('our_service_id', $service_id)->where('id', $id)->first();

        $our_service_list->update([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'status' => $request->status,
        ]);

        $notify[] = ['success', __('Our Service List updated successfully')];

        return redirect()->route('admin.our_service.lists.index', $service_id)->withNotify($notify);
    }

    public function destroy($service_id, $id)
    {
        $our_service_list = OurServiceList::where('our_service_id', $service_id)->where('id', $id)->first();
        $our_service_list->delete();

        $notify[] = ['success', __('Our Service List deleted successfully')];

        return redirect()->route('admin.our_service.lists.index', $service_id)->withNotify($notify);
    }
}
