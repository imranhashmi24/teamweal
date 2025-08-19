<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Property;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\FinanceRequest;
use App\Models\ServiceRequest;
use App\Models\PropertyRequest;
use App\Models\MarketingRequest;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   use ApiResponse;
   public function dashboard()
   {
       try {
            $data['propertyCount'] = Property::where('user_id',auth()->user()->id)->count();
            $data['propertyRequestCount'] = PropertyRequest::where('user_id',auth()->user()->id)->count();
            $data['financeRequestCount'] = FinanceRequest::where('user_id',auth()->user()->id)->count();
            $data['marketingRequestCount'] = MarketingRequest::where('user_id',auth()->user()->id)->count();
            $data['serviceRequestCount'] = ServiceRequest::where('user_id',auth()->user()->id)->count();
            $data['supportCount'] = SupportTicket::where('user_id',auth()->user()->id)->count();

            return $this->successResponse($data);
       } catch (Exception $e) {
            return $this->serverError('Something went wrong');
       }
   }

}
