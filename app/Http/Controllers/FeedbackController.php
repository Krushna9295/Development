<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;
use Session;
use App\Models\Patient_feedback;
use App\Models\Calls;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(){
        $feedbackData = DB::table('tdd_patient')->where('ptn_isdeleted','0')->where('ptn_status','discharge')->orderBy('pk_id','ASC')->get();
        return view('feedback/feedback_list',['feedbackData' => $feedbackData]);
    }
    public function create($patientId){
        $patient = DB::table('tdd_patient')->where('pk_id',$patientId)->get();
        $data['patient'] = $patient[0];
        $data['ques'] = DB::table('tdd_mas_feedback_question')->where('quest_is_deleted','0')->get();
        // print_r($data['ques']);die;
        $data['action'] = 'Feedback';
        $data['disabled'] = "";
        $data['form_submit_url'] = " route( 'feedback.store' ) ";
        return view('feedback/feedback_view',$data);
    }
    public function store(Request $request){
        // print_r(json_encode($request->ptn_feed_ques));die;
        $validatedData = Validator::make($request->all(), [
            'ptn_feed_remark' => 'required'
        ]);
        $data = array(
            'ptn_id' => $request->patientId,
            'ptn_feed_ques' => json_encode($request->ptn_feed_ques),
            'ptn_feed_remark' => $request->ptn_feed_remark,
            'ptn_feed_added_by' => Auth::user()->clg_ref_id
        );
        $ptn['ptn_feedback_status'] = '1';
        $feedQues = $request->ptn_feed_ques;
        if ($validatedData->passes()) {
            $patient = DB::table('tdd_patient_feedback')->insert($data);
            DB::table('tdd_patient')->where('pk_id',$request->patientId)->update($ptn);
            foreach($feedQues as $key => $value){
                $ans['ptn_id'] = $request->patientId;
                $ans['ques_id'] = $key;
                $ans['feed_ans'] = $value;
                DB::table('tdd_mas_feedback_question_ans')->insert($ans);
            }
            Session::flash('success', 'Feedback Added Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    public function show($patientId)
    {
        $patient = DB::table('tdd_patient')->where('pk_id',$patientId)->get();
        $data['patient'] = $patient[0];
        $data['patient_feed'] = Patient_feedback::patientFeedbackWithId($patientId);
        $data['ans'] = DB::table('tdd_mas_feedback_question_ans as ans')->leftJoin('tdd_mas_feedback_question as ques', 'ques.ques_id', '=', 'ans.ques_id')->where('ans.ptn_id',$patientId)->get();
        $data['ques'] = DB::table('tdd_mas_feedback_question')->where('quest_is_deleted','0')->get();
        $data['action'] = 'View Feedback';
        $data['disabled']  = 'disabled';
        // print_r($data['ans']);die;
        return view('feedback/feedback_view',$data);
    }
}
