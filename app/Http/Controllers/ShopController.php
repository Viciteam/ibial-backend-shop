<?php

namespace App\Http\Controllers;

use App\Shop;
use App\ShopCategories;
use App\ShopTags;
use Illuminate\Http\Request;

class ShopController extends Controller{
    public function createShop(Request $request){
        $shop = new Shop();
        $shop_create = $shop->createShop($request->json());
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_create['shop_details'],
            'message' => $shop_create['message']
        );
        return $response;

    }
    public function getShopDetails($id){
        $shop = new Shop();
        $shop_details = $shop->getShopDetails($id);
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_details['shop_details'],
            'message' => $shop_details['message']
        );

        return $response;
    }

    public function updateShopPrivacy($id, Request $request){
        $shop = new Shop();
        $shop_update = $shop->updateShopPrivacy($id, $request);
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details'],
            'message' => $shop_update['message']
        );

        return $response;
    }

    public function updateShopViews($id){
        $shop = new Shop();
        $shop_update = $shop->updateShopViews($id);
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details']
        );

        return $response;
    }

    public function updateShopProfile($id,  Request $request){

        $shop = new Shop();
        $shop_update = $shop->updateShopProfile($id,$request);
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details'],
            'message' => $shop_update['message']
        );

        return $response;
    }
    public function updateShopProfilePic(Request $request){
        $shop = new Shop();
        $shop_update = $shop->updateShopProfilePic($request);
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details'],
            'message' => $shop_update['message']
        );

        return $response;
    }

    public function updateShopCoverPhoto(Request $request){

        $shop = new Shop();
        $shop_update = $shop->updateShopCoverPhoto($request);
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details'],
            'message' => $shop_update['message']
        );

        return $response;
    }

    public function addCategory($id, Request $request){
        $shop = new ShopCategories();
        $shop_update = $shop->addCategory($id, $request->json());
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details'],
            'message' => $shop_update['message']
        );
        return $response;
    }
    public function getCategoryDetails($id){
        $shop = new ShopCategories();
        $shop_update = $shop->getCategoryDetails($id);
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details'],
            'message' => $shop_update['message']
        );
        return $response;
    }

    public function addTag($id, Request $request){
        $shop = new ShopTags();
        $shop_update = $shop->addTag($id, $request->json());
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details'],
            'message' => $shop_update['message']
        );
        return $response;
    }
    public function getTagDetails($id){
        $shop = new ShopTags();
        $shop_update = $shop->getTagDetails($id);
        $response = array(
            'status' => http_response_code(),
            "data" => $shop_update['shop_details'],
            'message' => $shop_update['message']
        );
        return $response;
    }

}
