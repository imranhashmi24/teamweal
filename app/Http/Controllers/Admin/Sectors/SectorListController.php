<?php

namespace App\Http\Controllers\Admin\Sectors;

use Illuminate\Http\Request;
use App\Models\SectorList;
use App\Http\Controllers\Controller;

class SectorListController extends Controller
{

    public $model = SectorList::class;
    public $searchable = ['title', 'title_ar'];
    public $view = "admin.sectors.lists";
    public $route = "admin.sectors.lists";
    public $redirect = "admin.sectors.lists";
    public $notify = "Sector List";

    public function index(Request $request, $service_id)
    {
        $datas= $this->model::where('service_id', $service_id)->searchable(request()->search, $this->searchable)->latest()->paginate(10);
        $route = $this->route;
        $title = $this->notify;
        return view($this->view . '.index', compact('datas', 'service_id', 'route', 'title'));
    }

    public function create($service_id)
    {
        $route = $this->route;
        $title = $this->notify;
        return view($this->view . '.create', compact('service_id', 'route', 'title'));
    }

    public function store(Request $request, $service_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $this->model::create([
            'service_id' => $service_id,
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'status' => $request->status,
        ]);

        $notify[] = ['success', $this->notify . ' created successfully'];

        return redirect()->route($this->route . '.index', $service_id)->withNotify($notify);
    }

    public function edit($service_id, $id)
    {
        $data = $this->model::where('service_id', $service_id)->where('id', $id)->first();
        $route = $this->route;
        $title = $this->notify;
        return view($this->view . '.edit', compact('data', 'service_id', 'route', 'title'));
    }

    public function update(Request $request, $service_id, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $data = $this->model::where('service_id', $service_id)->where('id', $id)->first();

        $data->update([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'status' => $request->status,
        ]);

        $notify[] = ['success', $this->notify . ' updated successfully'];

        return redirect()->route($this->route . '.index', $service_id)->withNotify($notify);
    }

    public function destroy($service_id, $id)
    {
        $data = $this->model::where('service_id', $service_id)->where('id', $id)->first();
        $data->delete();

        $notify[] = ['success', $this->notify . ' deleted successfully'];

        return redirect()->route($this->route . '.index', $service_id)->withNotify($notify);
    }
}
