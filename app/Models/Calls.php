<?php
namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Calls extends Model
{
    public static function get_inc_ambu($data){
        if ($data['lat'] != '' && $data['lng'] != '') {
            $radius = "( 3959 * acos( cos( radians(".$data['lat'].") ) * cos( radians( amb_lat ) ) * cos( radians( amb_log ) - radians(".$data['lng'].") ) + sin( radians(".$data['lat'].") ) * sin( radians( amb_lat ) ) ) ) AS distance";
            $orderby = " HAVING distance < 100 ORDER BY distance ";  
        }else{
            $radius= "";
            $having_distance = "";
            $orderby = "";     
        }
         if($data['amb_type'] == ''){
            // $amb =  "1,2,3,4,5";
            $amb = "amb.amb_type IN ('1','2','3','4','5') ";
        }else{
            $amb = "amb.amb_type IN ('".$data['amb_type']."') ";
            // $amb =  $data['amb_type'];
            // $amb = " AND amb.amb_type IN (" . implode( ',', $data['amb_type'] ) . ") ";
        }
        // print_r($amb);
        return  DB::table('tdd_ambulance as amb') 
            ->select('*',DB::raw($radius))
            // ->select('amb.*, inc.*, amb_ty.ambt_name, amb_stus.ambs_name, cal.clr_no, cal.clr_relation,cal.clr_name,cal.clr_address,pur.pname',$radius)
            // ->leftJoin('tdd_incidence_ambulance as inc_amb', 'inc_amb.amb_rto_register_no', '=', 'amb.amb_rto_register_no')
            // ->leftJoin('tdd_incidence as inc', 'inc.inc_ref_id', '=', 'inc_amb.inc_ref_id')
            // ->leftJoin('tdd_callers as cal', 'cal.clr_id', '=', 'inc.inc_cl_id')
            // ->leftJoin('tdd_mas_call_purpose as pur', 'pur.pcode', '=', 'inc.inc_type')
            ->leftJoin('tdd_mas_ambulance_type as amb_ty', 'amb_ty.ambt_id', '=', 'amb.amb_type')
            ->leftJoin('tdd_mas_ambulance_status as amb_stus', 'amb_stus.ambs_id', '=', 'amb.amb_status')
            ->leftJoin('tdd_hospital as hosp', 'hosp.hp_id', '=', 'amb.amb_base_location')
            // ->where($amb)
            // ->groupBy('amb.amb_rto_register_no')
            ->orderBy('distance')
            ->limit(10)
            ->get();
            // ->get(['amb.*', 'inc.*', 'amb_ty.ambt_name', 'amb_stus.ambs_name', 'cal.clr_no', 'cal.clr_relation','cal.clr_name','cal.clr_address','pur.pname']);



            // $sql ="SELECT amb.*, inc.*, amb_ty.ambt_name, amb_stus.ambs_name, cal.clr_no, cal.clr_relation,cal.clr_name,cal.clr_address,pur.pname" 
            // . "$radius FROM ems_ambulance AS amb"
            // . " LEFT JOIN ems_incidence_ambulance AS inc_amb ON ( inc_amb.amb_reg_no = amb.amb_reg_no )"
            // . " LEFT JOIN ems_incidence AS inc ON ( inc.inc_ref_id = inc_amb.inc_ref_id )"

            // . " LEFT JOIN ems_callers AS cal ON ( cal.clr_id = inc.inc_cl_id )"
            // . " LEFT JOIN ems_mas_call_purpose AS pur ON ( pur.pcode = inc.inc_type )"

            // . " LEFT JOIN ems_mas_ambulance_type AS amb_ty ON ( amb_ty.ambt_id = amb.amb_type )"
            // . " LEFT JOIN ems_mas_ambulance_status AS amb_stus ON ( amb_stus.ambs_id = amb.amb_status )"
            // . " WHERE 1=1 $amb"
            // . " GROUP BY amb.amb_reg_no $orderby LIMIT 10";
            // $result = $this->db->query($sql);
    }
}
