<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Patient_feedback extends Model
{
    protected $collection = 'tdd_patient_feedback';
    protected $fillable = ['ptn_id', 'ptn_feed_ques', 'ptn_feed_remark', 'ptn_feed_added_by', 'ptn_feed_added_date'];
    
    public static function patientFeedbackWithId($patientId){
        return DB::table('tdd_patient_feedback as feed') 
            ->where('feed.ptn_id',$patientId)
            ->get()[0];
        // print_r(count($data));
        // for($i = 0; $i < count($data); $i++){
        //     $feed = json_decode($data[$i]->ptn_feed_ques);
        //     // print_r($feed);die;
        //     foreach($feed as $feed1 => $key){
        //         print_r($key);
        //     }
        // }
    }
}
