<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $collection = 'tdd_mas_states';
    protected $fillable = ['st_code', 'st_name','stis_deleted'];

    public static function get_State(){
        return  DB::table('tdd_mas_states as state') 
            ->where('state.stis_deleted','0')
            ->orderBy('st_name', 'ASC')
            ->get();
    }
    public static function get_state_as_per_name($statename){
        return  DB::table('tdd_mas_states as state') 
            ->where('st_code','like', $statename)
            ->get();
    }
}
