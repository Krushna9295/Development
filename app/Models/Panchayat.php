<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Panchayat extends Model
{
    protected $collection = 'tdd_panchayat_samiti';
    protected $fillable = ['panchayat_name', 'panchayat_contact_no', 'panchayat_age', 'panchayat_gender', 'panchayat_address','panchayat_state','panchayat_district', 'panchayat_tahsil', 'panchayat_city', 'panchayat_added_by','panchayat_added_date', 'panchayat_is_deleted'];
    
    public static function get_Panchayat(){
        return DB::table('tdd_panchayat_samiti as pan') 
            ->where('pan.panchayat_is_deleted','0')
            ->orderBy('pan.panchayat_id', 'ASC')
            ->get();
    }
    public static function get_hosp_as_per_id($panchayatId){
        return DB::table('tdd_panchayat_samiti as pan') 
        ->where('pan.panchayat_id ',$panchayatId)
        ->get();
    }
    public static function update_hosp_data($data,$panchayatId){
        DB::table('tdd_panchayat_samiti as pan') 
        ->where('pan.panchayat_id ',$panchayatId)
        ->update($data);
    }
    public static function delete_hosp($updated_data,$panchayatId){
        DB::table('tdd_panchayat_samiti as pan') 
        ->where('pan.panchayat_id ',$panchayatId)
        ->update($updated_data);
        return 1;
    }
}
