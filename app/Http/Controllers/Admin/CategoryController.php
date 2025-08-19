<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->latest()
            ->when(request()->filled('q'), function (Builder $query) {
                $q = '%' . request('q') . '%';
                $query->where('name', 'LIKE', $q);
                $query->orWhere('name_ar', 'LIKE', $q);
            })
            ->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'name_ar' => 'nullable|string',
            'image' => 'required|image|max:1024',
        ]);

        $category = Category::create($request->all());

        if ($request->hasFile('image')) {
            $photo_name = time() . rand(1, 100) . '.' . $request->image->extension();
            $request->image->move(public_path(getFilePath('category') . '/'), $photo_name);
            $category->image = $photo_name;
            $category->save();
        }

        $notify[] = ['success', 'Category has been added!'];
        return back()->withNotify($notify);

    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($request->get('update_featured')) {

            $category->update([
                'is_featured' => !$category->is_featured
            ]);

            $notify[] = ['success', 'Featured status has been updated'];
            return back()->withNotify($notify);
        }

        // return $request->all();
        $request->validate([
            'name' => 'required|string',
            'name_ar' => 'nullable|string',
            'image' => 'nullable|image|max:1024',
        ]);

        $category->update($request->all());

        if ($request->hasFile('image')) {
            try {
                unlink(public_path(getFilePath('category') . '/' . $category->image));
            } catch (\Throwable $th) {
                //throw $th;
            }
            $photo_name = time() . rand(1, 100) . '.' . $request->image->extension();
            $request->image->move(public_path(getFilePath('category') . '/'), $photo_name);
            $category->image = $photo_name;
            $category->save();
        }

        $notify[] = ['success', 'Category has been updated!'];
        return back()->withNotify($notify);
    }

    /**
     * Deletes a category and its associated image.
     *
     * @param int $id The ID of the category to delete.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the category with the given ID is not found.
     * @return \Illuminate\Http\RedirectResponse A redirect response back to the previous page with a success notification.
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            unlink(public_path(getFilePath('category') . '/' . $category->image));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $category->delete();

        $notify[] = ['success', 'Category has been deleted!'];
        return back()->withNotify($notify);

    }
}
