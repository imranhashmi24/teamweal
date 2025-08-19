<?php

namespace App\Http\Controllers\Admin;

use App\Models\PreviousWork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class PreviousWorkController extends Controller
{
    public function index()
    {
        $previous_works = PreviousWork::query()
            ->latest()
            ->searchable(['title', 'title_ar'])
            ->when(request()->filled('q'), function (Builder $query) {
                $q = '%' . request('q') . '%';
                $query->where('title', 'LIKE', $q);
                $query->orWhere('title_ar', 'LIKE', $q);
            })
            ->paginate();
        return view('admin.previous-works.index', compact('previous_works'));
    }

    public function create()
    {
        return view('admin.previous-works.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:previous_works,title',
            'title_ar' => 'nullable|string',
            'image' => 'nullable|image|max:1024',
        ]);

        $previous_work = PreviousWork::create($request->all());

        if ($request->hasFile('image')) {
            try {
                $old = $previous_work->image;
                $previous_work->image = fileUploader($request->image, getFilePath('previous_work'), getFileSize('previous_work'), $old);
                $previous_work->save();
            } catch (\Exception $e) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $notify[] = ['success', 'PreviousWork has been added!'];
        return back()->withNotify($notify);

    }

    public function show($id)
    {
        $previous_work = PreviousWork::findOrFail($id);
        return view('admin.previous-works.show', compact('previous_work'));
    }

    public function edit($id)
    {
        $previous_work = PreviousWork::findOrFail($id);
        return view('admin.previous-works.edit', compact('previous_work'));
    }

    public function update(Request $request, $id)
    {
        $previous_work = PreviousWork::findOrFail($id);

        $request->validate([
            'title' => 'required|string|unique:previous_works,title,' . $previous_work->id,
            'title_ar' => 'nullable|string',
            'image' => 'nullable|image|max:1024',
        ]);


        $previous_work->update($request->all());

        if ($request->hasFile('image')) {
            try {
                $old = $previous_work->image;
                $previous_work->image = fileUploader($request->image, getFilePath('previous_work'), getFileSize('previous_work'), $old);
                $previous_work->save();
            } catch (\Exception $e) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $notify[] = ['success', 'PreviousWork has been updated!'];
        return back()->withNotify($notify);
    }

    public function destroy($id)
    {
        $previous_work = PreviousWork::findOrFail($id);
        try {
            unlink(public_path(getFilePath('previous_work') . '/' . $previous_work->image));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $previous_work->delete();

        $notify[] = ['success', 'PreviousWork has been deleted!'];
        return back()->withNotify($notify);
    }
}
