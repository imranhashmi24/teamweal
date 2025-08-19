<?php

namespace App\Traits;

use App\Models\Auction;
use App\Models\AuctionImage;
use App\Models\AuctionProject;
use Exception;
use Illuminate\Support\Facades\Auth;

trait AuctionTrait
{
    public function auctionData($scope = null)
    {
        if ($scope) {
            $properties = Auction::$scope();
        } else {
            $properties = Auction::query();
        }

        return $properties->searchable(['country:name', 'city:name'])->latest()->paginate(getPaginate());
    }

    public function storeAuction($auction, $request)
    {
        $auction->admin_id = Auth::guard('admin')->user()->id;
        $auction->title = $request->title;
        $auction->title_ar = $request->title_ar;
        $auction->slug = $request->slug;
        $auction->auction_day = $request->auction_day;
        $auction->auction_date = $request->auction_date;
        $auction->beginning_time = $request->beginning_time;
        $auction->country_id = $request->country_id;
        $auction->city_id = $request->city_id;
        $auction->latitude = $request->latitude;
        $auction->longitude = $request->longitude;
        $auction->address = $request->address;
        $auction->description = $request->description;
        $auction->description_ar = $request->description_ar;
        $auction->status = $request->status;
        $auction->save();

        return $auction;
    }
    public function insertDocument($auction, $request)
    {

        if ($request->hasFile('document') && $request->file('document')->getClientOriginalExtension() === 'pdf') {

            $path = 'assets/documents/';

            $filename = $request->file('document')->getClientOriginalName() . '-' . time() . '.' . $request->file('document')->getClientOriginalExtension();

            $request->file('document')->move($path, $filename);

            if (!empty($auction->document)) {
                if (file_exists($auction->document)) {
                    unlink($auction->document);
                }
            }

            $auction->document = $path . $filename;
            $auction->save();

            return true;
        }

        return false;
    }

    public function insertImages($request, $storeAuction, $id = null)
    {
        $path = getFilePath('auction');

        if ($id) {
            $this->removeImages($request, $storeAuction, $path);
        }

        $hasImages = $request->file('images');

        if ($hasImages) {
            $size = getFileSize('property');
            $images = [];

            foreach ($hasImages as $file) {
                try {
                    $name = fileUploader($file, $path, $size, null);
                    $image = new AuctionImage();
                    $image->auction_id = $storeAuction->id;
                    $image->image = $name;
                    $images[] = $image;
                } catch (\Exception $exp) {
                    return false;
                }
            }

            $storeAuction->images()->saveMany($images);
        }
        return true;
    }

    public function removeImages($request, $storeAuction, $path)
    {
        $previousImages = $storeAuction->images->pluck('id')->toArray();
        $imageToRemove = array_values(array_diff($previousImages, $request->old ?? []));

        foreach ($imageToRemove as $item) {
            $auctionImage = AuctionImage::find($item);
            fileManager()->removeFile($path . '/' . $auctionImage->image);
            $auctionImage->delete();
        }
    }


    public function auctionProperty($auction, $request)
    {

        if ($request->property_ids) {
            foreach ($request->property_ids as $property_id) {
                $auctionProject = new AuctionProject();
                $auctionProject->auction_id = $auction->id;
                $auctionProject->property_id = $property_id;
                $auctionProject->save();
            }
        }
    }


    public function auctionPropertyUpdate($auction, $request)
    {
        if($auction->properties){
            foreach($auction->properties as $property)
            {
                $property->delete();
            }

            $this->auctionProperty($auction, $request);
        }
    }
}
