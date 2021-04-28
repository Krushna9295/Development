<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;

use App\Http\Controllers;
use App\Models\Area;
use App\Models\Atc;
use App\Models\Users;
use App\Models\Po;
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
        // $po = Po::get_Po(); 
        // $cluster = Cluster::get_cluster();
        // $atc = Atc::get_Atc(); 
        $groups = Groups::get_groups();      
        // $area = Area::get_area_type();  
        $city = City::get_City();   
        $action = 'Register New User';
        $disabled = "";
        $form_submit_url = "route('user.store')";
        return view('user/user_view',[  
                                // 'cluster' => $cluster,
                                'groups' => $groups,
                                // 'atc' => $atc,
                                // 'po' => $po,
                                'form_submit_url'=> $form_submit_url, 
                                'action'=> $action,
                                'disabled' => $disabled,
                                'city' => $city ]);
    }
    public function store(Request $request){  
     //    var_dump( $request->image);die();
        $validatedData = Validator::make($request->all(),[
            'clg_first_name' => 'required',
            'clg_mid_name' => '',
            'clg_last_name' => 'required',
            'clg_mobile_no' => ['required', 'numeric', 'digits_between:10,12'],
            'email' => 'email|unique:Users',
            'clg_dob' => 'required',
            'clg_joining_date' => 'required',
            'clg_group' => 'required',
            'clg_ref_id' => 'required',
            'clg_password' => 'required',
            'clg_atc' => 'required',
            'clg_cluster' => 'required',
            'clg_city' => '',
            'clg_gender' => 'required',
            'clg_marital_status' => 'required',
            'clg_address' => '',
            'clg_current_salary' => '',
            'clg_po' => 'required',
            // 'clg_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'clg_resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
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
            'clg_atc' => $request->clg_atc,
            'clg_cluster' => $request->clg_cluster,
            'clg_city' => $request->clg_city,
            'clg_gender' => $request->clg_gender,
            'clg_marital_status' => $request->clg_marital_status,
            'clg_address' => $request->clg_address,
            'clg_current_salary' => $request->clg_current_salary,
            'clg_po' => $request->clg_po,
            'clg_is_deleted' => '0',
            'clg_status' => 'active'
        );
            
        // $ResumeName = time().'.'.$request->clg_resume->extension();
        // $request->clg_resume->move(public_path('Resume'), $ResumeName);
        // $imageName = time().'.'.$request->clg_image->extension();
        // $request->clg_image->move(public_path('images'), $imageName);
        // $data['clg_image']=  $imageName;
        // $data['clg_status']= "Active";

    //   $validatedData['clg_group']= new ObjectId($validatedData['clg_group']);
        // $data['clg_is_deleted'] = 0;
        // $show = Users::create($validatedData);

        if ($validatedData->passes()) {
            $student = DB::table('users')->insert($data);
            Session::flash('success', 'User Registration Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
        // return redirect()->route('user.list')->with('success','User Registration Successfully.');
        
    }
    public function edit($userId)
    { 
        // $student = Student::find($user);
        $po = Po::get_Po(); 
        $cluster = Cluster::get_cluster();
        $atc = Atc::get_Atc(); 
        $groups = Groups::get_groups();      
        $area = Area::get_area_type();  
        $user = Users::get_user_as_per_id($userId);
        $city = City::get_City(); 
        $action = 'Update User';
        $disabled = "";
        $userId = $user[0]->id;
        $form_submit_url = "user.update, $userId";
        return view('user.user_view', [
                                'cluster' => $cluster,
                                'groups' => $groups,
                                'atc' => $atc,
                                'po' => $po,
                                'form_submit_url'=> $form_submit_url, 
                                'action'=> $action,
                                'disabled' => $disabled,
                                'user' => $user[0],
                                'city' => $city ]);
    }
    public function update(Request $request, $userId)
    {
        $validatedData = Validator::make($request->all(),[
            'clg_first_name' => 'required',
            'clg_mid_name' => '',
            'clg_last_name' => 'required',
            'clg_mobile_no' => ['required', 'numeric', 'digits_between:10,12'],
            'email' => 'required',
            'clg_dob' => 'required',
            'clg_joining_date' => 'required',
            'clg_group' => 'required',
            'clg_ref_id' => 'required',
            'clg_password' => 'required',
            'clg_atc' => 'required',
            'clg_cluster' => 'required',
            'clg_city' => '',
            'clg_gender' => 'required',
            'clg_marital_status' => 'required',
            'clg_address' => '',
            'clg_current_salary' => '',
            'clg_po' => 'required',
            // 'clg_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'clg_resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
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
            'clg_atc' => $request->clg_atc,
            'clg_cluster' => $request->clg_cluster,
            'clg_city' => $request->clg_city,
            'clg_gender' => $request->clg_gender,
            'clg_marital_status' => $request->clg_marital_status,
            'clg_address' => $request->clg_address,
            'clg_current_salary' => $request->clg_current_salary,
            'clg_po' => $request->clg_po,
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
        $po = Po::get_Po(); 
        $cluster = Cluster::get_cluster();
        $atc = Atc::get_Atc(); 
        $groups = Groups::get_groups();      
        $area = Area::get_area_type();  
        $user = Users::get_user_as_per_id($userId);
        $city = City::get_City(); 
        $action = 'View User';
        $disabled = "disabled = 'disabled'";
        $userId = $user[0]->id;
        $form_submit_url = "user.update, $userId";
        return view('user.user_view', [  
            'po' => $po,
            'cluster' => $cluster,
            'groups' => $groups,
            'atc' => $atc,
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
    
        $group_data = Groups::where('ugname', $request->clg_gp_name)->get();

        $name=  $group_data[0]->gcode;
       
        $user_data = Users::where('clg_ref_id','like',"%$name%")->get();
       
        if(sizeof($user_data) > 0)
        {
            $clg_data= array();

            foreach($user_data as $res){
           
                $clg_data[] = (preg_replace("/[a-zA-Z]+-/", "", $res->clg_ref_id));
        
            }
          
            $value = max($clg_data); 
            $temp = ++$value;
        }else{
            $temp=1;
        }
        $clg_new_id = "$name-".$temp;
        return response()->json($clg_new_id);
    }
}
