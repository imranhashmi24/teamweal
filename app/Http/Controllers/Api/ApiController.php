<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Blog;
use App\Models\City;
use App\Models\Form;
use App\Models\Page;
use App\Models\Event;
use App\Models\Auction;
use App\Models\Country;
use App\Models\EventAsk;
use App\Models\Property;
use App\Models\EventNews;
use App\Models\AllCategory;
use App\Traits\ApiResponse;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\FinanceRequest;
use App\Models\ServiceRequest;
use App\Models\BusinessRequest;
use App\Models\PropertyRequest;
use App\Models\SubpropertyType;
use App\Models\MarketingRequest;
use App\Models\PromotionRequest;
use App\Models\PropertyFormRequest;
use App\Models\PropertyRequestSend;
use App\Models\SocialInvestRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetliabilitieRequest;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    use ApiResponse;

    public function countries()
    {
        $o_countries = Country::orderByRaw('ISNULL(sort_order), sort_order')->with('city')->get();
        $countries = sortOrder($o_countries);
        return $this->successResponse($countries, 'countries');
    }

    public function allcountries()
    {
        $countriesAll = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return $this->successResponse($countriesAll, 'countries');
    }

    public function cities($country_id)
    {
        try {
           $cities = City::where('country_id', $country_id)->get();

           return $this->successResponse($cities, 'cities');
        } catch (Exception $e) {
            return $this->serverError();
        }
    }

    public function propertyType()
    {
        try {
            $property_types = PropertyType::get();
            return $this->successResponse($property_types, 'property types');
         } catch (Exception $e) {
             return $this->serverError();
         }
    }

    public function subPropertyType($property_type_id)
    {
        $gn_name = 'propert_type_form_' . $property_type_id;
        $formData = Form::where('act', $gn_name)->first();

        $subproperty_type = SubpropertyType::where('property_type_id', $property_type_id)->get();

        $data = [
            "property_detail_form" => $formData,
            "subproperty_types"    => $subproperty_type
        ];

        return $this->successResponse($data, 'subproperty types and form');
    }

    public function getProperty(Request $request)
    {

        try {

            $loggedInUserId = auth()->user()->id ?? 0;
            $query = Property::query();

            if ($request->filled('property_type_id')) {
                $query->where('property_type_id', $request->property_type_id);
            }

            if ($request->filled('city_id')) {
                $query->where('city_id', $request->city_id);
            }

            if ($request->filled('sub_property_type_id')) {
                $query->where('subproperty_type_id', $request->sub_property_type_id);
            }

            if ($request->filled('country_id')) {
                $query->where('country_id', $request->country_id);
            }

            if ($request->filled('purpose')) {
                $query->where('purpose', $request->purpose);
            }

            if ($request->filled('time_period') && $request->input('time_period') == "Newest") {
                $query->whereBetween("created_at", [now()->subDays(7), now()]);
            }

            if ($request->filled('from_price') && $request->filled('to_price')) {
                $query->whereBetween("price", [$request->from_price, $request->to_price]);
            }

            $properties = $query->published()
                ->with([
                    'propertyType' => function ($query) {
                        $query->select('id', 'name', 'name_ar', 'icon');
                    },
                    'subPropertyType' => function ($query) {
                        $query->select('id', 'name', 'name_ar');
                    },
                    'country' => function ($query) {
                        $query->select('id', 'name', 'name_ar');
                    },
                    'city' => function ($query) {
                        $query->select('id', 'name', 'name_ar');
                    },
                    'favorite' => function ($query) use ($loggedInUserId) {
                        $query->select('id', 'property_id', 'user_id')
                            ->where('user_id', $loggedInUserId);
                    },
                    'images' => function ($query) {
                        $query->select('*');
                    },
                    'details' => function ($query) {
                        $query->select('id', 'property_id', 'field', 'val');
                    },
                ])
                ->addSelect([
                    'is_favorite' => function ($query) use ($loggedInUserId) {
                        $query->from('favorites')
                            ->whereColumn('property_id', 'properties.id')
                            ->where('user_id', $loggedInUserId)
                            ->selectRaw('CASE WHEN count(*) > 0 THEN true ELSE false END');
                    }
                ])
                ->paginate(getPaginate());

            $properties->each(function ($property) {
                if ($property->favorite === null) {
                    unset($property->favorite);
                }
            });

            return $this->successResponse($properties);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->serverError('Something went wrong');
        }

    }

    public function getMapProperty(Request $request)
    {
        try {
            
            $loggedInUserId = auth()->user()->id ?? 0;
            $query = Property::query();

            if ($request->filled('property_type_id')) {
                $query->where('property_type_id', $request->property_type_id);
            }

            if ($request->filled('city_id')) {
                $query->where('city_id', $request->city_id);
            }

            if ($request->filled('sub_property_type_id')) {
                $query->where('subproperty_type_id', $request->sub_property_type_id);
            }

            if ($request->filled('country_id')) {
                $query->where('country_id', $request->country_id);
            }

            if ($request->filled('purpose')) {
                $query->where('purpose', $request->purpose);
            }

            if ($request->filled('time_period') && $request->input('time_period') == "Newest") {
                $query->whereBetween("created_at", [now()->subDays(7), now()]);
            }

            if ($request->filled('from_price') && $request->filled('to_price')) {
                $query->whereBetween("price", [$request->from_price, $request->to_price]);
            }

            $properties = $query->published()->get();

            $property_items = [];

            foreach($properties as $property){
                $property_items[] = [
                    'id'     => $property->id,
                    'slug'   => $property->slug,
                    'lat'    => $property->latitude,
                    'lng'    => $property->longitude,
                    'title'  => app()->getLocale() == 'en' ? $property->title : $property->title_ar,
                ];
            }

            return $this->successResponse($property_items);
        } catch (\Exception $e) {
            return $e->getMessage();
            return $this->serverError('Something went wrong');
        }

    }

    public function getPropertyDetail($slug)
    {
        try{
            $loggedInUserId = auth()->user()->id ?? 0;
            $query = Property::query();
            $property = $query->where('slug', $slug)->published()
                ->with([
                    'propertyType' => function ($query) {
                        $query->select('id', 'name', 'name_ar', 'icon');
                    },
                    'subPropertyType' => function ($query) {
                        $query->select('id', 'name', 'name_ar');
                    },
                    'country' => function ($query) {
                        $query->select('id', 'name', 'name_ar');
                    },
                    'city' => function ($query) {
                        $query->select('id', 'name', 'name_ar');
                    },
                    'favorite' => function ($query) use ($loggedInUserId) {
                        $query->select('id', 'property_id', 'user_id')
                            ->where('user_id', $loggedInUserId);
                    },
                    'images' => function ($query) {
                        $query->select('*');
                    },
                    'details' => function ($query) {
                        $query->select('id', 'property_id', 'field', 'val');
                    },
                ])
                ->addSelect([
                    'is_favorite' => function ($query) use ($loggedInUserId) {
                        $query->from('favorites')
                            ->whereColumn('property_id', 'properties.id')
                            ->where('user_id', $loggedInUserId)
                            ->selectRaw('CASE WHEN count(*) > 0 THEN true ELSE false END');
                    }
                ])
                ->first();

            if ($property->favorite === null) {
                unset($property->favorite);
            }

            return $this->successResponse($property);
        } catch (\Exception $e) {
            return $this->serverError('Something went wrong');
        }
    }

    public function sectors()
    {
        try {

            $investmentSectorElements = getContent('social_investment_sector.element', null, false, true);
            $elements = [];

            foreach ($investmentSectorElements as $element) {
                $elements[] = [
                    'sector_name' => $element->data_values->sector_name,
                    'sector_name_ar' => $element->data_values->sector_name_ar,
                ];
            }

            $data['sectors'] = $elements;

            return $this->successResponse($data);
        } catch (Exception $e) {
            return $this->serverError('Something went wrong');
        }
    }

    public function serviceRequestStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'budget' => 'required',
            'email' => 'required|string|email',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            "property_type_id" => "required|exists:property_types,id",
            'description' => 'nullable',
            'sectors'    => "required",   
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        $serviceRequest = new ServiceRequest();
        $serviceRequest->name = $request->name;
        $serviceRequest->email = $request->email;
        $serviceRequest->mobile = $request->mobile;
        $serviceRequest->country_id = $request->country_id;
        $serviceRequest->city_id = $request->city_id;
        $serviceRequest->property_type_id = $request->property_type_id;
        $serviceRequest->description = $request->description;
        $serviceRequest->budget = $request->budget;
        $serviceRequest->sectors = $request->sectors;
        $serviceRequest->save();


        $notify = __('Service Request Send Successfully');
        return $this->success($notify);
    }

    public function marketingRequestStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'job_title' => 'required|string',
            'company' => 'required|string',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            'email' => 'required|string|email',
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            'activity' => 'required|string',
            'sectors'   => 'required|string'
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        $serviceRequest = new MarketingRequest();
        $serviceRequest->name = $request->name;
        $serviceRequest->job_title = $request->job_title;
        $serviceRequest->company = $request->company;
        $serviceRequest->mobile = $request->mobile;
        $serviceRequest->email = $request->email;
        $serviceRequest->country_id = $request->country_id;
        $serviceRequest->city_id = $request->city_id;
        $serviceRequest->activity = $request->activity;
        $serviceRequest->sectors = $request->sectors;
        $serviceRequest->save();

        $notify = __('Marketing Request Send Successfully');
        return $this->success($notify);
    }

    public function socialInvestmentStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'budget' => 'required',
            'email' => 'required|string|email',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            "property_type_id" => "required|exists:property_types,id",
            'description' => 'nullable',
            'sectors'     => 'required|array'
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        try {
         
            $serviceRequest = new SocialInvestRequest();
            $serviceRequest->name = $request->name;
            $serviceRequest->email = $request->email;
            $serviceRequest->mobile = $request->mobile;
            $serviceRequest->country_id = $request->country_id;
            $serviceRequest->city_id = $request->city_id;
            $serviceRequest->property_type_id = $request->property_type_id;
            $serviceRequest->description = $request->description;
            $serviceRequest->budget = $request->budget;
    
            $secs = [];
    
            if ($request->has('sectors')) {
                $secs = $request->sectors;
                $serviceRequest->sectors = json_encode($secs);
            }
    
            $serviceRequest->save();
            return $this->success("Social invest send success");
        } catch (Exception $e) {
            return $this->serverError('Something went wrong');
        }
    }


    public function businessPostReq(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'business_post_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'name' => 'required',
            'position_title' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'message' => 'required',
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        $businessPostRequest = new BusinessRequest();
        $businessPostRequest->user_id = auth()->id() ?? 0;
        $businessPostRequest->business_post_id = $request->business_post_id;
        $businessPostRequest->name = $request->name;
        $businessPostRequest->position_title = $request->position_title;
        $businessPostRequest->email = $request->email;
        $businessPostRequest->mobile = $request->mobile;
        $businessPostRequest->country_id = $request->country_id;
        $businessPostRequest->city_id = $request->city_id;
        $businessPostRequest->message = $request->message;
        $businessPostRequest->save();

        $notify = __('Business Request Send Successfully');
        return $this->success($notify);

    }

    public function financeRequestStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'family_name' => 'required|string',
            'nid' => 'required|string',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            'email' => 'required|string|email',
            'alawwal' => 'required',
            "property_type_id" => "required|exists:property_types,id",
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            'monthly_income' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        $financeRequest = new FinanceRequest();
        $financeRequest->name = $request->name;
        $financeRequest->family_name = $request->family_name;
        $financeRequest->nid = $request->nid;
        $financeRequest->mobile = $request->mobile;
        $financeRequest->email = $request->email;
        $financeRequest->alawwal = $request->alawwal;
        $financeRequest->country_id = $request->country_id;
        $financeRequest->city_id = $request->city_id;
        $financeRequest->property_type_id = $request->property_type_id;
        $financeRequest->monthly_income = $request->monthly_income;
        $financeRequest->save();

        $notify = __('Finance Request Send Successfully');
        return $this->success($notify);
    }

    public function propertyRequestStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            'email' => 'required|string|email',
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            "nature_of_property" => "required",
            "property_type_id" => "required|exists:property_types,id",
            "subproperty_type_id" => "nullable|exists:subproperty_types,id",
            "budget" => "required",
            'purpose' => 'required|string',
            'area' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        $propertyRequest = new PropertyRequest();
        $propertyRequest->name = $request->name;
        $propertyRequest->mobile = $request->mobile;
        $propertyRequest->email = $request->email;
        $propertyRequest->country_id = $request->country_id;
        $propertyRequest->city_id = $request->city_id;
        $propertyRequest->nature_of_property = $request->nature_of_property;
        $propertyRequest->property_type_id = $request->property_type_id;
        $propertyRequest->subproperty_type_id = $request->subproperty_type_id;
        $propertyRequest->budget = $request->budget;
        $propertyRequest->purpose = $request->purpose;
        $propertyRequest->area = $request->area;
        $propertyRequest->save();

        $notify = __('Property Request Send Successfully');
        return $this->success($notify);
    }

    public function propertyRequestSend(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'property_id' => "required|exists:properties,id",
            'name' => 'required|string',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            'email' => 'required|string|email',
            'job_title' => "required",
            'message' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }


        try {
            $propety_request = new PropertyRequestSend();
            $propety_request->user_id = Auth::check() ? Auth::user()->id : null;
            $propety_request->property_id = $request->property_id;
            $propety_request->name = $request->name;
            $propety_request->mobile = $request->mobile;
            $propety_request->email = $request->email;
            $propety_request->job_title = $request->job_title;
            $propety_request->message = $request->message;
            $propety_request->status = 0;
            $propety_request->save();

            $notify = __('Property Request Send Successfully');
            return $this->success($notify);

        } catch (Exception $e) {
            return $e->getMessage();
            return $this->serverError();
        }
    }

    public function promotionRequest(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'nullable',
            'country_id' => 'nullable',
            'city_id' => 'nullable',
            'message' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        $promotion = new PromotionRequest();
        $promotion->name = $request->name;
        $promotion->email = $request->email;
        $promotion->mobile = $request->mobile;
        $promotion->country_id = $request->country_id;
        $promotion->city_id = $request->city_id;
        $promotion->message = $request->message;
        $promotion->save();

        $notify = __('Promotion Request Send Successfully');

        return $this->success($notify);

    }
    public function assetLiabilityStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'nullable',
            'country_id' => 'nullable',
            'city_id' => 'nullable',
            'message' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        $liability = new AssetliabilitieRequest();
        $liability->name = $request->name;
        $liability->email = $request->email;
        $liability->mobile = $request->mobile;
        $liability->country_id = $request->country_id;
        $liability->city_id = $request->city_id;
        $liability->message = $request->message;
        $liability->save();

        $notify = __('Assets Liability Request Send Successfully');
        return $this->success($notify);
    }


    public function banner()
    {
        try {
            $bannerElements = getContent('banner.element', null, false, true);

            //return $bannerElements;
            $filteredElements = [];

            foreach ($bannerElements as $element) {
                $filteredElements[] = [
                    'title' => $element['data_values']->title,
                    'slider' => getImage('assets/images/frontend/banner/' . $element['data_values']->slider, '1350x360'),
                    'slider_ar' => getImage('assets/images/frontend/banner/' . $element['data_values']->slider_ar, '1350x360')
                ];
            }


            return $this->successResponse($filteredElements);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }


    public function offerRequestSection()
    {
        $promotionElements = getContent('promotion.element', null, false, true);

        if (!empty($promotionElements)) {
            $filteredElements = [];

            foreach ($promotionElements as $element) {
                if (isset($element['data_values']) && is_object($element['data_values'])) {
                    $shortDescription = isset($element['data_values']->short_description) ? $element['data_values']->short_description : '';
                    $shortDescriptionAr = isset($element['data_values']->short_description_ar) ? $element['data_values']->short_description_ar : '';

                    $filteredElements[] = [
                        'short_description' => $shortDescription,
                        'short_description_ar' => $shortDescriptionAr,
                        'image' => getImage('assets/images/frontend/promotion/' . $element['data_values']->image),
                    ];
                }
            }

            return $this->successResponse($filteredElements);
        }

        return $this->serverError('No promotion elements found.');
    }


    public function assetsAndLiabilities()
    {
        try {
            $liabilities = getContent('offer_banner.element', null, false, true);

            //return $liabilities;

            $filteredElements = [];

            foreach ($liabilities as $element) {
                $filteredElements[] = [
                    'title' => $element['data_values']->title,
                    'title_ar' => $element['data_values']->title_ar,
                    'slider' => getImage('assets/images/frontend/offer_banner/' . $element['data_values']->slider),
                ];
            }

            return $this->successResponse($filteredElements);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }

    }

    public function planOnOffers()
    {
        try {
            $floorPlanElements = getContent('floor_plan.element', null, false, true);

            //return $floorPlanElements;

            $filteredElements = [];

            foreach ($floorPlanElements as $element) {
                $filteredElements[] = [
                    'title' => $element['data_values']->title,
                    'title_ar' => $element['data_values']->title_ar,
                    'description' => $element['data_values']->description,
                    'description_ar' => $element['data_values']->description_ar,
                    'plan_image' => getImage('assets/images/frontend/floor_plan/' . $element['data_values']->plan),
                ];
            }

            return $this->successResponse($filteredElements);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function auctionSection()
    {
        $query = Auction::query();
        $auctions = $query->ifNotPending()->latest()->get();

        return $this->successResponse($auctions);
    }

    public function propertYRequestSection()
    {
        $query = PropertyRequest::query();
        $property_requests = $query->accepted()->latest()->take(10)->get();

        $data = [];

        foreach($property_requests as $property_request){
            $data[] = [
                "id"            => $property_request->id,
                "thumb_image"   => $property_request->thumb_image,
                "image_url"     => $property_request->image_url,
                "detail"        => $property_request->detail,
            ];
        }

        return $this->successResponse($data);
    }

    public function propertyCitySection()
    {
        try {
            $propertyTypes = PropertyType::active()->with('property_type_cities.city')->get();

            $elements = [];

            foreach ($propertyTypes as $propertyType) {
                $elements[] = [
                    "id" => $propertyType->id,
                    "name" => $propertyType->name,
                    "name_ar" => $propertyType->name_ar,
                    "icon" => $propertyType->icon,
                    "image_url" => getFilePath('propertyType'),
                    "property_type_cities" => $propertyType->property_type_cities->map(function ($propertyCity) {
                        return [
                            "id" => $propertyCity->id,
                            "city_id" => $propertyCity->city->id,
                            "city_name" => $propertyCity->city->name,
                            "city_name_ar" => $propertyCity->city->name_ar,
                            "image" => $propertyCity->image,
                            "image_url" => getFilePath('propertyTypeArea')
                        ];
                    }),
                ];
            }

            return $this->successResponse($elements);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function abouts()
    {
        $data = [];

        $aboutSectionContent = getContent('about_section.content', true);

        if($aboutSectionContent){
            $data = [
                "title" => $aboutSectionContent->data_values->title,
                "title_ar" => $aboutSectionContent->data_values->title_ar,
                "description" => $aboutSectionContent->data_values->description,
                "description_ar" => $aboutSectionContent->data_values->description_ar,
                "image"  =>  getImage('assets/images/frontend/about_section/' . $aboutSectionContent->data_values->image, '615x340'),
            ];
        }

        return $this->successResponse($data);

    }

    public function services()
    {
        try {
            $serviceContent = getContent('service_section.content', true);
            $serviceElements = getContent('service_section.element', null, false, true);

            $data["heading_section"] =[
                "heading"  => $serviceContent->data_values->heading,
                "heading_ar"  => $serviceContent->data_values->heading_ar
            ];

            $elements = [];

            foreach ($serviceElements as $element) {
                $elements[] = [
                    'title' => $element['data_values']->title,
                    'title_ar' => $element['data_values']->title_ar,
                    'short_description' => $element['data_values']->short_description,
                    'short_description_ar' => $element['data_values']->short_description_ar,
                    'image' => getImage('assets/images/frontend/service_section/' . $element->data_values->image, '380x235'),
                ];
            }

            $data['services'] = $elements;

            return $this->successResponse($data);
        } catch (Exception $e) {
            return $this->serverError('Something went wrong');
        }
    }

    public function marketing()
    {
        try{
            $marketingBannerContent = getContent('marketing_banner.content', true);
            $marketingSerivceElements = getContent('marketing_service.element', null, false, true);

            $data["banner_section"] =[
                "title"  => $marketingBannerContent->data_values->title,
                "title_ar"  => $marketingBannerContent->data_values->title_ar,
               // "marketing_banner"  => getImage('assets/images/frontend/marketing_banner/' . $marketingBannerContent->data_values->marketing_banner, '1900x250'),
                "image"  => getImage('assets/images/frontend/marketing_banner/' . $marketingBannerContent->data_values->image, '1900x250'),
            ];

            $elements = [];

            foreach ($marketingSerivceElements as $element) {
                $elements[] = [
                    'title' => $element->data_values->title,
                    'title_ar' => $element->data_values->title_ar,
                    'description' => $element->data_values->description,
                    'description_ar' => $element->data_values->description_ar,
                    'image' => getImage('assets/images/frontend/marketing_banner/' . $element->data_values->image, '380x235'),
                ];
            }

            $data['service_section'] = $elements;

            return $this->successResponse($data);

        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function finance()
    {
        try{
            $financeContent = getContent('finance_banner.content', true);
            $financeServiceContent = getContent('finance_service.content', true);

            $data["banner_section"] =[
                "title"  => $financeContent->data_values->title,
                "title_ar"  => $financeContent->data_values->title_ar,
                "description"  => $financeContent->data_values->description,
                "description_ar"  => $financeContent->data_values->description_ar,
                "image"  => getImage('assets/images/frontend/finance_banner/' . @$financeContent->data_values->image, '1900x250'),
            ];

            $data['service_section'] = [
                'title' => $financeServiceContent->data_values->title,
                'title_ar' => $financeServiceContent->data_values->title_ar,
                'description' => $financeServiceContent->data_values->description,
                'description_ar' => $financeServiceContent->data_values->description_ar,
                'image' =>  getImage('assets/images/frontend/finance_service/' . $financeServiceContent->data_values->image, '615x340'),
            ];

            return $this->successResponse($data);

        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function evaluationAndStudies()
    {
        try{
            $evaluationBannerContent = getContent('evaluation_banner.content', true);
            $evaluationSerivceElements = getContent('evaluation_service.element', null, false, true);
            $evaluationPlanElements = getContent('evaluation_plan.element', null, false, true);

            $data["banner_section"] =[
                "title"  => $evaluationBannerContent->data_values->title,
                "title_ar"  => $evaluationBannerContent->data_values->title_ar,
                "description"  => $evaluationBannerContent->data_values->description,
                "description_ar"  => $evaluationBannerContent->data_values->description_ar,
                "image"  => getImage('assets/images/frontend/evaluation_banner/' . $evaluationBannerContent->data_values->image, '1900x250'),
            ];

            $elements = [];

            foreach ($evaluationSerivceElements as $element) {
                $elements[] = [
                    'title' => $element->data_values->title,
                    'title_ar' => $element->data_values->title_ar,
                    'description' => $element->data_values->description,
                    'description_ar' => $element->data_values->description_ar,
                    'image' => getImage('assets/images/frontend/evaluation_service/' . $element->data_values->image, '380x235'),
                ];
            }

            $plans = [];

            foreach ($evaluationPlanElements as $element) {
                $plans[] = [
                    'title' => $element->data_values->title,
                    'title_ar' => $element->data_values->title_ar,
                    'description' => $element->data_values->description,
                    'description_ar' => $element->data_values->description_ar,
                    'image' => getImage('assets/images/frontend/evaluation_plan/' . $element->data_values->image, '80x80'),
                ];
            }

            $data['service_section'] = $elements;
            $data['plan_section'] = $plans;

            return $this->successResponse($data);

        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function socialInvestment()
    {

        try{
            $socialInvestmentBannerContent = getContent('social_investment_banner.content', true);
            $investmentSectorContent = getContent('social_investment_sector.content', true);
            $investmentSectorElements = getContent('social_investment_sector.element', null, false, true);
            $investmentContent = getContent('social_investment_service.content', true);
            $investmentElements = getContent('social_investment_service.element', null, false, true);

            //return $investmentSectorContent;


            $data["banner_section"] =[
                "title"  => $socialInvestmentBannerContent->data_values->title,
                "title_ar"  => $socialInvestmentBannerContent->data_values->title_ar,
                "description"  => $socialInvestmentBannerContent->data_values->description,
                "description_ar"  => $socialInvestmentBannerContent->data_values->description_ar,
                "image"  =>  getImage('assets/images/frontend/social_investment_banner/' . $socialInvestmentBannerContent->data_values->image, '1900x250'),
            ];



            $data["sector_content_heading"] =[
                "heading"  => $investmentSectorContent->data_values->heading,
            ];


            $elements = [];

            foreach ($investmentSectorElements as $element) {
                $elements[] = [
                    'sector_name' => $element->data_values->sector_name,
                    'sector_name_ar' => $element->data_values->sector_name_ar,
                    'image' => getImage('assets/images/frontend/social_investment_sector/' . $element->data_values->image, '310x210'),
                ];
            }



            $services = [];

            foreach ($investmentElements as $element) {
                $services[] = [
                    'title' => $element->data_values->title,
                    'title_ar' => $element->data_values->title_ar,
                ];
            }

            $data['sector_section'] = $elements;

            $data["content_heading"] =[
                "short_description"  => $investmentContent->data_values->short_description,
                "short_description_ar"  => $investmentContent->data_values->short_description_ar,
            ];

            $data['service_section'] = $services;

            return $this->successResponse($data);

        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }

    }

    public function auctionsAndEvent()
    {
        try{
            $auctionBannerContent = getContent('auction_banner.content', true);
            $auctionMethodologyContent = getContent('auction_methodology.content', true);
            $auctionMethodologyElements = getContent('auction_methodology.element', null, false, true);
            $auctionPlatformContent = getContent('auction_platforms.content', true);
            $auctionPlatformElements = getContent('auction_platforms.element', null, false, true);


            $data["banner_section"] =[
                "title"  => $auctionBannerContent->data_values->title,
                "title_ar"  => $auctionBannerContent->data_values->title_ar,
                "image"  =>  getImage('assets/images/frontend/auction_banner/' . $auctionBannerContent->data_values->image, '1900x250'),
            ];



            $data["auction_methodlogy_heading"] =[
                "heading"  => $auctionMethodologyContent->data_values->heading,
            ];


            $elements = [];

            foreach ($auctionMethodologyElements as $element) {
                $elements[] = [
                    'methodology_name' => $element->data_values->methodology_name,
                    'methodology_name_ar' => $element->data_values->methodology_name_ar,
                ];
            }



            $services = [];

            foreach ($auctionPlatformElements as $element) {
                $services[] = [
                    'image' =>getImage('assets/images/frontend/auction_platforms/' . $element->data_values->image),
                ];
            }

            $data['methodology'] = $elements;

            $data["platform_content_heading"] =[
                "heading"  => $auctionPlatformContent->data_values->heading,
                "heading_ar"  => $auctionPlatformContent->data_values->heading_ar,
            ];

            $data['platform'] = $services;

            return $this->successResponse($data);

        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function floorPlan()
    {
        try{
            $floorPlanElements = getContent('floor_plan.element', null, false, true);
            $filteredElements = [];
            foreach ($floorPlanElements as $element) {
                $filteredElements[] = [
                    'title' => $element['data_values']->title,
                    'title_ar' => $element['data_values']->title_ar,
                    'description' => $element['data_values']->description,
                    'description_ar' => $element['data_values']->description_ar,
                    'plan_image' => getImage('assets/images/frontend/floor_plan/' . $element['data_values']->plan),
                ];
            }

            return $this->successResponse($filteredElements);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function blogs()
    {
        try {
             $blogs = Blog::active()->paginate(getPaginate());
            $sections = Page::where('slug', 'blogs')->first();

            $data['blogs'] = $blogs;
            $data['sections'] = $sections;

            return $this->successResponse($data);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }

    }

    public function blogDetails($slug)
    {
        try {
            $blog = Blog::active()->where('slug', $slug)->first();
            $blog->view = $blog->view + 1;
            $blog->save();

            $recentPosts = Blog::active()->where('id', '!=', $blog->id)->orderBy('id', 'desc')->limit(5)->get();
            $popularPosts = Blog::active()->where('id', '!=', $blog->id)->orderBy('view', 'desc')->limit(5)->get();

            $data['blog'] = $blog;
            $data['recentPosts'] = $recentPosts;
            $data['popularPosts'] = $popularPosts;

            return $this->successResponse($data);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }


        return view('web.blog_details', compact('blog', 'recentPosts', 'popularPosts'));
    }

    public function events()
    {
        try{
            $data['top_event'] = Event::active()->latest()->take(3)->with('country', 'city', 'category')->get();
            $data['events'] = Event::active()->with('country', 'city', 'category')->skip(3)->paginate(getPaginate());
            return $this->successResponse($data);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function eventFilterData()
    {
        try{
            $eventTypeElements = getContent('event_type.element', null, false, true);
            $audienceTypeElements = getContent('audience_type.element', null, false, true);
            $eventSectorElements = getContent('event_sector.element', null, false, true);

            $event_types_element = [];

            foreach ($eventTypeElements as $element) {
                $event_types_element[] = [
                    'title' => $element->data_values->title,
                    'title_ar' => $element->data_values->title_ar,
                ];
            }

            $audience_types_element = [];

            foreach ($audienceTypeElements as $element) {
                $audience_types_element[] = [
                    'title' => $element->data_values->title,
                    'title_ar' => $element->data_values->title_ar,
                ];
            }

            $event_sectors = [];

            foreach ($eventSectorElements as $element) {
                $event_sectors[] = [
                    'title' => $element->data_values->title,
                    'title_ar' => $element->data_values->title_ar,
                ];
            }

            $data['event_categories'] = AllCategory::where('type', 'event')->get();
            $data['event_types'] = $event_types_element;
            $data['audience_types'] = $audience_types_element;
            $data['event_sectors'] = $event_sectors;

            return $this->successResponse($data);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function eventFilter(Request $request)
    {
        try{
            $query = Event::query();

            if ($request->category != 0) {
                $query->where('category_id', $request->category);
            }

            if ($request->audience_type != 0) {
                $query->where('audience_type', $request->audience_type);
            }

            if ($request->sector != 0) {
                $query->where('sector', $request->sector);
            }

            if ($request->type != 0) {
                $query->where('type', $request->type);
            }

            $query->active()->with('country', 'city', 'category');

            $data = $query->paginate(getPaginate());

            return $this->successResponse($data);

        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }

        return view('web.pages.includes.__event_filter', compact('events'))->render();
    }


    public function eventDetails($slug)
    {
        try{
            $event = Event::active()->with('country', 'city', 'category')->where('slug', $slug)->first();
            return $this->successResponse($event);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }

    }

    public function eventNews()
    {
        try{
            $event_news =  EventNews::active()->latest()->paginate(getPaginate());
            return $this->successResponse($event_news);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function eventNewsDetails($slug)
    {
        try{
            $data['event'] = EventNews::active()->where('slug', $slug)->first();
            $data['recent_posts'] = EventNews::active()->latest()->take(4)->get();
            return $this->successResponse($data);
        }catch(Exception $e){
            return $this->serverError('Something went wrong');
        }
    }

    public function eventAskFormSubmit(Request $request)
    {
        $request->validate([
            "event_id"      => "required|exists:events,id",
            "name"          => "required|max:140",
            "phone"         => "required|max:140",
            "email"         => "required|max:140",
            "city"          => "required|max:140",
            "message"       => "required",
        ]);

        try{

            $eventAsk = new EventAsk();
            $eventAsk->event_id = $request->event_id;
            $eventAsk->name = $request->name;
            $eventAsk->phone = $request->phone;
            $eventAsk->email = $request->email;
            $eventAsk->city = $request->city;
            $eventAsk->message = $request->message;
            $eventAsk->save();

            $message = __('Event ask send success');
            return $this->success($message);

        }catch (Exception $exp){
            return $this->serverError('Something went wrong');
        }
    }


    public function requestPropertyRequestStore(Request $request, $id)
    {
        if(!$id){
            $message = __('Something went wrong. Please try again');
            return $this->serverError($message);
        }

        $validator = Validator::make($request->all(),[
            // "property_request_id" => "nullable",
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

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        try{
            $propertyRequest = new PropertyFormRequest();
            $propertyRequest->property_request_id = $id;
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

            $message = __('Property request successfully!');
            return $this->success($message);
        }catch (Exception $exp){
            return $this->serverError('Something went wrong');
        }
    }

}
