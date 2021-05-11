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
class UploadPatientDataController extends Controller
{
    public function create(){
        return view('upload.patient_upload_view');
    }
    public function store(Request $request){
        $validator = $this->validate($request, [
            'ptn_upload_data' => 'required'
        ]);
        $filename = $request->ptn_upload_data;
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $team_data = array(
                'icmr_id'=>$getData[0],
                'ptn_name'=>$getData[1],
                'ptn_age'=>$getData[2],
                'ptn_gender'=>$getData[3],
                'ptn_address'=>$getData[4],
                'ptn_contact_no'=>$getData[5],
                'modify_date' => date('Y-m-d H:i:s'),
                'added_date' => date('Y-m-d H:i:s'),
                'modify_date_sync' => date('Y-m-d H:i:s')
            );
            DB::table('tdd_patient')->insert($team_data);
        }
        Session::flash('success', 'Upload Successfully.');
        return redirect()->action('App\Http\Controllers\PatientController@index');
        
    }
}
