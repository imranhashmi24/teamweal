<?php

namespace App\Http\Controllers\Admin;

use App\Models\AllCategory;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

class AllCategoryController extends Controller
{
    public function index()
    {
        $all_categories = AllCategory::searchable(['title','title_ar'])->paginate(getPaginate());
        return view('admin.all_category.index', compact('all_categories'));
    }

    public function create()
    {
        $title = __('Create new category');

        return view('admin.all_category.create', compact('title'));
    }

    public function store(Request $request, $id = null)
    {
        $validation = 'required';

        if ($id) {
            $validation = 'nullable';
        }

        $request->validate([
            'type'  => 'required',
            'title' => 'required|string',
            'title_ar' => 'required|string',
            'image' => [$validation, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($id) {
            $all_category = AllCategory::findOrFail($id);
            $message = 'Category update successfully';
        } else {
            $all_category = new AllCategory();
            $message = 'Category create successfully';
        }

        $all_category->type = $request->type;
        $all_category->title = $request->title;
        $all_category->title_ar = $request->title_ar;

        if ($request->hasFile('image')) {
            try {
                $old = $all_category->image;
                $all_category->image = fileUploader($request->image, getFilePath('all_category'), getFileSize('all_category'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $all_category->save();

        $notify[] = ['success', $message];
        return to_route('admin.all_category.index')->withNotify($notify);

    }

    public function edit($id)
    {
        $title = 'Edit Category';
        $all_category = AllCategory::findOrFail($id);
        return view('admin.all_category.create', compact('all_category', 'title'));
    }
}
