<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Patient;
use App\Models\patient_followup;
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
class PatientController extends Controller
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        // $patientData = DB::table('tdd_patient')->where('ptn_isdeleted','0')->orderBy('pk_id','ASC')->get();
        $patientData = DB::table('tdd_patient')->where('ptn_isdeleted','0')->where('ptn_status','0')->orWhere('ptn_status','followup')->orderBy('pk_id','ASC')->get();
        return view('patient/patient_list',['patientData' => $patientData]);
    }
    public function create(){
        $state = DB::table('tdd_mas_states')->where('stis_deleted', '0')->orderBy('st_name', 'ASC')->get();
        $district = DB::table('tdd_mas_districts')->where('dstis_deleted', '0')->orderBy('dst_name', 'ASC')->get();
        $tahsil = DB::table('tdd_mas_tahshil')->where('thlis_deleted', '0')->orderBy('thl_name', 'ASC')->get();
        $city = DB::table('tdd_mas_city')->where('ctyis_deleted', '0')->orderBy('cty_name', 'ASC')->get();
        
        $oral_medicine = DB::table('tdd_mas_patient_medicine')->where('med_is_deleted', '0')->orderBy('med_name', 'ASC')->get();
        $injectable = DB::table('tdd_mas_patient_injectable')->where('inj_is_deleted', '0')->orderBy('inj_name', 'ASC')->get();
        $comorbidity = DB::table('tdd_mas_patient_comorbidity')->where('com_is_deleted', '0')->orderBy('com_name', 'ASC')->get();
        $action = 'Add New Patient';
        $disabled = "";
        $form_submit_url = "patient.store";
        return view('patient/patient_view',[  
                'form_submit_url'=> $form_submit_url, 
                'action'=> $action,
                'disabled' => $disabled,
                'state' => $state,
                'district' => $district,
                'tahsil' => $tahsil,
                'city' => $city,
                'medicine' => $oral_medicine,
                'injectable' =>  $injectable,
                'comorbidity' => $comorbidity]);
    }
    public function store(Request $request){
        // $data['data'] = (($request->ptn_invistigation));
        // echo json_encode($data);
        // die;
        // $patient = new patient; 
        $validatedData = Validator::make($request->all(), [
            'ptn_name' => 'required|alpha',
            'ptn_age' => 'required|numeric',
            'ptn_gender' => 'required',
            'ptn_contact_no' => 'required|numeric',
        ]);
        $date = str_replace('-','',date('Y-m-d'));
        $time = str_replace(':','',date('H:i:s'));
        /*Create patient Registration Number */
        // $ref_id_first = trim($request->ptn_name);
        // $ref_id_midle = trim($request->ptn_middle_name);
        // $ref_id_last =  trim($request->ptn_last_name);
        // $ref_rand = rand(1000, 9999).'_'.$ref_id_first.'_'.$ref_id_midle.'_'.$ref_id_last;
        // $ref_rand = strtoupper($ref_rand);
        /*End patient Registration Number */
        $data = array(
            'ptn_name' => $request->ptn_name,
            'ptn_age' => $request->ptn_age,
            'ptn_gender' => $request->ptn_gender,
            'ptn_contact_no' => $request->ptn_contact_no,
            'ptn_address' => $request->ptn_address,
            'ptn_state' => $request->ptn_state,
            'ptn_district' => $request->ptn_district,
            'ptn_tahsil' => $request->ptn_tahsil,
            'ptn_city' => $request->ptn_city,
            'ptn_covid_test' => $request->ptn_covid_test,
            'ptn_report' => $request->ptn_report,
            'ptn_report_date' => $request->ptn_report_date,
            'ptn_report_center_name' => $request->ptn_report_center_name,
            'ptn_date_set_illness' => $request->ptn_date_set_illness,
            'ptn_puls_rate' => $request->ptn_puls_rate,
            'ptn_bp_systolic' => $request->ptn_bp_systolic,
            'ptn_bp_diastolic' => $request->ptn_bp_diastolic,
            'ptn_rr' => $request->ptn_rr,
            'ptn_temp' => $request->ptn_temp,
            'ptn_other_comorbidity' => $request->ptn_other_comorbidity,
            'ptn_comorbidity' => $request->ptn_comorbidity,
            'ptn_comorbidity_other_remark' => $request->ptn_comorbidity_other_remark,
            'ptn_hrct' => $request->ptn_hrct,
            'ptn_x_ray' => $request->ptn_x_ray,
            'ptn_ecg' => $request->ptn_ecg,
            'ptn_invistigation' => json_encode($request->ptn_invistigation),
            'ptn_oral_medicine' => json_encode($request->ptn_oral_medicine),
            'ptn_injectable' => json_encode($request->ptn_injectable),
            'ptn_isdeleted' => '0',
            'added_by' => Auth::user()->clg_ref_id,
            'modify_by' => Auth::user()->clg_ref_id,
            'added_date' => date('Y-m-d H:i:s')
        );
        // print_r($data);die;
        if ($validatedData->passes()) {
            $patient = DB::table('tdd_patient')->insert($data);
            Session::flash('success', 'Patient Added Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function edit($patientId)
    { 
        $state = DB::table('tdd_mas_states')->where('stis_deleted', '0')->orderBy('st_name', 'ASC')->get();
        $district = DB::table('tdd_mas_districts')->where('dstis_deleted', '0')->orderBy('dst_name', 'ASC')->get();
        $tahsil = DB::table('tdd_mas_tahshil')->where('thlis_deleted', '0')->orderBy('thl_name', 'ASC')->get();
        $city = DB::table('tdd_mas_city')->where('ctyis_deleted', '0')->orderBy('cty_name', 'ASC')->get();
        
        $patient = patient::patientRecWithId($patientId);
        $action = 'Update Patient';
        $disabled = "";
        $stuId = $patient[0]->pk_id;
        $form_submit_url = "patient.update, $stuId ";
        return view('patient.patient_view', [  
                    'form_submit_url'=> $form_submit_url, 
                    'action'=> $action,
                    'disabled' => $disabled,
                    'patient' => $patient[0],
                    'state' => $state,
                    'district' => $district,
                    'tahsil' => $tahsil,
                    'city' => $city ]);
    }
    public function update(Request $request, $patientId)
    {
        $validatedData = Validator::make($request->all(), [
            'ptn_first_name' => 'required|alpha',
            'ptn_middle_name' => '',
            'ptn_last_name' => 'required|alpha',
            'ptn_dob' => '',
            'ptn_age' => 'required|numeric',
            'ptn_gender' => 'required',
            'ptn_father_occupation' => '',
            'ptn_adhar_no' => '',
            'ptn_ins_no' => '',
            'deworning' => '',
            'ptn_address' => '',
            'ptn_district' => '',
            'ptn_city' => '',
            'ptn_area' => '',
            'ptn_landmark' => '',
            'ptn_lane_street' => '',
            'ptn_house_no' => '',
            'ptn_pincode' => '',
        ]);
        if ($validatedData->passes()) {
            $data = array(
                'ptn_first_name' => $request->ptn_first_name,
                'ptn_middle_name' => $request->ptn_middle_name,
                'ptn_last_name' => $request->ptn_last_name,
                'ptn_dob' => $request->ptn_dob,
                'ptn_age' => $request->ptn_age,
                'ptn_gender' => $request->ptn_gender,
                'ptn_father_occupation' => $request->ptn_father_occupation,
                'ptn_adhar_no' => $request->ptn_adhar_no,
                'ptn_ins_no' => $request->ptn_ins_no,
                'deworning' => $request->deworning,
                'ptn_address' => $request->ptn_address,
                'ptn_state' => $request->ptn_state,
                'ptn_district' => $request->ptn_district,
                'ptn_tahsil' => $request->ptn_tahsil,
                'ptn_city' => $request->ptn_city,
                'ptn_area' => $request->ptn_area,
                'ptn_landmark' => $request->ptn_landmark,
                'ptn_lane_street' => $request->ptn_lane_street,
                'ptn_house_no' => $request->ptn_house_no,
                'ptn_pincode' => $request->ptn_pincode,
                'ptn_isdeleted' => '0'
            );
            DB::table('tdd_patient')->where('pk_id',$patientId)->update($data); 
            Session::flash('success', 'patient Updated Successfully.'); 
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function show($patientId)
    {
        $state = DB::table('tdd_mas_states')->where('stis_deleted', '0')->orderBy('st_name', 'ASC')->get();
        $district = DB::table('tdd_mas_districts')->where('dstis_deleted', '0')->orderBy('dst_name', 'ASC')->get();
        $tahsil = DB::table('tdd_mas_tahshil')->where('thlis_deleted', '0')->orderBy('thl_name', 'ASC')->get();
        $city = DB::table('tdd_mas_city')->where('ctyis_deleted', '0')->orderBy('cty_name', 'ASC')->get();
        
        $patient = patient::patientRecWithId($patientId);
        $action = 'View patient';
        $disabled = "disabled = 'disabled'";
        return view('patient.patient_view', [  
            'action'=> $action,
            'disabled' => $disabled,
            'patient' => $patient[0],
            'state' => $state,
            'district' => $district,
            'tahsil' => $tahsil,
            'city' => $city ]);
    }
    public function destroy($patientId)
    {
      $updated_data = array('ptn_isdeleted'=> '1');
      $show =  DB::table('tdd_patient')->where('pk_id',$patientId)->update($updated_data);
      return redirect()->route('patient.list')
      ->with('success','Patient Deleted Successfully.');
    }
    public function follow_up_create($patientId){
        $data['action'] = 'Follow Up';
        $data['patient'] = patient::patientRecWithId($patientId);
        // print_r($data);
        return view('patient.follow_up_create',$data);
    }
    public function follow_up_store(Request $request){
        $validatedData = Validator::make($request->all(), [
            'followup_atnd_doc_name' => 'required',
            'followup_hosp_name' => 'required',
            'followup_status' => 'required',
        ]);
        $data = array(
            'ptn_id' => $request->patientId,
            'followup_blood_inv' => json_encode($request->followup_blood_inv),
            'followup_hrct' => $request->followup_hrct,
            'followup_chest_x_ray' => $request->followup_chest_x_ray,
            'followup_ref_doc_name' => $request->followup_ref_doc_name,
            'followup_ref_doc_cont_no' => $request->followup_ref_doc_cont_no,
            'followup_atnd_doc_name' => $request->followup_atnd_doc_name,
            'followup_atnd_doc_cont_no' => $request->followup_atnd_doc_cont_no,
            'followup_hosp_name' => $request->followup_hosp_name,
            'followup_hosp_cont_no' => $request->followup_hosp_cont_no,
            'followup_status' => $request->followup_status,
            'followup_remark' => $request->followup_remark,
            'followup_added_by' => Auth::user()->clg_ref_id,
            'followup_added_date' => date('Y-m-d H:i:s')
        );
        $ptn['ptn_status'] = $request->followup_status;
        if ($validatedData->passes()) {
            $patient = DB::table('tdd_patient_follow_up')->insert($data);
            DB::table('tdd_patient')->where('pk_id',$request->patientId)->update($ptn);
            Session::flash('success', 'Patient Followup Added Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    function follow_up_view($patientId){
        $data['patientFollowup'] = patient_followup::patientFollowupRecWithId($patientId);
        // print_r( $data['patient']);die;
        $data['action'] = 'Patient Followup View';
        return view('patient.follow_up_view',$data);
    }
}
