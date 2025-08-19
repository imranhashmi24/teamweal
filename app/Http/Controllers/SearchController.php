<?php

namespace App\Http\Controllers;

use App\Models\Frontend;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;

        // check if search is empty
        if (empty($search)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search field is required',
            ]);
        }

        // search for services
        $services = Service::where('title', 'like', '%' . $search . '%')
            ->orWhere('title_ar', 'like', '%' . $search . '%')
            ->get(['id', 'title', 'title_ar', 'slug']);
        $services->transform(function ($service) {
            $service->url = url('/service_requests' . '?id=' . $service->id);
            $service->title = app()->isLocale('ar') ? $service->title_ar : $service->title;
            return $service;
        });

        // return response
        return response()->json([
            'status' => 'success',
            'services' => $services,
        ]);
    }

}
