<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $collection = 'tdd_mas_groups';
    protected $fillable = ['ugname', 'gcode', 'glevel', 'status','is_deleted','gparent', 'modify_date_sync'];
   
    public static function get_groups(){
        return DB::table('tdd_mas_groups as grp') 
            ->where('grp.is_deleted','0')
            ->get();
    }
    
}
