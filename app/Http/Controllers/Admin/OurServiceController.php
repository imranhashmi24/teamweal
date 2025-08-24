<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurService;

class OurServiceController extends Controller
{

    public function index()
    {
        $our_services = OurService::searchable(request()->search, OurService::$searchable)->latest()->paginate(10);
        return view('admin.our_service.index', compact('our_services'));
    }

    public function create()
    {
        return view('admin.our_service.create');
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


        $our_service = OurService::create([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ]);


        if ($request->hasFile('image')) {
            $our_service->update([
                'image' => fileUploader($request->image, getFilePath('our_service')),
            ]);
        }


        $notify[] = ['success', __('Our Service created successfully')];

        return redirect()->route('admin.our_service.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $our_service = OurService::findOrFail($id);
        return view('admin.our_service.edit', compact('our_service'));
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

        $our_service = OurService::findOrFail($id);

        $our_service->update([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ]);


        if ($request->hasFile('image')) {
            $our_service->update([
                'image' => fileUploader($request->image, getFilePath('our_service')),
            ]);
        }


        $notify[] = ['success', __('Our Service updated successfully')];

        return redirect()->route('admin.our_service.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $our_service = OurService::findOrFail($id);

        if ($our_service->image) {
            fileDeleter($our_service->image, getFilePath('our_service'));
        }

        
        $our_service->delete();

        $notify[] = ['success', __('Our Service deleted successfully')];

        return redirect()->route('admin.our_service.index')->withNotify($notify);
    }
}
