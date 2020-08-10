<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopTags extends Model
{
    protected $table = 'shop_tag_map';
    public function addTag($shop_id, $data){
        $shop_details =array();
        $exists = ShopTags::select('*')
            ->where('shop_id','=',$shop_id)
            ->exists();

        if($exists){

            $shop_details = ShopTags::select('*')
                ->where('shop_id','=',(int)$shop_id)
                ->delete();
            foreach ($data as $d){
                $shop_details[] = ShopTags::insert(
                    [
                        'shop_id' => $shop_id,
                        'tag_name' => $d,
                        'tag_id' => 0
                    ]
                );
            }
        }else{

            foreach ($data as $d){
                $shop_details[] = ShopTags::insert(
                    [
                        'shop_id' => $shop_id,
                        'tag_name' => $d,
                        'tag_id' => 0
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
    public function getTagDetails($shop_id){

        $shop_details = ShopTags::select('*')
            ->where('shop_id','=',(int)$shop_id)
            ->exists();
        if($shop_details){
            $shop_details = ShopTags::select('*')
                ->where('shop_id','=',(int)$shop_id)
                ->get();
            $res = array(
                'shop_details' => $shop_details,
                'message'=> 'Success'
            );

        }else{
            $res = array(
                'shop_details' => "",
                'message'=> 'Error. Shop Tag not found'
            );
        }

        return $res;
    }
}
