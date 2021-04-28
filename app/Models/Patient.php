<?php

namespace App\Models;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $patient = 'tdd_patient';
    protected $fillable = ['ptn_first_name','ptn_middle_name','ptn_last_name','ptn_dob','ptn_age','ptn_gender','ptn_address','ptn_state','ptn_district','ptn_tahsil','ptn_city','ptn_pincode','added_by','modify_date_sync', 'ptn_isdeleted'];
    
    public static function patientRecWithId($patientId){
        return  DB::table('tdd_patient as ptn')
            ->select('ptn.*','dst.dst_code','dst.dst_name','st.st_code','st.st_name','thl.thl_code','thl.thl_name','cty.cty_id','cty.cty_name','sch.school_name')
            ->leftJoin('tdd_mas_states as st','ptn.ptn_state','=','st.st_code')  
            ->leftJoin('tdd_mas_districts as dst','ptn.ptn_district','=','dst.dst_code')
            ->leftJoin('tdd_mas_tahshil as thl','ptn.ptn_tahsil','=','thl.thl_code')
            ->leftJoin('tdd_mas_city as cty','ptn.ptn_city','=','cty.cty_id') 
            ->leftJoin('tdd_school as sch','ptn.ptn_school_id','=','sch.pk_id')  
            ->where('ptn.pk_id',$patientId)
            ->get();
    }
    public static function get_patient(){
        return  DB::table('tdd_patient as ptn') 
            ->where('ptn.ptn_isdeleted','0')
            ->get();
    }
    public static function save_patient_basic_info($data,$ptn_id){
        $chk_rec = DB::table('tdd_patient_basic_info')
                    ->where('patient_id',$ptn_id)
                    ->get();
        // print_r($chk_rec);die;
        if(count($chk_rec) == 0){
            // echo '1';
            $data['added_by'] = Auth::user()->clg_first_name;
            $data['added_date'] = date('Y-m-d H:i:s');
            $data['patient_id'] = $ptn_id;
            $chk_rec = DB::table('tdd_patient_basic_info')
                    ->where('patient_id',$ptn_id)
                    ->insert($data);
        }else{ 
            // echo '2';
            $data['modify_by'] = Auth::user()->clg_first_name;
            $data['modify_date'] = date('Y-m-d H:i:s');
            $chk_rec = DB::table('tdd_patient_basic_info')
                    ->where('patient_id',$ptn_id)
                    ->update($data);
            return DB::table('tdd_patient_basic_info')
            ->where('patient_id',$ptn_id)
            ->get();
        }
    }
}
