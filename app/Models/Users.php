<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// // use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model;

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Users extends Model 
{
    // use HasFactory;
    protected $collection = 'users';
    protected $fillable = ['clg_first_name', 'clg_mid_name','clg_last_name','clg_mobile_no','email','password','clg_dob','clg_joining_date','clg_group','clg_ref_id','clg_atc','clg_cluster','clg_city','clg_gender','clg_marital_status','clg_address','clg_current_salary','clg_po','clg_image','clg_is_deleted', 'updated_at', 'created_at'];

    public static function get_users(){
        return  DB::table('users') 
                ->where('clg_is_deleted','0')
                ->orderBy('id', 'ASC')
                ->get();
    }
    public static function delete_user($updated_data,$userId){
        DB::table('users as usr') 
            ->where('usr.id',$userId)
            ->update($updated_data);
    }
    public static function get_user_as_per_id($userId){
        return  DB::table('users') 
                ->where('id',$userId)
                ->get();
    }
    public static function update_users_data($data,$userId){
        return  DB::table('users') 
                ->where('id',$userId)
                ->update($data);
    }
}
