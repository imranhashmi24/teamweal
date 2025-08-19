<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuctionController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\AuthorizationController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ForgotPasswordController;
use Maatwebsite\Excel\Row;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ForgotPasswordController::class)->prefix('password')->group(function () {
    Route::post('email', 'sendResetCodeEmail');
    Route::post('verify-code', 'verifyCode');
    Route::post('set-new-password', 'resetPassword');
});



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('check-user', [AuthController::class, 'checkUser']);

Route::middleware('auth:api')->group(function () {
    Route::controller(AuthorizationController::class)->group(function () {
        Route::get('resend-verify', 'sendVerifyCode');
        Route::post('verify-email', 'emailVerification');
        Route::post('verify-mobile', 'mobileVerification');
    });
});


Route::get('/countries', [ApiController::class, 'countries']);
Route::get('/all-countries', [ApiController::class, 'allcountries']);
Route::get('/cities/{country_id}', [ApiController::class, 'cities']);
Route::get('/property-type', [ApiController::class, 'propertyType']);
Route::get('/sub-property-type/{property_type_id}', [ApiController::class, 'subPropertyType']);
Route::get('get-property', [ApiController::class,'getProperty']);
Route::get('get-properties-map', [ApiController::class,'getMapProperty']);
Route::get('get-property-details/{slug}', [ApiController::class,'getPropertyDetail']);

// home pages
Route::controller(ApiController::class)->group(function () {
    Route::get('banners', 'banner');
    Route::get('offer-request-section', 'offerRequestSection');
    Route::get('assets-and-liabilities', 'assetsAndLiabilities');
    Route::get('plan-on-offers', 'planOnOffers');
    Route::get('auction-section', 'auctionSection');
    Route::get('property-request-section', 'propertYRequestSection');
    Route::get('property-city-section', 'propertyCitySection');

    Route::group(['prefix' => 'pages'], function(){
        Route::get('abouts', 'abouts');
        Route::get('services', 'services');
        Route::get('marketing', 'marketing');
        Route::get('finance', 'finance');
        Route::get('evaluation-and-studies', 'evaluationAndStudies');
        Route::get('social-investment', 'socialInvestment');
        Route::get('auctions-and-event', 'auctionsAndEvent');
        Route::get('floor-plans', 'floorPlan');
        Route::get('blogs', 'blogs');
        Route::get('blog-details/{slug}', 'blogDetails');

        // event route
        Route::get('events', 'events');
        Route::get('event-form-data', 'eventFilterData');
        Route::get('event-filter', 'eventFilter');
        Route::get('events-details/{slug}', 'eventDetails');
        Route::get('event-news', 'eventNews');
        Route::get('events-news-details/{slug}', 'eventNewsDetails');
        Route::post('event-ask-form-submit', 'eventAskFormSubmit');
    });
});

// auction routes

Route::get('auctions', [AuctionController::class,'auctions']);
Route::get('auction/details/{slug}', [AuctionController::class,'auctionDetails']);
Route::get('auctions-maps/{id?}', [AuctionController::class,'auctionMap']);
Route::post('auction-request-form-store/{id}', [AuctionController::class, 'requestAuctionRequestStore']);


Route::controller(ApiController::class)->group(function () {
    Route::get('sectors', 'sectors');
    Route::post('service-request', 'serviceRequestStore');
    Route::post('marketing-request', 'marketingRequestStore');
    Route::post('finance-request', 'financeRequestStore');
    Route::post('social-investment', 'socialInvestmentStore');
    Route::post('property/request/send', 'propertyRequestSend');
    Route::post('/property-request', 'propertyRequestStore');
    Route::post('business-post-req', 'businessPostReq');
    Route::post('promotion-request', 'promotionRequest');
    Route::post('assets-liability-request-store', 'assetLiabilityStore');
    Route::post('property-request-store/{id}', 'requestPropertyRequestStore');
});

Route::middleware(['auth:api', 'check.status.api'])->group(function(){
    Route::controller(ProfileController::class)->prefix('user')->group(function () {
        Route::get('profile-setting', 'profile');
        Route::post('profile-setting', 'submitProfile');
        Route::post('change-password', 'submitPassword');
    });

    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('statics', 'dashboard');
    });

    Route::group(['prefix' => 'properties'], function () {
        Route::get('/', [PropertyController::class, 'index']);
        Route::get('/pending', [PropertyController::class, 'pending']);
        Route::get('/published', [PropertyController::class, 'published']);
        Route::get('/review', [PropertyController::class, 'review']);
        Route::get('/rejected', [PropertyController::class, 'rejected']);
        Route::post('/store', [PropertyController::class, 'store']);
        Route::post('/update/{id}', [PropertyController::class, 'update']);
        Route::get('/edit/{id}', [PropertyController::class, 'edit']);
        Route::get('/show/{id}', [PropertyController::class, 'show']);
    });

    Route::post('add-or-remove-favorite', [FavoriteController::class, 'store']);
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorite-remove/{id}', [FavoriteController::class, 'remove']);

    Route::post('bidding-offer-request', [AuctionController::class, 'biddingOfferSend']);
});

