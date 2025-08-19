<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::searchable(['name','name_ar','country:name'])->paginate(getPaginate());
        return view('admin.city.index', compact('cities'));
    }

    public function create()
    {
        $title = 'Create City';
        // $countries = Country::orderBy('sort_order', 'desc')->get();
        $countries = Country::orderByRaw('ISNULL(sort_order), sort_order')->get();
        return view('admin.city.create', compact('title', 'countries'));
    }

    public function store(Request $request, $id = null)
    {
        $validation = 'required';

        if ($id) {
            $validation = 'nullable';
        }

        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'image' => [$validation, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($id) {
            $city = City::findOrFail($id);
            $message = 'City update successfully';
        } else {
            $city = new City();
            $message = 'City create successfully';
        }

        $city->country_id = $request->country_id;
        $city->name = $request->name;
        $city->name_ar = $request->name_ar;
        $city->lat = $request->lat;
        $city->lng = $request->lng;

        if ($request->hasFile('image')) {
            try {
                $old = $city->image;
                $city->image = fileUploader($request->image, getFilePath('city'), getFileSize('city'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $city->save();

        $notify[] = ['success', $message];
        return to_route('admin.city.index')->withNotify($notify);

    }

    public function edit($id)
    {
        $title = 'Edit City';
        $city = City::findOrFail($id);
        $countries = Country::orderByRaw('ISNULL(sort_order), sort_order')->get();
        return view('admin.city.create', compact('city', 'title', 'countries'));
    }

}
