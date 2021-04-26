<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $collection = 'tdd_hospital';
    protected $fillable = ['hp_name', 'hp_type', 'hp_area_type', 'hp_mobile', 'hp_person_name','hp_person_mobile','hp_register_no', 'hp_email', 'hp_url', 'hp_geo_fence','hp_address', 'hp_state','hp_district','hp_tahsil','hp_city','hp_area','hp_landmark','hp_lane_street','hp_house_no','hp_pincode','created_at','updated_at', 'hpis_deleted'];
    
    public static function get_hospital(){
        return DB::table('tdd_hospital as hp') 
            ->where('hp.hpis_deleted','0')
            ->orderBy('hp.hp_id', 'ASC')
            ->get();
    }
    public static function get_hosp_as_per_id($hospitalId){
        return DB::table('tdd_hospital as hp') 
        ->where('hp.hp_id',$hospitalId)
        ->get();
    }
    public static function update_hosp_data($data,$hospitalId){
        DB::table('tdd_hospital as hp') 
        ->where('hp.hp_id',$hospitalId)
        ->update($data);
    }
    public static function delete_hosp($updated_data,$hospitalId){
        DB::table('tdd_hospital as hp') 
        ->where('hp.hp_id',$hospitalId)
        ->update($updated_data);
        return 1;
    }
}
