<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::searchable(['title'])->paginate(getPaginate(10));
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
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
            'title' => 'required|string|max:100',
            'title_en' => 'nullable|string|max:100',
            'url' => 'nullable|starts_with:http,https',
            'image' => 'required|image|max:1024',
            'description' => 'nullable|string|max:500',
            'description_ar' => 'nullable|string|max:500',
        ]);

        $project = new Project($request->except('image'));

        if ($request->hasFile('image')) {
            try {
                $old = $project->image;
                $project->image = fileUploader($request->image, getFilePath('project'), getFileSize('project'), $old);
                $project->save();
            } catch (\Exception $e) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $project->save();

        $notify[] = ['success', 'Project has been added!'];
        return back()->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'title_en' => 'nullable|string|max:100',
            'url' => 'nullable|starts_with:http,https',
            'image' => 'nullable|image|max:1024',
            'description' => 'nullable|string|max:500',
            'description_ar' => 'nullable|string|max:500',
        ]);

        $project = Project::findOrFail($id);

        $project->update($request->except('image'));

        if ($request->hasFile('image')) {
            try {
                $old = $project->image;
                $project->image = fileUploader($request->image, getFilePath('project'), getFileSize('project'), $old);
                $project->save();
            } catch (\Exception $e) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $notify[] = ['success', 'Project has been updated!'];
        return back()->withNotify($notify);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        try {
            unlink(public_path(getFilePath('project') . '/' . $project->image));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $project->delete();

        $notify[] = ['success', 'Project has been deleted.'];
        return back()->withNotify($notify);
    }
}
