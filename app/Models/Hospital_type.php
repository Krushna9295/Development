<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Hospital_type extends Model
{
    protected $collection = 'tdd_mas_hospital_type';
    protected $fillable = ['ht_name','ht_is_deleted','current_date_sync'];

    public static function get_hospital_type(){
        return DB::table('tdd_mas_hospital_type as ht') 
            ->where('ht.ht_is_deleted','0')
            ->orderBy('ht.ht_id', 'ASC')
            ->get();
    }
}
