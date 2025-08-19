<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\City;
use App\Models\Auction;
use App\Models\Bidding;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\AuctionFormRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AuctionController extends Controller
{
    use ApiResponse;

    public function auctions(Request $request)
    {
        $type = $request->type ?? 'all';

        $data['all'] = Auction::ifNotPending()->count();
        $data['current']  = Auction::current()->count();
        $data['upcoming'] = Auction::upcoming()->count();
        $data['finished'] = Auction::finished()->count();

        $query =  Auction::query();

        if($type == 'current'){
            $data['type']  = $type;
            $query = $query->current();
        }

        if($type == 'upcoming'){
            $data['type']  = $type;
            $query = $query->upcoming();
        }

        if($type == 'finished'){
            $data['type']  = $type;
            $query = $query->finished();
        }

        if($type == 'all'){
            $data['type']  = $type;
        }

        if ($request->filled('title')) {
            $data['type']  = $type;
            $title = $request->input('title');
            $query = $query->where('title', 'like', "%$title%")
                                       ->orWhere('title_ar', 'like', "%$title%");
        }


        if ($request->filled('city_id')) {
            if ($request->input('city_id') != 0) {
                $data['type'] = $type;
                $data['city_id'] = $request->input('city_id');
                $query = $query->where('city_id', $request->input('city_id'));
            }
        }


        $data['auctions'] = $query->ifNotPending()->paginate(10);


        return $this->successResponse($data, $type . ' ' . 'auction retrieve');

    }

    public function auctionDetails(Request $request, $slug)
    {
        $minutes = 30;

        $type = $request->type ?? 'about';

        if($type != 'about' && $type != 'item'){
            $type = 'about';
        }

        $auctionQuery = Auction::where('slug', $slug);

        if ($type == 'about') {
            $auctionQuery->with('create_by', 'country', 'city');
        } elseif ($type == 'item') {
            $auctionQuery->with('properties.property');
        }

        $auction = Cache::remember('auction_' . $slug, $minutes, function () use ($auctionQuery) {
            return $auctionQuery->first();
        });

        $title = app()->getLocale() == 'en' ? $auction->title : $auction->title_ar;

        if ($type == 'item') {
            $auction = $auction->properties->map(function ($property) {
                return $property->property;
            });
        }

        $data = [
            "title"    => $title,
            "type"     => $type,
            "auction"  => $auction
        ];

        return $this->successResponse($data, $type . ' auction retrieve details');
    }

    public function auctionMap(Request $request, $id = null)
    {
        $type = $request->type ?? 'all';
        $getCityLatLng = [];
        $property_items = [];

        $cities = getCities();

        $all = Auction::ifNotPending()->count();
        $current = Auction::current()->count();
        $upcoming = Auction::upcoming()->count();
        $finished = Auction::finished()->count();

        $auction = null;

        if($id){
            $auction = Auction::find($id);
            $city = getCity($auction->city_id);
            $getCityLatLng['lat'] = $city->lat;
            $getCityLatLng['lng'] = $city->lng;
            $getCityLatLng['title'] = app()->getLocale() == 'en' ? $city->name : $city->name_ar;

            $properties = $auction->properties;

            foreach($properties as $item){
                $property_items[] = [
                    'id'     => $item->property->id,
                    'slug'   => $item->property->slug,
                    'lat'    => $item->property->latitude,
                    'lng'    => $item->property->longitude,
                    'title'  => app()->getLocale() == 'en' ? $item->property->title : $item->property->title_ar,
                ];
            }

        }else{
            $getCountry = getCountry();
            $city = City::where('country_id', $getCountry->id)->first();
            $getCityLatLng['lat'] = $city->lat;
            $getCityLatLng['lng'] = $city->lng;
            $getCityLatLng['title'] = app()->getLocale() == 'en' ? $city->name : $city->name_ar;

            $query = Auction::query();

            if($type == 'current'){
                $data['type']  = $type;
                $query = $query->current();
            }

            if($type == 'upcoming'){
                $data['type']  = $type;
                $query = $query->upcoming();
            }

            if($type == 'finished'){
                $data['type']  = $type;
                $query = $query->finished();
            }

            if($type == 'all'){
                $data['type']  = $type;
            }

            $auctions = $query->ifNotPending()->get();

            foreach($auctions as $item){
                $property_items[] = [
                    'id'  => $item->id,
                    'slug' => $item->slug,
                    'lat' => $item->latitude,
                    'lng' => $item->longitude,
                    'title' => app()->getLocale() == 'en' ? $item->title : $item->title_ar,
                ];
            }
        }

        $data['type'] = $type;
        $data['getCityLatLng'] = $getCityLatLng;
        $data['property_items'] = $property_items;
        $data['all'] = $all;
        $data['current'] = $current;
        $data['upcoming'] = $upcoming;
        $data['finished'] = $finished;


        return $this->successResponse($data, $type . ' auction retrieve maps');

    }

    public function fvtStore(Request $request)
    {

        $request->validate( [
            "type"        => "required|string",
            "property_id" => "required"
        ]);

        $type = $request->type;
        $property_id = $request->property_id;
        $message = fvtPost($type, $property_id);

        if($message){
            return response()->json([
                'status' => true,
                'message' => __('User already favorited this type. Existing favorite deleted.')
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => __('Favorite added successfully.')
            ]);
        }
    }

    public function biddingOfferSend(Request $request)
    {
        $request->validate( [
            "title"        => "required|string|max:191",
            "title_ar"     => "required|string|max:191",
            "property_id"  => "required|exists:properties,id",
            "auction_id"   => "required|exists:auctions,id",
            "amount"       => "required",
        ]);

        $auth_id = auth()->user()->id;

        $auction = DB::table('auctions')->where('id', $request->auction_id)->first();

        $bidding = new Bidding();
        $bidding->title = $request->title;
        $bidding->title_ar = $request->title_ar;
        $bidding->property_id = $request->property_id;
        $bidding->auction_id = $request->auction_id;
        $bidding->user_id = $auth_id;
        $bidding->amount = $request->amount;
        $bidding->status = 1;
        $bidding->save();


        return response()->json([
            'status' => true,
            'message' =>  __('Offer Send Successfully')
        ]);
    }

    public function requestAuctionRequestStore(Request $request, $id)
    {
        if(!$id){
            $message = __('Something went wrong. Please try again');
            $notify[] = ['error', $message];
            return $this->serverError($message);
        }

        $request->validate([
            // "auction_id" => "nullable",
            // "user_id"      => "nullable",
            "name"          => "required|string|max:255",
            "job_title"     => "required|string|max:255",
            "company"       => "required|string|max:255",
            "email"         => "required|string|email|max:255",
            "mobile"        => "required|string|max:255",
            "sectors"       => "required|string|max:255",
            "country_id"    => "required",
            "city_id"       => "nullable",
            "detail"        => "required",
        ]);

        try{
            
            $propertyRequest = new AuctionFormRequest();
            $propertyRequest->auction_id = $id;
            $propertyRequest->user_id = auth()->check() ? auth()->user()->id : 0;
            $propertyRequest->name = $request->name;
            $propertyRequest->job_title = $request->job_title;
            $propertyRequest->company = $request->company;
            $propertyRequest->email = $request->email;
            $propertyRequest->mobile = $request->mobile;
            $propertyRequest->sectors = $request->sectors;
            $propertyRequest->country_id = $request->country_id;
            $propertyRequest->city_id = $request->city_id;
            $propertyRequest->detail = $request->detail;
            $propertyRequest->status = 0;
            $propertyRequest->save();

            $message = __('Auction request successfully!');
            return $this->success($message);

        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }
}
