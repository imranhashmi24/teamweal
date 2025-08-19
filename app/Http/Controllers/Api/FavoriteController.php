<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        $perPage = getPaginate();
        $page = request()->get('page', 1);

        $paginatedProperties = auth()->user()->favorites->map(function($favorite) {
            return $favorite->property;
        });

        $properties = new LengthAwarePaginator(
            $paginatedProperties->forPage($page, $perPage),
            $paginatedProperties->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return $this->successResponse($properties, 'My Favorite Property');

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "property_id" => "required|exists:properties,id"
        ]);

        if($validator->fails()){
            return $this->validationError($validator->errors());
        }

        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)->where('property_id', $request->property_id)->first();

        if($favorite){
            $favorite->delete();

            return response()->json([
                "status"  => false,
                "message" => __('Remove favorite successful')
            ], 200);

        }else{
            Favorite::create([
                "user_id"      => Auth::user()->id,
                "property_id"  => $request->property_id
            ]);

            return response()->json([
                "status"  => true,
                "message" => __('Added favorite successful')
            ], 200);
        }

    }


    public function remove(Request $request, $id)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('property_id', $id)->first();

        $favorite->delete();

        $message = __('Favorite remove successfully');

        return $this->success($message);
    }
}
