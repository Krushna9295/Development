<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $collection = 'tdd_mas_area_types';
    protected $fillable = ['ar_name','aris_deleted','current_date_sync'];

    public static function get_area_type(){
        return DB::table('tdd_mas_area_types as ar') 
            ->where('ar.aris_deleted','0')
            ->orderBy('ar.ar_id', 'ASC')
            ->get();
    }
}
