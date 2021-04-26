<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Tahsil extends Model
{
    protected $collection = 'tdd_mas_tahshil';
    protected $fillable = ['thl_code', 'thl_name', 'thl_district_code', 'thl_status','thlis_deleted'];

    public static function get_tahsil(){
        return  DB::table('tdd_mas_tahshil as thl') 
                ->where('thl.thlis_deleted','0')
                ->orderBy('thl.thl_name', 'ASC')
                ->get();
    }
    public static function get_tahsil_district($district){
        return  DB::table('tdd_mas_tahshil as thl') 
            ->where('thl.thl_district_code',$district)
            ->get();
    }
    public static function get_tahshil_as_per_name($tahsilname){
        return  DB::table('tdd_mas_tahshil as thl') 
            ->where('thl.thl_name','like',$tahsilname)
            ->get();
    }
}
