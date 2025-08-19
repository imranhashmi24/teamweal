<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;

use App\Models\Mail\MailCategory;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if($request->type)
        {
            $data['categories'] = MailCategory::where('type', $request->type)->get();
        }
        else{
            $data['categories'] = MailCategory::where('type','EMAIL')->get();
        }

         return view('mail_vendor.categories.index',$data);
    }

    public function create()
    {
        return view('mail_vendor.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        MailCategory::create($request->except('_token'));

        return redirect()->route('admin.category.index');
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['category'] = MailCategory::find($id);
        return view('mail_vendor.categories.edit',$data);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
         ]);

        $category = MailCategory::find($id);
        $category->update($request->except('_token'));

        return redirect()->route('admin.category.index');
    }


    public function destroy(string $id)
    {
        $category = MailCategory::find($id);
        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
