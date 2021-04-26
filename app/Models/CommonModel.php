<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    public static function get_auditary(){
        return DB::table('tdd_mas_auditary')->where('auditary_isdeleted','0')->orderBy('auditary_title', 'ASC')->get();
    }
    public static function get_opthalmological(){
        return DB::table('tdd_mas_opthalmological')->where('opthalmological_isdeleted','0')->orderBy('opthalmological_title', 'ASC')->get();
    }
    public static function get_birth_effect(){
        return DB::table('tdd_mas_birth_effects')->where('birth_effects_isdeleted','0')->orderBy('birth_effects_title', 'ASC')->get();
    }
    public static function get_child_disease(){
        return DB::table('tdd_mas_childhood_disease')->where('childhood_disease_isdeleted','0')->orderBy('childhood_disease_title', 'ASC')->get();
    }
    public static function get_skin_condition(){
        return DB::table('tdd_mas_skin_condition')->where('skin_condition_isdeleted','0')->orderBy('skin_condition_title', 'ASC')->get();
    }
    public static function get_deficiencies(){
        return DB::table('tdd_mas_deficiencies')->where('deficiencies_isdeleted','0')->orderBy('deficiencies_title', 'ASC')->get();
    }
    public static function get_normal_checkbox(){
        return DB::table('tdd_mas_normal_checkbox')->where('normal_checkbox_isdeleted','0')->orderBy('normal_checkbox_title', 'ASC')->get();
    }
    public static function get_diagnosis(){
        return DB::table('tdd_mas_diagnosis')->where('diagnosis_isdeleted','0')->orderBy('diagnosis_title', 'ASC')->get();
    }
    public static function gen(){
       DB::table('tdd_incidence')->where('inc_ref_id', DB::raw("(select max(`inc_ref_id`) from tdd_incidence)"))->get();
    }
}
