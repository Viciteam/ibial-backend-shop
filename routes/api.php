<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'checktoken'], function(){ // Custom Token Auth middleware
    Route::group([
        'prefix' => 'shop',
    ], function () {
        Route::post("add", 'ShopController@createShop'); //create shop
        Route::get("/{id}", 'ShopController@getShopDetails'); //get shop details
        Route::put("update/{id}/shop-privacy", 'ShopController@updateShopPrivacy'); //update privacy
        Route::put("update/{id}/shop-views", 'ShopController@updateShopViews'); // update number of views
        Route::put("update/{id}/shop-profile", 'ShopController@updateShopProfile'); // update shop profile
        Route::post("update/shop-profile-pic", 'ShopController@updateShopProfilePic'); // update shop profile pic
        Route::post("update/shop-cover-photo", 'ShopController@updateShopCoverPhoto'); // update shop cover photo

        Route::put("/category/{id}", 'ShopController@addCategory'); //add category // performs delete insert
        Route::get("/category/{id}", 'ShopController@getCategoryDetails'); //get shop categories


        Route::put("/tags/{id}", 'ShopController@addTag'); //add category // performs delete insert
        Route::get("/tags/{id}", 'ShopController@getTagDetails'); //get shop categories



    });
});
