<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Student;
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
class StudentController extends Controller
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $studentData = DB::table('tdd_student')->where('stud_isdeleted','0')->orderBy('pk_id','ASC')->get();

        return view('student/student_list',['studentData' => $studentData]);
    }
    public function create(){
        $state = DB::table('tdd_mas_states')->where('stis_deleted', '0')->orderBy('st_name', 'ASC')->get();
        $district = DB::table('tdd_mas_districts')->where('dstis_deleted', '0')->orderBy('dst_name', 'ASC')->get();
        $tahsil = DB::table('tdd_mas_tahshil')->where('thlis_deleted', '0')->orderBy('thl_name', 'ASC')->get();
        $city = DB::table('tdd_mas_city')->where('ctyis_deleted', '0')->orderBy('cty_name', 'ASC')->get();
        $school = DB::table('tdd_school')->where('school_isdeleted', '0')->orderBy('school_name', 'ASC')->get();
        $action = 'Add New Student';
        $disabled = "";
        $form_submit_url = "student.store";
        return view('student/student_view',[  
                'form_submit_url'=> $form_submit_url, 
                'action'=> $action,
                'disabled' => $disabled,
                'state' => $state,
                'district' => $district,
                'tahsil' => $tahsil,
                'city' => $city,
                'school' => $school ]);
    }
    public function store(Request $request){
        // var_dump($request->stu_fname());die;
        // $student = new Student; 
        $validatedData = Validator::make($request->all(), [
            'stud_first_name' => 'required|alpha',
            'stud_middle_name' => '',
            'stud_last_name' => 'required|alpha',
            'stud_dob' => '',
            'stud_age' => 'required|numeric',
            'stud_gender' => 'required',
            'stud_father_occupation' => '',
            'stud_adhar_no' => '',
            'stud_ins_no' => '',
            'deworning' => 'required',
            'stud_school_id' => 'required',
            'stud_address' => '',
            'stud_district' => '',
            'stud_city' => '',
            'stud_area' => '',
            'stud_landmark' => '',
            'stud_lane_street' => '',
            'stud_house_no' => '',
            'stud_pincode' => '',
        ]);
        $date = str_replace('-','',date('Y-m-d'));
        $time = str_replace(':','',date('H:i:s'));
        /*Create Student Registration Number */
        $ref_id_first = trim($request->stud_first_name);
        $ref_id_midle = trim($request->stud_middle_name);
        $ref_id_last =  trim($request->stud_last_name);
        $ref_rand = rand(1000, 9999).'_'.$ref_id_first.'_'.$ref_id_midle.'_'.$ref_id_last;
        $ref_rand = strtoupper($ref_rand);
        /*End Student Registration Number */
        $data = array(
            'stud_id' => 'STUD'.$date.$time,
            'stud_first_name' => $request->stud_first_name,
            'stud_middle_name' => $request->stud_middle_name,
            'stud_last_name' => $request->stud_last_name,
            'stud_dob' => $request->stud_dob,
            'stud_age' => $request->stud_age,
            'stud_gender' => $request->stud_gender,
            'stud_father_occupation' => $request->stud_father_occupation,
            'stud_adhar_no' => $request->stud_adhar_no,
            'stud_ins_no' => $request->stud_ins_no,
            'deworning' => $request->deworning,
            'stud_school_id' => $request->stud_school_id,
            'stud_address' => $request->stud_address,
            'stud_state' => $request->stud_state,
            'stud_district' => $request->stud_district,
            'stud_tahsil' => $request->stud_tahsil,
            'stud_city' => $request->stud_city,
            'stud_area' => $request->stud_area,
            'stud_landmark' => $request->stud_landmark,
            'stud_lane_street' => $request->stud_lane_street,
            'stud_house_no' => $request->stud_house_no,
            'stud_pincode' => $request->stud_pincode,
            'stud_isdeleted' => '0',
            'added_by' => Auth::user()->clg_first_name,
            'modify_by' => Auth::user()->clg_first_name,
            'added_date' => date('Y-m-d H:i:s'),
            'stud_reg_no' => $ref_rand
        );
        if ($validatedData->passes()) {
            $student = DB::table('tdd_student')->insert($data);
            Session::flash('success', 'Student Added Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function edit($studentId)
    { 
        $state = DB::table('tdd_mas_states')->where('stis_deleted', '0')->orderBy('st_name', 'ASC')->get();
        $district = DB::table('tdd_mas_districts')->where('dstis_deleted', '0')->orderBy('dst_name', 'ASC')->get();
        $tahsil = DB::table('tdd_mas_tahshil')->where('thlis_deleted', '0')->orderBy('thl_name', 'ASC')->get();
        $city = DB::table('tdd_mas_city')->where('ctyis_deleted', '0')->orderBy('cty_name', 'ASC')->get();
        $school = DB::table('tdd_school')->where('school_isdeleted', '0')->orderBy('school_name', 'ASC')->get();
        $student = Student::StudentRecWithId($studentId);
        $action = 'Update Student';
        $disabled = "";
        $stuId = $student[0]->pk_id;
        $form_submit_url = "student.update, $stuId ";
        return view('student.student_view', [  
                    'form_submit_url'=> $form_submit_url, 
                    'action'=> $action,
                    'disabled' => $disabled,
                    'student' => $student[0],
                    'state' => $state,
                    'district' => $district,
                    'tahsil' => $tahsil,
                    'city' => $city,
                    'school' => $school ]);
    }
    public function update(Request $request, $studentId)
    {
        $validatedData = Validator::make($request->all(), [
            'stud_first_name' => 'required|alpha',
            'stud_middle_name' => '',
            'stud_last_name' => 'required|alpha',
            'stud_dob' => '',
            'stud_age' => 'required|numeric',
            'stud_gender' => 'required',
            'stud_father_occupation' => '',
            'stud_adhar_no' => '',
            'stud_ins_no' => '',
            'deworning' => '',
            'stud_school_id' => 'required',
            'stud_address' => '',
            'stud_district' => '',
            'stud_city' => '',
            'stud_area' => '',
            'stud_landmark' => '',
            'stud_lane_street' => '',
            'stud_house_no' => '',
            'stud_pincode' => '',
        ]);
        if ($validatedData->passes()) {
            $data = array(
                'stud_first_name' => $request->stud_first_name,
                'stud_middle_name' => $request->stud_middle_name,
                'stud_last_name' => $request->stud_last_name,
                'stud_dob' => $request->stud_dob,
                'stud_age' => $request->stud_age,
                'stud_gender' => $request->stud_gender,
                'stud_father_occupation' => $request->stud_father_occupation,
                'stud_adhar_no' => $request->stud_adhar_no,
                'stud_ins_no' => $request->stud_ins_no,
                'deworning' => $request->deworning,
                'stud_school_id' => $request->stud_school_id,
                'stud_address' => $request->stud_address,
                'stud_state' => $request->stud_state,
                'stud_district' => $request->stud_district,
                'stud_tahsil' => $request->stud_tahsil,
                'stud_city' => $request->stud_city,
                'stud_area' => $request->stud_area,
                'stud_landmark' => $request->stud_landmark,
                'stud_lane_street' => $request->stud_lane_street,
                'stud_house_no' => $request->stud_house_no,
                'stud_pincode' => $request->stud_pincode,
                'stud_isdeleted' => '0'
            );
            DB::table('tdd_student')->where('pk_id',$studentId)->update($data); 
            Session::flash('success', 'Student Updated Successfully.'); 
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function show($studentId)
    {
        $state = DB::table('tdd_mas_states')->where('stis_deleted', '0')->orderBy('st_name', 'ASC')->get();
        $district = DB::table('tdd_mas_districts')->where('dstis_deleted', '0')->orderBy('dst_name', 'ASC')->get();
        $tahsil = DB::table('tdd_mas_tahshil')->where('thlis_deleted', '0')->orderBy('thl_name', 'ASC')->get();
        $city = DB::table('tdd_mas_city')->where('ctyis_deleted', '0')->orderBy('cty_name', 'ASC')->get();
        $school = DB::table('tdd_school')->where('school_isdeleted', '0')->orderBy('school_name', 'ASC')->get();
        $student = Student::StudentRecWithId($studentId);
        $action = 'View Student';
        $disabled = "disabled = 'disabled'";
        return view('student.student_view', [  
            'action'=> $action,
            'disabled' => $disabled,
            'student' => $student[0],
            'state' => $state,
            'district' => $district,
            'tahsil' => $tahsil,
            'city' => $city,
            'school' => $school ]);
    }
    public function destroy($studentId)
    {
      $updated_data = array('stud_isdeleted'=> '1');
      $show =  DB::table('tdd_student')->where('pk_id',$studentId)->update($updated_data);
      return redirect()->route('student.list')
      ->with('success','Student Deleted Successfully.');
    }
}
