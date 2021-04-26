<?php

namespace App\Models;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $student = 'tdd_student';
    protected $fillable = ['stud_first_name','stud_middle_name','stud_last_name','stud_dob','stud_age','stud_gender','stud_father_occupation', 'stud_adhar_no', 'stud_ins_no','deworning', 'stud_school_id','stud_address','stud_state','stud_district','stud_tahsil','stud_city','stud_area','stud_landmark','stud_lane_street','stud_house_no','stud_pincode','added_by','modify_date_sync', 'stud_isdeleted'];
    
    public static function StudentRecWithId($studentId){
        return  DB::table('tdd_student as stu')
            ->select('stu.*','dst.dst_code','dst.dst_name','st.st_code','st.st_name','thl.thl_code','thl.thl_name','cty.cty_id','cty.cty_name','sch.school_name')
            ->leftJoin('tdd_mas_states as st','stu.stud_state','=','st.st_code')  
            ->leftJoin('tdd_mas_districts as dst','stu.stud_district','=','dst.dst_code')
            ->leftJoin('tdd_mas_tahshil as thl','stu.stud_tahsil','=','thl.thl_code')
            ->leftJoin('tdd_mas_city as cty','stu.stud_city','=','cty.cty_id') 
            ->leftJoin('tdd_school as sch','stu.stud_school_id','=','sch.pk_id')  
            ->where('stu.pk_id',$studentId)
            ->get();
    }
    public static function get_student(){
        return  DB::table('tdd_student as stu') 
            ->where('stu.stud_isdeleted','0')
            ->get();
    }
    public static function save_student_basic_info($data,$stud_id){
        $chk_rec = DB::table('tdd_student_basic_info')
                    ->where('student_id',$stud_id)
                    ->get();
        // print_r($chk_rec);die;
        if(count($chk_rec) == 0){
            // echo '1';
            $data['added_by'] = Auth::user()->clg_first_name;
            $data['added_date'] = date('Y-m-d H:i:s');
            $data['student_id'] = $stud_id;
            $chk_rec = DB::table('tdd_student_basic_info')
                    ->where('student_id',$stud_id)
                    ->insert($data);
        }else{ 
            // echo '2';
            $data['modify_by'] = Auth::user()->clg_first_name;
            $data['modify_date'] = date('Y-m-d H:i:s');
            $chk_rec = DB::table('tdd_student_basic_info')
                    ->where('student_id',$stud_id)
                    ->update($data);
            return DB::table('tdd_student_basic_info')
            ->where('student_id',$stud_id)
            ->get();
        }
    }
}
