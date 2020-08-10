<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model{
    protected $table = 'shop';
    protected $fillable = [
        'name', 'is_private', 'is_visible','status_id','views','created_by'
    ];
    public function getShopDetails($shop_id){

        $shop_details = Shop::select('*')
            ->where('id','=',(int)$shop_id)
            ->exists();
        if($shop_details){
            $shop_details = Shop::select('*')
                ->where('id','=',(int)$shop_id)
                ->first();
            $res = array(
                'shop_details' => $shop_details,
                'message'=> 'Success'
            );

        }else{
            $res = array(
                'shop_details' => "",
                'message'=> 'Error. Shop not found'
            );
        }

        return $res;
    }
    public function createShop($data){
        $exists = Shop::select('*')
            ->where('name','=',$data->get('name'))
            ->exists();

        if($exists){
            $res = array(
                'shop_details' => "",
                'message'=> 'Error. Shop name is already taken'
            );
        }else{
            $create_shop = Shop::create([
                'name' => $data->get('name'),
                'is_private' => $data->get('is_private'),
                'is_visible' => $data->get('is_visible'),
                'status_id' => 5,
                'views' => 0,
                'created_by' => $data->get('user_id')
            ]);
            $res = array(
                'shop_details' => $create_shop,
                'message'=> 'Shop successfully created'
            );
        }
        return $res;
    }
    public function updateShopPrivacy($shop_id, $data){
        $exists = Shop::select('*')
            ->where('id','=',$shop_id)
            ->exists();

        if($exists){

            if(($data['is_private'] == 1 || $data['is_private'] == 0 ) && ($data['is_visible'] == 1 || $data['is_visible'] == 0)){
                $shop_details = Shop::select('*')
                    ->where('id','=',(int)$shop_id)
                    ->first();
                if(!empty($data['is_private'])){
                    $shop_details->is_private = $data['is_private'];
                }
                if(!empty($data['is_visible'])){
                    $shop_details->is_visible = $data['is_visible'];
                }
                if($shop_details->isDirty()){
                    $shop_details = $shop_details->save();
                    $message = "Updated Successfully.";
                }else{
                    $shop_details = false;
                    $message = "No Changes have been made.";
                }
            }else{
                $shop_details = false;
                $message = "Please check the posted data.";
            }


        }else{
            $shop_details = false;
            $message = "No Shop Found";
        }

        $res = array(
            'shop_details' => $shop_details,
            'message'=> $message
        );
        return $res;
    }
    public function updateShopViews($shop_id){
        $shop_details =array();
        $exists = Shop::select('*')
            ->where('id','=',$shop_id)
            ->exists();

        if($exists){
            $shop_details = Shop::select('*')
                ->where('id','=',(int)$shop_id)
                ->first();
            $shop_details->views = $shop_details->views + 1;
            if($shop_details->isDirty()){
                $shop_details = $shop_details->save();
                $shop_details = $shop_details;
            }else{
                $shop_details = false;

            }
        }else{
            $shop_details = false;

        }

        $res = array(
            'shop_details' => $shop_details,
        );
        return $res;
    }
    public function updateShopProfile($shop_id, $data){
        $exists = Shop::select('*')
            ->where('id','=',$shop_id)
            ->exists();

        if($exists){

            $shop_details = Shop::select('*')
                ->where('id','=',(int)$shop_id)
                ->first();

            if(!empty($data['category'])){
                $shop_details->category = $data['category'];
            }else{
                $res = array(
                    'shop_details' => false,
                    'message'=> 'Category is required.'
                );
                return $res;
            }
            if(!empty($data['address'])){
                $shop_details->address = $data['address'];
            }else{
                $res = array(
                    'shop_details' => false,
                    'message'=> 'Address is required.'
                );
                return $res;
            }
            if(!empty($data['city'])){
                $shop_details->city = $data['city'];
            }else{
                $res = array(
                    'shop_details' => false,
                    'message'=> 'City is required.'
                );
                return $res;
            }
            if(!empty($data['state'])){
                $shop_details->state = $data['state'];
            }else{
                $res = array(
                    'shop_details' => false,
                    'message'=> 'State is required.'
                );
                return $res;
            }
            if(!empty($data['zip'])){
                $shop_details->zip = $data['zip'];
            }else{
                $res = array(
                    'shop_details' => false,
                    'message'=> 'Zip is required.'
                );
                return $res;
            }
            if(!empty($data['contact_no'])){
                $shop_details->contact_no = $data['contact_no'];
            }else{
                $res = array(
                    'shop_details' => false,
                    'message'=> 'Contact number is required.'
                );
                return $res;
            }


            if($shop_details->isDirty()){
                $shop_details = $shop_details ->save();
                $res = array(
                    'shop_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'shop_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'shop_details' => false,
                'message'=> "No Shop Found"
            );
            return $res;

        }


    }
    public function updateShopProfilePic($data){

        $exists = Shop::select('*')
            ->where('id','=',(int)$data->get('id'))
            ->exists();

        if($exists){

            $shop_details = Shop::select('*')
                ->where('id','=',(int)$data->get('id'))
                ->first();
            if($data->has('file')){
                $fileName = $data->get('id')."_profile.".$data->file->extension();
                $data->file->move(public_path('uploads'), $fileName);
                $shop_details->profile_picture = $fileName;
            }
            if($shop_details->isDirty()){
                $shop_details = $shop_details->save();
                $res = array(
                    'shop_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'Shop_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'Shop_details' => false,
                'message'=> 'No Shop Found.'
            );
            return $res;
        }


    }
    public function updateShopCoverPhoto($data){

        $exists = Shop::select('*')
            ->where('id','=',(int)$data->get('id'))
            ->exists();

        if($exists){

            $shop_details = Shop::select('*')
                ->where('id','=',(int)$data->get('id'))
                ->first();
            if($data->has('file')){
                $fileName = $data->get('id')."_cover_photo.".$data->file->extension();
                $data->file->move(public_path('uploads'), $fileName);
                $shop_details->cover_photo = $fileName;
            }
            if($shop_details->isDirty()){
                $shop_details = $shop_details->save();
                $res = array(
                    'shop_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'shop_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'shop_details' => false,
                'message'=> 'No Shop Found.'
            );
            return $res;
        }


    }
    public function addCategory($shop_id){
        $shop_details =array();
        $exists = Shop::select('*')
            ->where('id','=',$shop_id)
            ->exists();

        if($exists){
            $shop_details = Shop::select('*')
                ->where('id','=',(int)$shop_id)
                ->first();
            $shop_details->views = $shop_details->views + 1;
            if($shop_details->isDirty()){
                $shop_details = $shop_details->save();
                $shop_details = $shop_details;
            }else{
                $shop_details = false;

            }
        }else{
            $shop_details = false;

        }

        $res = array(
            'shop_details' => $shop_details,
        );
        return $res;
    }
    public function getCategoryDetails($shop_id){

        $shop_details = Shop::select('*')
            ->where('id','=',(int)$shop_id)
            ->exists();
        if($shop_details){
            $shop_details = Shop::select('*')
                ->where('id','=',(int)$shop_id)
                ->first();
            $res = array(
                'shop_details' => $shop_details,
                'message'=> 'Success'
            );

        }else{
            $res = array(
                'shop_details' => "",
                'message'=> 'Error. Shop not found'
            );
        }

        return $res;
    }
}
