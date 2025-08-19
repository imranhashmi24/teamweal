<?php

namespace App\Http\Controllers\Admin\Request;

use App\Http\Controllers\Controller;
use App\Models\AuctionFormRequest;
use Illuminate\Http\Request;

class AuctionFormRequestController extends Controller
{
    public function index()
    {
        $requests = $this->serviceRequestData();
        return view('admin.request.auction_request.index', compact('requests'));
    }

    public function pending()
    {
        $requests = $this->serviceRequestData('pending');
        return view('admin.request.auction_request.index', compact('requests'));
    }

    public function accepted()
    {
        $requests = $this->serviceRequestData('accepted');
        return view('admin.request.auction_request.index', compact('requests'));
    }

    public function rejected()
    {
        $requests = $this->serviceRequestData('rejected');
        return view('admin.request.auction_request.index', compact('requests'));
    }

    protected function serviceRequestData($scope = null)
    {
        if ($scope) {
            $serviceRequests = AuctionFormRequest::$scope();
        } else {
            $serviceRequests = AuctionFormRequest::query();
        }
        
        return $serviceRequests->searchable(['name', 'country:name', 'city:name', 'auction:title', 'email', 'mobile'])->latest()->paginate(getPaginate());
    }

    public function show($id)
    {
        $serviceRequest = AuctionFormRequest::findOrFail($id);
        return view('admin.request.auction_request.show', compact('serviceRequest'));
    }

    public function status($id, $status)
    {
        $serviceRequest = AuctionFormRequest::findOrFail($id);
        $serviceRequest->status = $status;
        $serviceRequest->save();
        $notify[] = ['success', 'Change Status Successfully'];
        return back()->withNotify($notify);
    }
}
