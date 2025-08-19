<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Country;
use App\Models\Property;
use App\Traits\ApiResponse;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertyImage;
use App\Services\PropertyCrud;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Property\PropertyRequest;

class PropertyController extends Controller
{
    use ApiResponse;
    protected $error_message = "Something went wrong";

    protected $propertyCrud;

    public function __construct(PropertyCrud $propertyCrud)
    {
        return $this->propertyCrud = $propertyCrud;
    }

    public function index()
    {
        $properties = $this->propertyData();

        $images = [];



        return $this->successResponse($properties, 'properties');
    }

    public function pending()
    {
        $properties = $this->propertyData('pending');

        return $this->successResponse($properties, 'pending');
    }

    public function review()
    {
        $properties = $this->propertyData('review');
        return $this->successResponse($properties, 'review');
    }

    public function rejected()
    {
        $properties = $this->propertyData('rejected');
        return $this->successResponse($properties, 'rejected');
    }

    public function published()
    {
        $properties = $this->propertyData('published');
        return $this->successResponse($properties, 'published');
    }

    protected function propertyData($scope = null)
    {
        if ($scope) {
            $properties = Property::$scope();
        } else {
            $properties = Property::query();
        }

        return $properties->latest()
            ->where('user_id', auth()->user()->id)
            ->paginate(getPaginate());
    }


    public function store(PropertyRequest $request)
    {
        try {

            $property = new Property();

            $storeProperty = $this->propertyCrud->storeProperty($property, $request);

            $this->propertyCrud->propertyDetailStore($storeProperty, $request);

            if ($storeProperty && $request->hasFile('thumb_image')) {
                try {
                    $old = $storeProperty->images;
                    $storeProperty->thumb_image = fileUploader($request->thumb_image, getFilePath('property_thumb'), getFileSize('property_thumb'), $old);
                    $storeProperty->save();
                } catch (\Exception $e) {
                    $message = __('Couldn\'t upload your image');
                    return $this->notFound($message);
                }
            }

            $image = $this->insertImages($request, $storeProperty, $id = 0);

            if (!$image) {
               $message = "Couldn\'t upload account listing images";
               return $this->notFound($message);
            }

            $message = __('Property create successfully');

            return $this->successResponse($property, $message);

        } catch (Exception $e) {
            return $e->getMessage();
            return $this->serverError();
        }
    }

    public function status($id)
    {
        try {
            Property::changeStatus($id);

            return $this->success(__('Status change successful'));
        } catch (Exception $e) {
            return $this->serverError();
        }
    }

    public function edit($id)
    {
        $property = Property::with('details')->findOrFail($id);
        $propertyTypes = PropertyType::get();

        $images = [];

        foreach ($property->images as $key => $image) {
            $img['id'] = $image->id;
            $img['src'] = getImage(getFilePath('property') . '/' . $image->image);
            $images[] = $img;
        }

        $data = [
            "property"       => $property,
            "propertyTypes"  => $propertyTypes,
            "images"         => $images

        ];

        return $this->successResponse($data, 'Edit Property');

    }

    public function update(PropertyRequest $request, $id)
    {

        $request->validate([
            'thumb_image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        try {

            $property = Property::findOrFail($id);

            $storeProperty = $this->propertyCrud->storeProperty($property, $request);

            $this->propertyCrud->propertyDetailUpdate($storeProperty, $request);

            if ($storeProperty && $request->hasFile('thumb_image')) {
                try {
                    $old = $storeProperty->images;
                    $storeProperty->thumb_image = fileUploader($request->thumb_image, getFilePath('property_thumb'), getFileSize('property_thumb'), $old);
                    $storeProperty->save();
                } catch (\Exception $e) {
                    $message = __('Couldn\'t upload your image');
                    return $this->notFound($message);
                }
            }

            $image = $this->insertImages($request, $storeProperty, $id);

            if (!$image) {
                $message = __('Property create successfully');

                return $this->successResponse($property, $message);
            }

            $message = __('Property update successfully');

            return $this->successResponse($property, $message);

        } catch (Exception $e) {

            return $this->serverError();
        }
    }

    public function show($id)
    {
        $property = Property::with('propertyType', 'country', 'city', 'subPropertyType', 'details')->findOrFail($id);


        $images =  [];

        foreach ($property->images as $key => $image) {
            $img['id'] = $image->id;
            $img['src'] = getImage(getFilePath('property') . '/' . $image->image);
            $images[] = $img;
        }

        // add thum image path

        unset($property->images);

        $data = [
            "property" => $property,
            "propertyImages" => $images,
        ];


        return $this->successResponse($data, 'property show');
    }

    protected function insertImages($request, $storeProperty, $id)
    {
        $path = getFilePath('property');

        if ($id) {
            $this->removeImages($request, $storeProperty, $path);
        }

        $hasImages = $request->file('images');

        if ($hasImages) {
            $size = getFileSize('property');
            $images = [];

            foreach ($hasImages as $file) {
                try {
                    $name = fileUploader($file, $path, $size, null);
                    $image = new PropertyImage();
                    $image->property_id = $storeProperty->id;
                    $image->image = $name;
                    $images[] = $image;
                } catch (\Exception $exp) {
                    return false;
                }
            }
            $storeProperty->images()->saveMany($images);
        }
        return true;
    }

    protected function removeImages($request, $storeProperty, $path)
    {
        $previousImages = $storeProperty->images->pluck('id')->toArray();
        $imageToRemove = array_values(array_diff($previousImages, $request->old ?? []));

        foreach ($imageToRemove as $item) {
            $propertyImage = PropertyImage::find($item);
            fileManager()->removeFile($path . '/' . $propertyImage->image);
            $propertyImage->delete();
        }
    }
}
