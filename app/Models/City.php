<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $collection = 'tdd_mas_city';
    protected $fillable = ['cty_name','cty_thshil_code','cty_dist_code','ctyis_deleted'];

    public static function get_City(){
        return  DB::table('tdd_mas_city as city') 
            ->where('city.ctyis_deleted','0')
            ->orderBy('cty_name', 'ASC')
            ->get();
    }
    public static function get_city_tahsil($tahshil){
        return  DB::table('tdd_mas_city as city') 
            ->where('city.cty_thshil_code',$tahshil)
            ->get();
    }
    public static function get_city_as_per_name($cityname){
        return  DB::table('tdd_mas_city as city') 
            ->where('city.cty_name','like',$cityname)
            ->get();
    }
}
