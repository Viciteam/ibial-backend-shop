<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCategories extends Model
{
    protected $table = 'shop_category_map';
    public function addCategory($shop_id, $data){
        $shop_details =array();
        $exists = ShopCategories::select('*')
            ->where('shop_id','=',$shop_id)
            ->exists();

        if($exists){

            $shop_details = ShopCategories::select('*')
                ->where('shop_id','=',(int)$shop_id)
                ->delete();
            foreach ($data as $d){
                $shop_details[] = ShopCategories::insert(
                    [
                        'shop_id' => $shop_id,
                        'category_name' => $d,
                        'category_id' => 0
                    ]
                );
            }
        }else{

            foreach ($data as $d){
                $shop_details[] = ShopCategories::insert(
                    [
                        'shop_id' => $shop_id,
                        'category_name' => $d,
                        'category_id' => 0
                    ]
                );
            }
        }

        $res = array(
            'shop_details' => $shop_details,
            'message'=> 'Tags successfully added'
        );
        return $res;
    }
    public function getCategoryDetails($shop_id){

        $shop_details = ShopCategories::select('*')
            ->where('shop_id','=',(int)$shop_id)
            ->exists();
        if($shop_details){
            $shop_details = ShopCategories::select('*')
                ->where('shop_id','=',(int)$shop_id)
                ->get();
            $res = array(
                'shop_details' => $shop_details,
                'message'=> 'Success'
            );

        }else{
            $res = array(
                'shop_details' => "",
                'message'=> 'Error. Shop Category not found'
            );
        }

        return $res;
    }
}
