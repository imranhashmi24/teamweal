<?php

namespace App\Http\Controllers\Admin;

use App\Models\Authority;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorities = Authority::query()->searchable(['title', 'type', 'title_ar'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.authorities.index', compact('authorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authorities.create');
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
            'type' => ['required'],
            'logo' => ['required', 'image'],
            'title' => ['required', 'string'],
            'title_ar' => ['required', 'string']
        ]);

        $authority = new Authority($request->except('logo'));
        $photo_name = time() . rand(1, 100) . '.' . $request->logo->extension();
        $request->logo->move(public_path(getFilePath('authority') .'/'), $photo_name);
        $authority->logo = $photo_name;
        $authority->save();

        $notify[] = ['success', 'Authority has been added!'];

        return redirect(route('admin.authorities.index'))->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Authority  $authority
     * @return \Illuminate\Http\Response
     */
    public function show(Authority $authority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Authority  $authority
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authority = Authority::find($id);
        return view('admin.authorities.create', compact('authority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Authority  $authority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => ['required'],
            'logo' => ['nullable', 'image'],
            'title' => ['required', 'string'],
            'title_ar' => ['required', 'string']
        ]);


        $authority = Authority::find($id);

        $authority->fill($request->except('logo'));

        if ($request->has('logo')) {
            try {
                unlink(public_path(getFilePath('authority') .'/'. $authority->logo));
            } catch (\Throwable $th) {
                //throw $th;
            }

            $photo_name = time() . rand(1, 100) . '.' . $request->logo->extension();
            $request->logo->move(public_path(getFilePath('authority') .'/'), $photo_name);
            $authority->logo = $photo_name;
        }

        $authority->save();

        $notify[] = ['success', 'Authority has been added!'];

        return back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Authority  $authority
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $authority = Authority::find($id);
            unlink(public_path(getFilePath('authority') .'/' . $authority->logo));
        } catch (\Throwable $th) {
            //throw $th;
        }
        $authority->delete();

        $notify[] = ['success', 'Authority has been deleted!'];
        return back()->withNotify($notify);
    }
}
