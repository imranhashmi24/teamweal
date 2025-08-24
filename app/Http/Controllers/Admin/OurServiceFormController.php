<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OurServiceForm;
use App\Http\Controllers\Controller;

class OurServiceFormController extends Controller
{
    public function index($service_id)
    {
        $forms = OurServiceForm::where('our_service_id', $service_id)->searchable(request()->search, OurServiceForm::$searchable)->latest()->paginate(10);
        return view('admin.our_service.forms.index', compact('forms', 'service_id'));
    }

    public function create($service_id)
    {
        return view('admin.our_service.forms.create', compact('service_id'));
    }

    public function store(Request $request, $service_id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'required' => 'required|in:yes,no',
            'col' => 'required|numeric|between:1,12',
            'placeholder' => 'nullable|string|max:255',
            'placeholder_ar' => 'nullable|string|max:255',
            'options' => 'nullable|array',
            'options_ar' => 'nullable|array',
            'status' => 'required|in:active,inactive',
        ]);


        $options = $request->options;
        $options_ar = $request->options_ar;

        // convert options to array
        $options = json_encode($options);
        $options_ar = json_encode($options_ar);

        $form = OurServiceForm::create([
            'our_service_id' => $service_id,
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'type' => $request->type,
            'required' => $request->required,
            'col' => $request->col,
            'placeholder' => $request->placeholder,
            'placeholder_ar' => $request->placeholder_ar,
            'options' => $options,
            'options_ar' => $options_ar,
            'status' => $request->status,
        ]);

        if ($form) {
            $notify[] = ['success', __('Form created successfully')];
            return redirect()->route('admin.our_service.forms.index', $service_id)->with($notify);
        }

        $notify[] = ['error', __('Form created failed')];
        return redirect()->route('admin.our_service.forms.index', $service_id)->with($notify);
    }

    public function edit($service_id, $id)
    {
        $form = OurServiceForm::where('our_service_id', $service_id)->where('id', $id)->firstOrFail();
        return view('admin.our_service.forms.edit', compact('form', 'service_id'));
    }

    public function update(Request $request, $service_id, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'required' => 'required|in:yes,no',
            'col' => 'required|numeric|between:1,12',
            'placeholder' => 'nullable|string|max:255',
            'placeholder_ar' => 'nullable|string|max:255',
            'options' => 'nullable|array',
            'options_ar' => 'nullable|array',
            'status' => 'required|in:active,inactive',
        ]);

        $form = OurServiceForm::where('our_service_id', $service_id)->where('id', $id)->firstOrFail();

        $options = $request->options;
        $options_ar = $request->options_ar;

        // convert options to array
        $options = json_encode($options);
        $options_ar = json_encode($options_ar);

        $form->update([
            'our_service_id' => $service_id,
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'type' => $request->type,
            'required' => $request->required,
            'col' => $request->col,
            'placeholder' => $request->placeholder,
            'placeholder_ar' => $request->placeholder_ar,
            'options' => $options,
            'options_ar' => $options_ar,
            'status' => $request->status,
        ]);

        if ($form) {
            $notify[] = ['success', __('Form updated successfully')];
            return redirect()->route('admin.our_service.forms.index', $service_id)->with($notify);
        }

        $notify[] = ['error', __('Form updated failed')];
        return redirect()->route('admin.our_service.forms.index', $service_id)->with($notify);
    }

    public function destroy($service_id, $id)
    {
        $form = OurServiceForm::findOrFail($id);
        $form->delete();

        if ($form) {
            $notify[] = ['success', __('Form deleted successfully')];
            return redirect()->route('admin.our_service.forms.index', $service_id)->with($notify);
        }

        $notify[] = ['error', __('Form deleted failed')];
        return redirect()->route('admin.our_service.forms.index', $service_id)->with($notify);
    }

    public function status($service_id, $id)
    {
        $form = OurServiceForm::findOrFail($id);
        $form->update([
            'status' => $form->status == 'active' ? 'inactive' : 'active',
        ]);

        if ($form) {
            $notify[] = ['success', __('Form status updated successfully')];
            return redirect()->route('admin.our_service.forms.index', $service_id)->with($notify);
        }

        $notify[] = ['error', __('Form status updated failed')];
        return redirect()->route('admin.our_service.forms.index', $service_id)->with($notify);
    }
}
