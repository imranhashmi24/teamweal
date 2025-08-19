<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceRequest;
use App\Models\ServiceRequestAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ServiceRequestController extends Controller
{
    
    public function store(Request $request)
    {
        return $this->storeRequest($request, $request->service_type);
    }


    private function storeRequest(Request $request, $serviceType)
    {
        $validated = $this->validateRequest($request, $serviceType);

        $serviceRequest = ServiceRequest::create([
            'service_type' => $serviceType,
            'organization' => $validated['organization'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'country_id' => $validated['country_id'],
            'entity_type' => $validated['entity_type'],
            'service_id' => $validated['service_id'],
            'project_summary' => $validated['summary'] ?? null,
            'budget' => $validated['budget'],
            'timeline' => $validated['timeline'],
            'readiness' => $validated['readiness'],
            'custom_fields' => $this->getCustomFields($request, $serviceType),
            'user_id' => auth()->id()
        ]);

        $this->handleAttachments($request, $serviceRequest);
        
        $notify[] = ['success', 'Service request submitted successfully! Request Number: '. $serviceRequest->request_number];

        return redirect()->back()->withNotify($notify);
    }

    private function validateRequest(Request $request, $serviceType)
    {
        $rules = [
            'organization' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required',
            'country_id' => 'required',
            'entity_type' => 'required',
            'service_id' => 'required',
            'budget' => 'required',
            'timeline' => 'required',
            'readiness' => 'required',
            'attachments.*' => 'file|mimes:jpg,png,pdf,doc,docx,xls,xlsx|max:5120'
        ];
    
        switch ($serviceType) {
            case 'technical':
                $rules['summary'] = 'nullable|string';
                break;
            case 'cloud':
                $rules['requirements'] = 'nullable|string';
                $rules['current_setup'] = 'nullable|string';
                break;
            case 'ai':
                $rules['industry'] = 'nullable|string';
                $rules['ai_type'] = 'nullable|string';
                $rules['description'] = 'nullable|string';
                break;
            case 'coding':
                $rules['services'] = 'nullable|string';
                $rules['service_description'] = 'nullable|string';
                $rules['purpose'] = 'nullable|string';
                $rules['documents'] = 'nullable|string';
                break;
            case 'cybersecurity':
                $rules['target'] = 'nullable|string';
                $rules['implementation'] = 'nullable|string';
                $rules['current_security'] = 'nullable|string';
                break;
            case 'data-analytics':
                $rules['objective'] = 'nullable|string';
                $rules['data_status'] = 'nullable|string';
                $rules['description'] = 'nullable|string';
                $rules['data_sources'] = 'nullable|string';
                break;
        }
    
        $messages = [
           
            'required' => __('This field is required'),
            'string' => __('Please enter a valid text'),
            'email' => __('Please enter a valid email address'),
            'max' => [
                'string' => __('Text should not exceed :max characters'),
                'file' => __('File size should not exceed :max KB')
            ],
            'file' => __('Please upload a valid file'),
            'mimes' => __('Allowed file types: :values'),
            
            'organization.required' => __('Please enter organization name'),
            'email.required' => __('Please enter your email address'),
            'email.email' => __('Please enter a valid email'),
            'phone.required' => __('Please enter your phone number'),
            'city.required' => __('Please enter your city'),
            'country_id.required' => __('Please select your country'),
            'entity_type.required' => __('Please select entity type'),
            'service_id.required' => __('Please select service type'),
            'budget.required' => __('Please specify your budget'),
            'timeline.required' => __('Please specify your timeline'),
            'readiness.required' => __('Please specify your readiness level'),
            'attachments.*.file' => __('Please upload valid files only'),
            'attachments.*.mimes' => __('Allowed file types: :values'),
            'attachments.*.max' => __('Maximum file size is 5MB'),
        ];
    
        return $request->validate($rules, $messages);
    }

    private function getCustomFields(Request $request, $serviceType)
    {
        $customFields = [];

        switch ($serviceType) {
            case 'technical':
                $customFields = [
                    'special_requirements' => $request->input('notes', '')
                ];
                break;
            case 'cloud':
                $customFields = [
                    'requirements' => $request->input('requirements'),
                    'current_setup' => $request->input('current_setup', '')
                ];
                break;
                
            case 'ai':
                $customFields = [
                    'industry' => $request->input('industry'),
                    'ai_type' => $request->input('ai_type', ''),
                    'description' => $request->input('description', '')
                ];
                break;
            case 'coding':
                $customFields = [
                    'services' => $request->input('services'),
                    'service_description' => $request->input('service_description', ''),
                    'purpose' => $request->input('purpose', ''),
                    'documents' => $request->input('purpose', ''),
                ];
                break;
            case 'cybersecurity':
                $customFields = [
                    'target' => $request->input('target', ''),
                    'implementation' => $request->input('implementation', ''),
                    'current_security' => $request->input('purpose', '')
                ];
                break;
                
            case 'data-analytics':
                $customFields = [
                    'objective' => $request->input('objective', ''),
                    'data_status' => $request->input('data_status', ''),
                    'description' => $request->input('description', ''),
                    'data_sources' => $request->input('data_sources', '')
                ];
                break;
            
        }

        return $customFields;
    }

    private function handleAttachments(Request $request, ServiceRequest $serviceRequest)
    {
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('service-requests/' . $serviceRequest->id, 'public');

                ServiceRequestAttachment::create([
                    'service_request_id' => $serviceRequest->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize()
                ]);
            }
        }
    }

    public function index(Request $request)
    {
        $query = ServiceRequest::with('user')->latest();


        if ($request->has('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('request_number', 'like', "%$search%")
                  ->orWhere('organization_name', 'like', "%$search%")
                  ->orWhere('contact_email', 'like', "%$search%");
            });
        }

        $requests = $query->paginate(15);

        return view('admin.service-requests.index', compact('requests'));
    }

    public function show($id)
    {
        $serviceRequest = ServiceRequest::find($id);
        $serviceRequest->load('attachments', 'user');
        return view('admin.service-requests.show', compact('serviceRequest'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_review,approved,rejected,completed',
            'notes' => 'nullable|string'
        ]);
        
         $serviceRequest = ServiceRequest::find($id);

        $serviceRequest->update([
            'status' => $validated['status'],
            'custom_fields' => array_merge(
                (array)$serviceRequest->custom_fields,
                ['admin_notes' => $validated['notes'] ?? null]
            )
        ]);
        
        $notify[] = ['success', 'Status updated successfully'];

        return redirect()->back()->withNotify($notify);
    }
    
    public function downloadAttachment($id)
    {
        
        $attachment = ServiceRequestAttachment::find($id);
        
        if (!Storage::disk('public')->exists($attachment->file_path)) {
            abort(404);
        }
    
        return Storage::disk('public')->download(
            $attachment->file_path,
            $attachment->original_name
        );
    }
}