<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Controllers;

use App\Models\Area;
use App\Models\State;
use App\Models\District;

use App\Models\Tahsil;
use App\Models\City;
use App\Models\Student;
use App\Models\panchayat;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Session;
use MongoDB\BSON\ObjectId;


class PanchayatController extends Controller
{
    public function index()
    {
        $panchayatData = Panchayat::get_Panchayat();
        return view('panchayat/panchayat_list',['panchayatData' => $panchayatData]);
    }
    public function create(){
        // $panchayat_type = panchayat_type::get_panchayat_type();     
        // $area = Area::get_area_type();     
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $city = City::get_City();
        $action = 'Add New Panchayat';
        $disabled = "";
        $form_submit_url = " route( 'panchayat.store' ) ";
        return view('panchayat/panchayat_view',[  
                                'state' => $state,
                                'district' => $district,
                                'tahsil' => $tahsil,
                                'city' => $city,
                                // 'panchayat_type' => $panchayat_type,
                                // 'area' => $area,
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
            'hp_added_by' => Auth::user()->clg_ref_id,
            'hp_added_date' => date('Y-m-d H:i:s')
        );
        if ($validatedData->passes()) {
            $student = DB::table('tdd_panchayat')->insert($data);
            Session::flash('success', 'panchayat Registration Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function edit($panchayatId)
    { 
        // $panchayat_type = panchayat_type::get_panchayat_type();     
        $area = Area::get_area_type();     
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $city = City::get_City();
        $panchayat = panchayat::get_pan_as_per_id($panchayatId);
        $action = 'Update panchayat';
        $disabled = "";
        $panId = $panchayat[0]->hp_id;
        $form_submit_url = "panchayat.update, $panId ";
        return view('panchayat.panchayat_view', [  
                                'state' => $state,
                                'district' => $district,
                                'tahsil' => $tahsil,
                                'city' => $city,
                                // 'panchayat_type' => $panchayat_type,
                                'area' => $area,
                                'form_submit_url'=> $form_submit_url, 
                                'action'=> $action,
                                'disabled' => $disabled,
                                'panchayat' => $panchayat[0] ]);
    }
    public function update(Request $request, $panchayatId)
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
            'hp_added_by' => Auth::user()->clg_ref_id,
            'hp_added_date' => date('Y-m-d H:i:s')
        );
        if ($validatedData->passes()) {
            $show =  panchayat::update_pan_data($data,$panchayatId);
            Session::flash('success', 'panchayat Updated Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function show($panchayatId)
    {
        // $panchayat_type = panchayat_type::get_panchayat_type();     
        $area = Area::get_area_type();     
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $city = City::get_City();
        $panchayat = panchayat::get_pan_as_per_id($panchayatId);
        $action = 'View panchayat';
        $disabled = "disabled = 'disabled'";
        $panId = $panchayat[0]->hp_id;
        $form_submit_url = "panchayat.update, $panId ";
        return view('panchayat.panchayat_view', [  
            'state' => $state,
            'district' => $district,
            'tahsil' => $tahsil,
            'city' => $city,
            // 'panchayat_type' => $panchayat_type,
            'area' => $area,
            'form_submit_url'=> $form_submit_url, 
            'action'=> $action,
            'disabled' => $disabled,
            'panchayat' => $panchayat[0] ]);
    }
    public function destroy($panchayatId)
    {
        // echo $panchayatId;
      $updated_data = ['hpis_deleted'=> '1'];
      $show =  panchayat::delete_pan($updated_data,$panchayatId);
      if($show == 1){
        return redirect()->route('panchayat.list')
        ->with('success','panchayat Deleted Successfully.');   
      }
    }
}
