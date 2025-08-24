<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\OurService;
use App\Models\RequestOrder;
use Illuminate\Http\Request;
use App\Models\PrivateSector;

class WebRequestController extends Controller
{
    public function ourServiceRequest(Request $request)
    {
        $id = base64urlDecode($request->id);
        
        if(!$id){
            return to_route('home');
        }

        $our_service = OurService::find($id);

        if(!$our_service){
            return to_route('home');
        }

        $service_id = $our_service->id;
        $title = $our_service->lang('title');
        $route = 'our-service-request.store';
        $type = 'OurService';
        $model = 'OurServiceForm';
        $field = 'our_service_id';

        return view('frontend.our_service_request_form', compact('service_id', 'title', 'route', 'type', 'model', 'field'));
    }

    public function privateSectorRequest(Request $request)
    {
        $id = base64urlDecode($request->id);
        
        if(!$id){
            return to_route('home');
        }

        $private_sector = PrivateSector::find($id);

        if(!$private_sector){
            return to_route('home');
        }

        $service_id = $private_sector->id;
        $title = $private_sector->lang('title');
        $route = 'our-service-request.store';
        $type = 'PrivateSector';
        $model = 'PrivateSectorForm';
        $field = 'service_id';

        return view('frontend.our_service_request_form', compact('service_id', 'title', 'route', 'type', 'model', 'field'));
    }


    public function store(Request $request)
    {
        try {
            
            $request->validate([
                'form_data' => 'nullable|array',
                'form_checkbox' => 'nullable|array',
                'form_file' => 'nullable|array',
                'form_radio' => 'nullable|array',
            ]);

            $data = [
                'form_data' => $request->input('form_data', []),
                'form_checkbox' => $request->input('form_checkbox', []),
                'form_radio' => $request->input('form_radio', []),
            ];

            // Handle file uploads
            if ($request->hasFile('form_file')) {
                foreach ($request->file('form_file') as $key => $files) {
                    foreach ($files as $file) {
                        $path = $file->store('uploads/forms', 'public');
                        $data['form_file'][$key][] = $path;
                    }
                }
            }

            RequestOrder::create([
                'user_id' => auth()->user()->id ?? 0,
                'service_id' => $request->service_id,
                'type' => $request->type,
                'form_data' => json_encode($data['form_data']),
                'form_checkbox' => json_encode($data['form_checkbox']),
                'form_radio' => json_encode($data['form_radio']),
                'form_file' => json_encode($data['form_file'] ?? []),
                'status' => 'pending',
                'is_seen' => 0,
            ]);

            $message = __('Your request is been received and we will contact you shortly.');
            $notify[] = ['success', $message];
            return back()->withNotify($notify);
      
      
            

        } catch (Exception $e) {
            $message = __('Something went wrong. Please try again');
            $notify[] = ['error', $message];

            if(env('APP_ENV') == 'local'){
                $notify[] = ['error', $e->getMessage()];
            } elseif(env('APP_ENV') == 'staging'){
                $notify[] = ['error', $e->getMessage()];
            } elseif(env('APP_ENV') == 'production'){
                $notify[] = ['error', $message];
            }

            return back()->withNotify($notify);
        }
    }
}
