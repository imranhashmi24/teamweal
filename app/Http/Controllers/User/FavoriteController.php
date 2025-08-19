<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class FavoriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $perPage = getPaginate();
        $page = request()->get('page', 1);

        $paginatedProperties = auth()->user()->favorites->map(function($favorite) {
            return $favorite;
        });

        $favorites = new LengthAwarePaginator(
            $paginatedProperties->forPage($page, $perPage),
            $paginatedProperties->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('user.favorite.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "property_id" => "required|exists:properties,id"
        ]);

        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)->where('property_id', $request->property_id)->first();

        if($favorite){
            $favorite->delete();

            return response()->json([
                "status"  => false,
                "message" => __('Remove favorite successful')
            ]);

        }else{
            Favorite::create([
                "user_id"      => Auth::user()->id,
                "property_id"  => $request->property_id
            ]);

            return response()->json([
                "status"  => true,
                "message" => __('Added favorite successful')
            ]);
        }

    }


    public function remove(Request $request, $id)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('property_id', $id)->first();

        $favorite->delete();

        $message = 'Favorite remove successfully';
        return $this->redirectNotify('success', $message, 'user.favorite.index');
    }
}
