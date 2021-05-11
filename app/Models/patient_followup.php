<?php

namespace App\Models;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class patient_followup extends Model
{
    protected $patient_followup = 'tdd_patient_follow_up';
    protected $fillable = ['ptn_id','followup_blood_inv','followup_hrct','followup_chest_x_ray','followup_ref_doc_name','followup_ref_doc_cont_no','followup_atnd_doc_name','followup_atnd_doc_cont_no','followup_hosp_name','followup_hosp_cont_no','followup_status','followup_remark', 'followup_added_date','followup_added_by'];
    
    public static function patientFollowupRecWithId($patientId){
        return  DB::table('tdd_patient_follow_up as ptnfollo')
            ->select('ptnfollo.*')  
            ->where('ptnfollo.ptn_id',$patientId)
            ->where('ptnfollo.ptn_followup_from_hosp_iso','hosp')
            ->get();
    }
}
