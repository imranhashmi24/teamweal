<?php

namespace App\Http\Controllers\Admin;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Plusemon\Notify\Facades\Notify;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opportunities = Opportunity::query()
            ->searchable(['title', 'title_ar', 'overview'])
            ->when(request()->filled('authority_id'), function (Builder $query) {
                $query->where('authority_id', request('authority_id'));
            })->paginate();
        return view('admin.authorities.opportunities.index', compact('opportunities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authorities.opportunities.create');
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
            'authority_id' => 'required',
            'thumb' => 'required|image',
            'title' => 'required',
            'title_ar' => 'required',
            'overview' => 'required',
        ]);

        $opportunity = Opportunity::create($request->except('thumb'));

        if ($request->hasFile('thumb')) {
            $photo_name = time() . rand(1, 100) . '.' . $request->thumb->extension();
            $request->thumb->move(public_path(getFilePath('opportunity') .'/'), $photo_name);
            $opportunity->thumb = $photo_name;
            $opportunity->save();
        }

        // notifySuccess('Opportunity added successfully');

        $notify[] = ['success', 'Opportunity added successfully'];
        return redirect(route('admin.opportunities.create', ['authority_id' => $request->input('authority_id')]))->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Opportunity  $opportunity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opportunity = Opportunity::find($id);
        return view('admin.authorities.opportunities.show', compact('opportunity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Opportunity  $opportunity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opportunity = Opportunity::find($id);
        return view('admin.authorities.opportunities.edit', compact('opportunity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Opportunity  $opportunity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'authority_id' => 'required',
            'thumb' => 'nullable|image',
            'title' => 'required',
            'title_ar' => 'required',
            'overview' => 'required',
        ]);

        $opportunity = Opportunity::find($id);

        $opportunity->fill($request->except('thumb'));

        try {
            unlink(public_path('media/images/opportunities/' . $opportunity->thumb));
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($request->hasFile('thumb')) {
            $photo_name = time() . rand(1, 100) . '.' . $request->thumb->extension();
            $request->thumb->move(public_path(getFilePath('opportunity') .'/'), $photo_name);
            $opportunity->thumb = $photo_name;
        }
        $opportunity->save();

        $notify[] = ['success', 'Opportunity updated successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Opportunity  $opportunity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $opportunity = Opportunity::find($id);
            unlink(public_path(getFilePath('opportunity') .'/' . $opportunity->thumb));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $opportunity->delete();

        $notify[] = ['success', 'Opportunity has been deleted!'];
        return back()->withNotify($notify);
    }
}
