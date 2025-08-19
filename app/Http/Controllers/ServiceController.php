<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = [];
        $data['title'] = __('Services');
        $data['services'] = Service::query()->latest()
            ->when($request->filled('search'), function (Builder $query) use ($request) {
                $query->where('title', "LIKE", "%$request->search%");
                $query->OrWhere('title_ar', "LIKE", "%$request->search%");
                $query->OrWhere('description', "LIKE", "%$request->search%");
                $query->OrWhere('description_ar', "LIKE", "%$request->search%");
            })->when(request()->filled('category_id'), function (Builder $query)
            {
                $query->where('category_id', request('category_id'));
            })
            ->paginate(9);

        $data['categories'] = Category::all();


        return view('web.services.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['service'] = Service::where('slug', $slug)->orWhere('id', $slug)->first();

        $data['categories'] = Category::get();
        $data['services'] = Service::query()->simplePaginate(8);
        return view('web.services.show', $data);
    }
}
