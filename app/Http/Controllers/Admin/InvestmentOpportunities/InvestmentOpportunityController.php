<?php

namespace App\Http\Controllers\Admin\InvestmentOpportunities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InvestmentOpportunity;
use App\Models\InvestmentOpportunityCategory;

class InvestmentOpportunityController extends Controller
{

    public $model = InvestmentOpportunity::class;
    public $category_model = InvestmentOpportunityCategory::class;
    public $searchable = ['title', 'title_ar'];
    public $view = "admin.investment_opportunities";
    public $route = "admin.investment_opportunities";
    public $redirect = "admin.investment_opportunities";
    public $notify = "Investment Opportunity";
    public $file_path = "investment_opportunity";
    public $is_category = true;
    public $is_list = false;
    public $is_form = false;
    
    public function index()
    {
        $datas = $this->model::searchable(request()->search, $this->searchable)->latest()->paginate(10);
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $emptyMessage = __('No data found');
        $is_list = $this->is_list;
        $is_form = $this->is_form;
        $is_category = $this->is_category;
        return view($this->view . '.index', compact('datas', 'route', 'title', 'file_path', 'emptyMessage', 'is_list', 'is_form', 'is_category'));
    }

    public function create()
    {
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $categories = $this->category_model::where('status', 'active')->get();
        $is_category = $this->is_category;
        return view($this->view . '.create', compact('route', 'title', 'file_path', 'categories', 'is_category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'category_id' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $this->model::create([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);


        if ($request->hasFile('image')) {
            $data->update([
                'image' => fileUploader($request->image, getFilePath($this->file_path)),
            ]);
        }


        $notify[] = ['success', $this->notify . __('created successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $categories = $this->category_model::where('status', 'active')->get();
        $is_category = true;
        return view($this->view . '.edit', compact('data', 'route', 'title', 'file_path', 'categories', 'is_category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'category_id' => 'nullable|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $this->model::findOrFail($id);

        $data->update([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);


        if ($request->hasFile('image')) {
            $data->update([
                'image' => fileUploader($request->image, getFilePath($this->file_path)),
            ]);
        }


        $notify[] = ['success', $this->notify . __('updated successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $data = $this->model::findOrFail($id);

        if ($data->image) {
            fileDeleter($data->image, getFilePath($this->file_path));
        }

        
        $data->delete();

        $notify[] = ['success', $this->notify . __('deleted successfully')];

        return redirect()->route($this->route . '.index')->withNotify($notify);
    }
}
