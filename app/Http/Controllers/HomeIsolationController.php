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
    public function follow_up_create($isolationId){
        $data['action'] = 'Follow Up';
        $data['patient'] = Patient::patientRecWithId($isolationId);
        // print_r($data);
        return view('isolation.follow_up_create',$data);
    }
    public function follow_up_store(Request $request){
        $validatedData = Validator::make($request->all(), [
            'followup_atnd_doc_name' => 'required',
            'followup_hosp_name' => 'required',
            'followup_status' => 'required',
        ]);
        $data = array(
            'ptn_id' => $request->isolationId,
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
            $isolation = DB::table('tdd_isolation_follow_up')->insert($data);
            DB::table('tdd_isolation')->where('pk_id',$request->isolationId)->update($ptn);
            Session::flash('success', 'isolation Followup Added Successfully.');
        }
        return response()->json(['error'=>$validatedData->errors()]);
    }
    function follow_up_view($isolationId){
        $data['patientFollowup'] = isolation_followup::patientFollowupRecWithId($isolationId);
        // print_r( $data['isolation']);die;
        $data['action'] = 'Isolation Followup View';
        return view('isolation.follow_up_view',$data);
    }
}
