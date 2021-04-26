<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $collection = 'tdd_mas_districts';
    protected $fillable = ['dst_code', 'dst_name', 'dst_state','dstis_deleted','modify_date_sync'];

    public static function get_District(){
        return  DB::table('tdd_mas_districts as dst') 
            ->where('dst.dstis_deleted','0')
            ->orderBy('dst_name', 'ASC')
            ->get();
    }
    public static function get_district_state($state){
        return  DB::table('tdd_mas_districts') 
            ->where('dst_state', $state)
            ->get();
    }
    public static function get_district_as_per_name($districtname){
        return  DB::table('tdd_mas_districts') 
            ->where('dst_name','like', $districtname)
            ->get();
    }
}
