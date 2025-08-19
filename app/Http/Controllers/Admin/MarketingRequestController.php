<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingRequest;

class MarketingRequestController extends Controller
{
    public function index()
    {
        $marketingRequests = $this->marketingRequestData();
        return view('admin.marketing_request.index', compact('marketingRequests'));
    }

    public function pending()
    {
        $marketingRequests = $this->marketingRequestData('pending');
        return view('admin.marketing_request.index', compact('marketingRequests'));
    }

    public function accepted()
    {
        $marketingRequests = $this->marketingRequestData('accepted');
        return view('admin.marketing_request.index', compact('marketingRequests'));
    }

    public function rejected()
    {
        $marketingRequests = $this->marketingRequestData('rejected');
        return view('admin.marketing_request.index', compact('marketingRequests'));
    }

    protected function marketingRequestData($scope = null)
    {
        if ($scope) {
            $marketingRequests = MarketingRequest::$scope();
        } else {
            $marketingRequests = MarketingRequest::query();
        }
        return $marketingRequests->searchable(['name', 'country:name', 'city:name', 'company', 'email', 'mobile'])->latest()->paginate(getPaginate());
    }

    public function show($id)
    {
        $marketingRequest = MarketingRequest::findOrFail($id);
        return view('admin.marketing_request.show', compact('marketingRequest'));
    }

    public function status($id, $status)
    {
        $propertyRequest = MarketingRequest::findOrFail($id);
        $propertyRequest->status = $status;
        $propertyRequest->save();
        $notify[] = ['success', 'Change Status Successfully'];
        return back()->withNotify($notify);
    }
}
