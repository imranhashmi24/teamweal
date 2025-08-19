<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::searchable(['title', 'status'])->paginate(getPaginate());
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $title = 'Create Blog';
        return view('admin.blog.create', compact('title'));
    }

    public function store(Request $request, $id = null)
    {
        $validation = 'required';

        if ($id) {
            $validation = 'nullable';
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug,' . $id,
            'description' => 'required',
            'image' => [$validation, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($id) {
            $blog = Blog::findOrFail($id);
            $message = 'Blog update successfully';
        } else {
            $blog = new Blog();
            $message = 'Blog create successfully';
        }

        $blog->title = $request->title;
        $blog->title_ar = $request->title_ar;
        $blog->slug = $request->slug;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->description = $request->description;
        $blog->description_ar = $request->description_ar;

        if ($request->hasFile('image')) {
            try {
                $old = $blog->image;
                $blog->image = fileUploader($request->image, getFilePath('blog'), getFileSize('blog'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $blog->save();

        $notify[] = ['success', $message];
        return to_route('admin.blog.index')->withNotify($notify);

    }

    public function edit($id)
    {
        $title = 'Edit blog';
        $blog = Blog::findOrFail($id);
        return view('admin.blog.create', compact('blog', 'title'));
    }

    public function status($id)
    {
        return Blog::changeStatus($id);
    }
    
    public function delete($id)
    {
        $message = 'Successfully Deleted';
        $blog = Blog::findOrFail($id);
        $blog->delete();

        $notify[] = ['success', $message];
        return to_route('admin.blog.index')->withNotify($notify);
    }
    
    
}
