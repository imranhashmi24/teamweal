<?php

namespace App\Http\Controllers\Admin\PrivateSectors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivateSector;

class PrivateSectorController extends Controller
{

    public $model = PrivateSector::class;
    public $searchable = ['title', 'title_ar'];
    public $view = "admin.private_sectors";
    public $route = "admin.private_sectors";
    public $redirect = "admin.private_sectors";
    public $notify = "Private Sector";
    public $file_path = "private_sector";
    
    public function index()
    {
        $datas = $this->model::searchable(request()->search, $this->searchable)->latest()->paginate(10);
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $emptyMessage = __('No data found');
        $is_list = true;
        $is_form = true;
        return view($this->view . '.index', compact('datas', 'route', 'title', 'file_path', 'emptyMessage', 'is_list', 'is_form'));
    }

    public function create()
    {
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        return view($this->view . '.create', compact('route', 'title', 'file_path'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $this->model::create([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ]);


        if ($request->hasFile('image')) {
            $data->update([
                'image' => fileUploader($request->image, getFilePath($this->file_path)),
            ]);
        }


        $notify[] = ['success', $this->notify . __('created successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        return view($this->view . '.edit', compact('data', 'route', 'title', 'file_path'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $this->model::findOrFail($id);

        $data->update([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ]);


        if ($request->hasFile('image')) {
            $data->update([
                'image' => fileUploader($request->image, getFilePath($this->file_path)),
            ]);
        }


        $notify[] = ['success', $this->notify . __('updated successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $data = $this->model::findOrFail($id);

        if ($data->image) {
            fileDeleter($data->image, getFilePath($this->file_path));
        }

        
        $data->delete();

        $notify[] = ['success', $this->notify . __('deleted successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }
}
