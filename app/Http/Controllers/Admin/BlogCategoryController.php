<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::searchable(['title','title_ar'])->paginate(getPaginate());
        return view('admin.blog_category.index', compact('categories'));
    }


    public function store(Request $request, $id = null)
    {
        $request->validate([
            'title' => 'required|string',
            'title_ar' => 'required|string',
        ]);

        if ($id) {
            $category = BlogCategory::findOrFail($id);
            $message = 'Category updated successfully';
        } else {
            $category = new BlogCategory();
            $message = 'Category created successfully';
        }

        $category->title = $request->title;
        $category->title_ar = $request->title_ar;

        $category->save();

        $notify[] = ['success', $message];

        return back()->withNotify($notify);
    }

}
