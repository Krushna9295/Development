<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Patient;
use App\Models\Isolation_followup;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Session;
use DB;
use Auth;
use App\Models\State;
use App\Models\District;
use App\Models\Tahsil;
use App\Models\City;
use MongoDB\BSON\ObjectId;
class HomeIsolationController extends Controller
{
    public function follow_up_create($patientId){
        $data['action'] = 'Follow Up';
        $data['patient'] = Patient::patientRecWithId($patientId);
        $patientFollowup = isolation_followup::patientFollowupRecWithId($patientId);
        $data['patientFollowup'] = $patientFollowup;
        // print_r($data);
        return view('isolation.follow_up_create',$data);
    }
    public function follow_up_store(Request $request){
        $validatedData = Validator::make($request->all(), [
            'iso_followup_call_status' => 'required',
            'iso_close_call' => 'required',
        ]);
        $data = array(
            'ptn_id' => $request->patientId,
            'iso_followup_call_status' => $request->iso_followup_call_status,
            'iso_followup_call_not_con' => $request->iso_followup_call_not_con,
            'iso_call_not_con_other_res' => $request->iso_call_not_con_other_res,
            'iso_on_set_of_illness' => $request->iso_on_set_of_illness,
            'iso_doctor_name' => $request->iso_doctor_name,
            'iso_doctor_cont_no' => $request->iso_doctor_cont_no,
            'iso_test_inv_advised' => $request->iso_test_inv_advised,
            'iso_t_t_givenor_adv_given' => json_encode($request->iso_t_t_givenor_adv_given),
            'iso_t_t_givenor_adv_given_other' => $request->iso_t_t_givenor_adv_given_other,
            'iso_no_visit_date_wise_t_t' => $request->iso_no_visit_date_wise_t_t,
            'iso_breath' => $request->iso_breath,
            'iso_chest_pain' => $request->iso_chest_pain,
            'iso_fever' => $request->iso_fever,
            'iso_cough' => $request->iso_cough,
            'iso_diarrhea' => $request->iso_diarrhea,
            'iso_comorbidity' => json_encode($request->iso_comorbidity),
            'iso_comorbidity_other' => $request->iso_comorbidity_other,
            'iso_spo_two' => $request->iso_spo_two,
            'iso_pulse' => $request->iso_pulse,
            'iso_rr' => $request->iso_rr,
            'iso_remark' => $request->iso_remark,
            'iso_close_call' => $request->iso_close_call,
            'followup_added_by' => Auth::user()->clg_ref_id,
            'followup_added_date' => date('Y-m-d H:i:s'),
            'ptn_followup_from_hosp_iso' => 'iso'
        );
        
        if ($validatedData->passes()) {
            $isolation = DB::table('tdd_patient_follow_up')->insert($data);
            if($request->iso_close_call == '2'){
                $callStatus['ptn_iso_followup_call_status'] = '1';
                DB::table('tdd_patient')->where('pk_id',$request->patientId)->update($callStatus);
            }
            Session::flash('success', 'Followup Added Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    function follow_up_view($isolationId){
        $data['patientFollowup'] = isolation_followup::patientFollowupRecWithId($isolationId);
        // print_r( $data['patientFollowup']);die;
        $data['action'] = 'Isolation Followup View';
        return view('isolation.follow_up_view',$data);
    }
}
