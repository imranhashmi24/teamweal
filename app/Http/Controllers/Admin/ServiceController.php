<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['services'] = Service::query()
            ->searchable(['title', 'title_ar', 'description', 'description_ar', 'category:title'])
            ->latest()
            ->when(request()->filled('q'), function (Builder $query) {

                $q = '%' . request('q') . '%';
                $query->where('title', 'LIKE', $q);
                $query->orWhere('title_ar', 'LIKE', $q);
                $query->orWhere('description', 'LIKE', $q);
                $query->orWhere('description_ar', 'LIKE', $q);
            })
            ->when(request()->filled('category_id'), function (Builder $query) {
                $query->where('category_id', request('category_id'));
            })
            ->paginate(20);
        return view('admin.service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.service.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|string|unique:services,title',
            'title_ar' => 'nullable|string',
            'image' => 'nullable|image',
            'sequence' => 'nullable',
            // 'description' => 'nullable',
            // 'description_ar' => 'nullable',
            // 'vendor_name' => 'required|string|max:100',
            // 'vendor_name_ar' => 'required|string|max:100',
            // 'store_name' => 'required|string|max:100',
            // 'store_name_ar' => 'required|string|max:100',
            // 'address' => 'required|string|max:1000',
            // 'address_ar' => 'required|string|max:1000',
            // 'website' => 'required|string|max:100',
        ]);

        $service = Service::create($request->all());
        $service->slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            try {
                $old = $service->image;
                $service->image = fileUploader($request->image, getFilePath('service'), getFileSize('service'), $old);
                $service->save();
            } catch (\Exception $e) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $service->save();

        $notify[] = ['success', 'Service has been added!'];
        return back()->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $service =  Service::where('slug', $slug)->firstOrFail();
        return view('admin.service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::latest()->get();
        $service = Service::findOrFail($id);
        return view('admin.service.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|string',
            'title_ar' => 'nullable|string',

        ]);

        $service = Service::findOrFail($id);

        $service->update($request->except('image'));

        if ($request->hasFile('image')) {
            try {
                $old = $service->image;
                $service->image = fileUploader($request->image, getFilePath('service'), getFileSize('service'), $old);
                $service->save();
            } catch (\Exception $e) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $notify[] = ['success', 'Service has been updated!'];
        return redirect()->route('admin.service.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            unlink(public_path(getFilePath('service') . $service->image));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $service->delete();

        $notify[] = ['success', 'Service has been deleted!'];
        return back()->withNotify($notify);
    }
}
