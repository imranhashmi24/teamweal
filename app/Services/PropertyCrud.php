<?php

namespace App\Services;

use App\Models\Form;
use App\Models\PropertyDetail;

class PropertyCrud {

    public function storeProperty($property, $request)
    {
        $property->user_id           = auth()->check() ? auth()->user()->id : null;
        $property->title             = $request->title;
        $property->title_ar          = $request->title_ar;
        $property->slug              = $request->slug;
        $property->property_type_id  = $request->property_type_id;
        $property->subproperty_type_id  = $request->subproperty_type_id;
        $property->construction_type = $request->construction_type;
        $property->purpose           = $request->purpose;
        $property->electricity       = $request->electricity;
        $property->water             = $request->water;
        $property->length            = $request->length;
        $property->width             = $request->width;
        $property->age               = $request->age;
        $property->bed_rooms         = $request->bed_rooms;
        $property->bath_rooms        = $request->bath_rooms;
        $property->living_room       = $request->living_room;
        $property->guest_room        = $request->guest_room;
        $property->land_area         = $request->land_area;
        $property->build_up_area     = $request->build_up_area;
        $property->description       = $request->description;
        $property->description_ar    = $request->description_ar;
        $property->price             = $request->price;
        $property->sqr_price         = $request->sqr_price;
        $property->reference_no      = $request->reference_no;
        $property->country_id        = $request->country_id;
        $property->city_id           = $request->city_id;
        $property->address           = $request->address;
        $property->latitude          = $request->latitude;
        $property->longitude         = $request->longitude;
        $property->features          = $request->features;
        $property->features_ar       = $request->features_ar;
        $property->fixtures          = $request->fixtures;
        $property->fixtures_ar       = $request->fixtures_ar;
        $property->street            = $request->street;
        $property->street_width      = $request->street_width;
        $property->facing            = $request->facing;
        $property->ad_license_number = $request->ad_license_number;

        $property->save();

        return $property;
    }


    public function propertyDetailStore($property, $request)
    {
        $gn_name = "propert_type_form_" .$request->property_type_id;
        $formData = Form::where('act', $gn_name)->first();

        if ($formData) {
            foreach ($formData->form_data as $fieldName => $fieldData) {
                $propertyDetail = new PropertyDetail();
                $propertyDetail->property_id = $property->id;
                $propertyDetail->field = $fieldName;
                $propertyDetail->val = $request->$fieldName;
                $propertyDetail->save();
            }
        }
    }


    public function propertyDetailUpdate($property, $request)
    {
        if($property->details){
            foreach($property->details as $detail)
            {
                $detail->delete();
            }

            $gn_name = "propert_type_form_" .$request->property_type_id;
            $formData = Form::where('act', $gn_name)->first();

            if ($formData) {
                foreach ($formData->form_data as $fieldName => $fieldData) {
                    $propertyDetail = new PropertyDetail();
                    $propertyDetail->property_id = $property->id;
                    $propertyDetail->field = $fieldName;
                    $propertyDetail->val = $request->$fieldName;
                    $propertyDetail->save();
                }
            }
        }
    }
}

?>
