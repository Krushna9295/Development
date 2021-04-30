<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers;
use App\Models\Users;
use App\Models\Cluster;
use App\Models\Groups;
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


class UserController extends Controller
{
    public function index()
    {
        $userData = Users::get_users();
        return view('user/user_list',['userData' => $userData]);
    }
    public function create(){
  
        $groups = Groups::get_groups();   
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $city = City::get_City(); 
        $action = 'Register New User';
        $disabled = "";
        $form_submit_url = "route('user.store')";
        return view('user/user_view',[  
                                // 'cluster' => $cluster,
                                'groups' => $groups,
                                'state' => $state,
                                'district' => $district,
                                'tahsil' => $tahsil,
                                // 'atc' => $atc,
                                // 'po' => $po,
                                'form_submit_url'=> $form_submit_url, 
                                'action'=> $action,
                                'disabled' => $disabled,
                                'city' => $city ]);
    }
    public function store(Request $request){  
     
        $validatedData = Validator::make($request->all(),[

            'clg_first_name' => 'required',
            'clg_mid_name' => '',
            'clg_last_name' => 'required',
            'clg_mobile_no' =>  ['required', 'numeric', 'digits_between:10,12'],
            'email' => 'email|unique:Users',
            'clg_dob' => 'required',
            'clg_password' => 'required',
            'clg_joining_date' => 'required',
            'clg_group' => 'required',
            'clg_ref_id' => 'required',
            'clg_gender' => 'required',
            'clg_state' => '',
            'clg_district' => '',
            'clg_tahsil' => '',
            'clg_city' => '',
            'clg_marital_status' => 'required',
            'clg_address' => '',
        ]);
                    
       $request->clg_password =  Hash::make($request->clg_password);


        $data = array(
            'clg_first_name' => $request->clg_first_name,
            'clg_mid_name' => $request->clg_mid_name,
            'clg_last_name' => $request->clg_last_name,
            'clg_mobile_no' => $request->clg_mobile_no,
            'email' => $request->email,
            'clg_dob' => $request->clg_dob,
            'clg_joining_date' => $request->clg_joining_date,
            'clg_group' => $request->clg_group,
            'clg_ref_id' => $request->clg_ref_id,
            'password' => $request->clg_password,
            'clg_gender' => $request->clg_gender,
            'clg_state' => $request->clg_state,
            'clg_district' => $request->clg_district,
            'clg_tahsil' => $request->clg_tahsil,
            'clg_city' => $request->clg_city,
            'clg_marital_status' => $request->clg_marital_status,
            'clg_address' => $request->clg_address,
            'clg_is_deleted' => '0',
            'clg_status' => 'active'
        );


        if ($validatedData->passes()) {
            $student = DB::table('users')->insert($data);
            Session::flash('success', 'User Registration Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
        // return redirect()->route('user.list')->with('success','User Registration Successfully.');
        
    }
    
    public function edit($userId)
    { 
    
        $groups = Groups::get_groups();      
        $user = Users::get_user_as_per_id($userId);
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $city = City::get_City(); 
        $action = 'Update User';
        $disabled = "";
        $userId = $user[0]->id;
        $form_submit_url = "user.update, $userId";
        return view('user.user_view', [ 
                                'groups' => $groups,
                                'state' => $state,
                                'district' => $district,
                                'tahsil' => $tahsil,
                                'city' => $city,
                                'form_submit_url'=> $form_submit_url, 
                                'action'=> $action,
                                'disabled' => $disabled,
                                'user' => $user[0] ]);
    }

    public function update(Request $request, $userId)
    {

       // var_dump('hi');die();
        $validatedData = Validator::make($request->all(),[
            'clg_first_name' => 'required',
            'clg_mid_name' => '',
            'clg_last_name' => 'required',
            'clg_mobile_no' =>  ['required', 'numeric', 'digits_between:10,12'],
            'email' => 'required',
            'clg_dob' => 'required',
            'clg_password' => 'required',
            'clg_joining_date' => 'required',
            'clg_group' => 'required',
            'clg_ref_id' => 'required',
            'clg_gender' => 'required',
            'clg_state' => '',
            'clg_district' => '',
            'clg_tahsil' => '',
            'clg_city' => '',
            'clg_marital_status' => 'required',
            'clg_address' => '',
          
        ]);
        
        $request->clg_password =  Hash::make($request->clg_password);
        $data = array(
            'clg_first_name' => $request->clg_first_name,
            'clg_mid_name' => $request->clg_mid_name,
            'clg_last_name' => $request->clg_last_name,
            'clg_mobile_no' => $request->clg_mobile_no,
            'email' => $request->email,
            'clg_dob' => $request->clg_dob,
            'clg_joining_date' => $request->clg_joining_date,
            'clg_group' => $request->clg_group,
            'clg_ref_id' => $request->clg_ref_id,
            'password' => $request->clg_password,
            'clg_gender' => $request->clg_gender,
            'clg_state' => $request->clg_state,
            'clg_district' => $request->clg_district,
            'clg_tahsil' => $request->clg_tahsil,
            'clg_city' => $request->clg_city,
            'clg_marital_status' => $request->clg_marital_status,
            'clg_address' => $request->clg_address,
            'clg_is_deleted' => '0',
            'clg_status' => 'active'
        );
        if ($validatedData->passes()) {
            $show =  Users::update_users_data($data,$userId);
            Session::flash('success', 'User Updated Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function show($userId)
    {
        $state = State::get_State();
        $district = District::get_District();
        $tahsil = Tahsil::get_tahsil();
        $groups = Groups::get_groups();       
        $user = Users::get_user_as_per_id($userId);
        $city = City::get_City(); 
        $action = 'View User';
        $disabled = "disabled = 'disabled'";
        $userId = $user[0]->id;
        $form_submit_url = "user.update, $userId";
        return view('user.user_view', [  
           
            'groups' => $groups,
            'state' => $state,
            'district' => $district,
            'tahsil' => $tahsil,                
            'form_submit_url'=> $form_submit_url, 
            'action'=> $action,
            'disabled' => $disabled,
            'user' => $user[0],
            'city' => $city ]);
    }

    public function destroy($userId)
    {
      $updated_data = ['clg_is_deleted'=> '1'];
      $show =  Users::delete_user($updated_data,$userId);
      return redirect()->route('user.list')
      ->with('success','User Deleted Successfully.');
    }

    
    public function fetch_clg_ref_id(Request $request)
    {
        
    //  var_dump($request->gcode);die();
      //  $group_data = Groups::where('gcode', $request->gcode)->get();
      
        $group_data =  DB::table('tdd_mas_groups as grp') 
        ->where('gcode', $request->gcode)
                ->get();
    
        $name=  $group_data[0]->ugname;
        $user_data = Users::where('clg_ref_id','like',"%$name%")->get();
  
        if(sizeof($user_data) > 0)
        {
            $clg_data= array();
           
            foreach($user_data as $res){
           
                $clg_data[] = (preg_replace("/[a-zA-Z]+-/", "", $res->clg_ref_id));
        
            }
          
            $value = max($clg_data); 
            //var_dump( $value);die();
            $temp = ++$value;
               // var_dump($temp);die();
        }else{
            $temp=1;
        }
        $clg_new_id = "$name-".$temp;
        //var_dump(   $clg_new_id);die();
        return response()->json($clg_new_id);
    }
}
