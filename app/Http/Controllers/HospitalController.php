<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Controllers;

use App\Models\Area;
use App\Models\Hospital_type;
use App\Models\State;
use App\Models\District;

use App\Models\Tahsil;
use App\Models\City;
use App\Models\Student;
use App\Models\Hospital;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Session;
use MongoDB\BSON\ObjectId;


class HospitalController extends Controller
{
    public function index()
    {
        $hospitalData = Hospital::get_hospital();
        return view('hospital/hospital_list',['hospitalData' => $hospitalData]);
    }
    public function create(){
        $hospital_type = Hospital_type::get_hospital_type();     
        $area = Area::get_area_type();     
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $city = City::get_City();
        $action = 'Add New Hospital';
        $disabled = "";
        $form_submit_url = " route( 'hospital.store' ) ";
        return view('hospital/hospital_view',[  
                                'state' => $state,
                                'district' => $district,
                                'tahsil' => $tahsil,
                                'city' => $city,
                                'hospital_type' => $hospital_type,
                                'area' => $area,
                                'form_submit_url'=> $form_submit_url, 
                                'action'=> $action,
                                'disabled' => $disabled ]);
    }
    public function store(Request $request){
        $validatedData = Validator::make($request->all(), [
            'hp_name' => 'required|alpha',
            'hp_type' => 'required',
            'hp_area_type' => 'required',
            'hp_mobile' => ['required', 'numeric', 'digits_between:10,12'],
            'hp_register_no' => 'required|numeric',
            'hp_email' => 'email',
            'hp_url' => '',
            'hp_geo_fence' => 'required',
            'hp_address' => 'required',
            'hp_state' => 'required',
            'hp_district' => 'required',
            'hp_tahsil' => 'required',
            'hp_city' => 'required',
            'hp_area' => '',
            'hp_landmark' => '',
            'hp_lane_street' => '',
            'hp_house_no' => '',
            'hp_pincode' => ''
        ]);
        $data = array(
            'hp_name' => $request->hp_name,
            'hp_type' => $request->hp_type,
            'hp_area_type' => $request->hp_area_type,
            'hp_mobile' => $request->hp_mobile,
            'hp_register_no' => $request->hp_register_no,
            'hp_email' => $request->hp_email,
            'hp_url' => $request->hp_url,
            'hp_geo_fence' => $request->hp_geo_fence,
            'hp_address' => $request->hp_address,
            'hp_state' => $request->hp_state,
            'hp_district' => $request->hp_district,
            'hp_tahsil' => $request->hp_tahsil,
            'hp_city' => $request->hp_city,
            'hp_area' => $request->hp_area,
            'hp_landmark' => $request->hp_landmark,
            'hp_lane_street' => $request->hp_lane_street,
            'hp_house_no' => $request->hp_house_no,
            'hp_pincode' => $request->hp_pincode,
            'hpis_deleted' => '0',
            'hp_added_by' => Auth::user()->clg_first_name,
            'hp_added_date' => date('Y-m-d H:i:s')
        );
        if ($validatedData->passes()) {
            $student = DB::table('tdd_hospital')->insert($data);
            Session::flash('success', 'Hospital Registration Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function edit($hospitalId)
    { 
        $hospital_type = Hospital_type::get_hospital_type();     
        $area = Area::get_area_type();     
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $city = City::get_City();
        $hospital = Hospital::get_hosp_as_per_id($hospitalId);
        $action = 'Update Hospital';
        $disabled = "";
        $hospId = $hospital[0]->hp_id;
        $form_submit_url = "hospital.update, $hospId ";
        return view('hospital.hospital_view', [  
                                'state' => $state,
                                'district' => $district,
                                'tahsil' => $tahsil,
                                'city' => $city,
                                'hospital_type' => $hospital_type,
                                'area' => $area,
                                'form_submit_url'=> $form_submit_url, 
                                'action'=> $action,
                                'disabled' => $disabled,
                                'hospital' => $hospital[0] ]);
    }
    public function update(Request $request, $hospitalId)
    {
        $validatedData = Validator::make($request->all(), [
            'hp_name' => 'required|alpha',
            'hp_type' => 'required',
            'hp_area_type' => 'required',
            'hp_mobile' => ['required', 'numeric', 'digits_between:10,12'],
            'hp_register_no' => 'required|numeric',
            'hp_email' => 'email',
            'hp_url' => '',
            'hp_geo_fence' => 'required',
            'hp_address' => 'required',
            'hp_state' => 'required',
            'hp_district' => 'required',
            'hp_tahsil' => 'required',
            'hp_city' => 'required',
            'hp_area' => '',
            'hp_landmark' => '',
            'hp_lane_street' => '',
            'hp_house_no' => '',
            'hp_pincode' => ''
        ]);
        $data = array(
            'hp_name' => $request->hp_name,
            'hp_type' => $request->hp_type,
            'hp_area_type' => $request->hp_area_type,
            'hp_mobile' => $request->hp_mobile,
            'hp_register_no' => $request->hp_register_no,
            'hp_email' => $request->hp_email,
            'hp_url' => $request->hp_url,
            'hp_geo_fence' => $request->hp_geo_fence,
            'hp_address' => $request->hp_address,
            'hp_state' => $request->hp_state,
            'hp_district' => $request->hp_district,
            'hp_tahsil' => $request->hp_tahsil,
            'hp_city' => $request->hp_city,
            'hp_area' => $request->hp_area,
            'hp_landmark' => $request->hp_landmark,
            'hp_lane_street' => $request->hp_lane_street,
            'hp_house_no' => $request->hp_house_no,
            'hp_pincode' => $request->hp_pincode,
            'hpis_deleted' => '0',
            'hp_added_by' => Auth::user()->clg_first_name,
            'hp_added_date' => date('Y-m-d H:i:s')
        );
        if ($validatedData->passes()) {
            $show =  Hospital::update_hosp_data($data,$hospitalId);
            Session::flash('success', 'Hospital Updated Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function show($hospitalId)
    {
        $hospital_type = Hospital_type::get_hospital_type();     
        $area = Area::get_area_type();     
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $city = City::get_City();
        $hospital = Hospital::get_hosp_as_per_id($hospitalId);
        $action = 'View Hospital';
        $disabled = "disabled = 'disabled'";
        $hospId = $hospital[0]->hp_id;
        $form_submit_url = "hospital.update, $hospId ";
        return view('hospital.hospital_view', [  
            'state' => $state,
            'district' => $district,
            'tahsil' => $tahsil,
            'city' => $city,
            'hospital_type' => $hospital_type,
            'area' => $area,
            'form_submit_url'=> $form_submit_url, 
            'action'=> $action,
            'disabled' => $disabled,
            'hospital' => $hospital[0] ]);
    }
    public function destroy($hospitalId)
    {
        // echo $hospitalId;
      $updated_data = ['hpis_deleted'=> '1'];
      $show =  Hospital::delete_hosp($updated_data,$hospitalId);
      if($show == 1){
        return redirect()->route('hospital.list')
        ->with('success','Hospital Deleted Successfully.');   
      }
    }
}
