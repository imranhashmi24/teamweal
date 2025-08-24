<?php

namespace App\Http\Controllers\Admin\InvestmentOpportunities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestmentOpportunityCategory;

class InvestmentOpportunityCategoryController extends Controller
{

    public $model = InvestmentOpportunityCategory::class;
    public $searchable = ['title', 'title_ar'];
    public $view = "admin.investment_opportunities.categories";
    public $route = "admin.investment_opportunities.categories";
    public $redirect = "admin.investment_opportunities.categories";
    public $notify = "Investment Opportunity Category";
    public $file_path = "investment_opportunity_category";
    
    public function index()
    {
        $datas = $this->model::searchable(request()->search, $this->searchable)->latest()->paginate(10);
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $emptyMessage = __('No data found');
        $is_list = true;
        $is_form = true;
        return view($this->view . '.index', compact('datas', 'route', 'title', 'file_path', 'emptyMessage', 'is_list', 'is_form'));
    }

    public function create()
    {
        $route = $this->route;
        $title = $this->notify;
        $file_path = $this->file_path;
        $categories = InvestmentOpportunityCategory::active()->get();
        return view($this->view . '.create', compact('route', 'title', 'file_path', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'parent_id' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $this->model::create([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'parent_id' => $request->parent_id,
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
        $categories = InvestmentOpportunityCategory::active()->get();
        return view($this->view . '.edit', compact('data', 'route', 'title', 'file_path', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'parent_id' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $this->model::findOrFail($id);

        $data->update([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'parent_id' => $request->parent_id,
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
