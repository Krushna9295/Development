<?php
namespace App\Http\Controllers;
use DB;

use App\Models\State;
use App\Models\City;
use App\Models\Users;
use App\Models\District;
use App\Models\Tahsil;
use App\Models\Po;
use Illuminate\Http\Request;
use App\Http\Controllers\controller;
use Symfony\Component\HttpFoundation\Response;


class CommanController extends Controller
{
    public function index()
    {  $countries = State::get_State();
       
        return view('index',compact('countries'));
    }
    public function getStateList(Request $request)
    {
        $states = State::get_State();
        return response()->json($states);
    }
    public function getCityList(Request $request)
    {
        $cities = City::get_City();
        return response()->json($cities);
    }
    public function get_state_as_per_name(Request $request)
    { 
         
        $state_name = State::get_state_as_per_name($request->statename);
       
        return response()->json($state_name[0]->st_name);
    }
    public function get_district_state(Request $request)
    {
       
        $district = District::get_district_state($request->state);
    
        return response()->json($district);
    }
    public function get_tahsil_district(Request $request)
    {
      
        $tahsil = Tahsil::get_tahsil_district($request->district);
       
         return response()->json($tahsil);
    }
    public function get_city_tahsil(Request $request)
    { 
        $cities = City::get_city_tahsil($request->tahshil);
        return response()->json($cities);
    }
    public function get_district_as_per_name(Request $request)
    {
   
        $cities = District::get_district_as_per_name($request->districtname)->get();
        return response()->json($cities[0]->dst_name);
    }
    public function get_city_as_per_name(Request $request)
    {

        $cities = City::get_city_as_per_name($request->cityname);
        return response()->json($cities[0]->cty_name);
    }
    public function get_tahshil_as_per_name(Request $request)
    {
        $cities = Tahsil::get_tahshil_as_per_name($request->tahsilname);
        return response()->json($cities[0]->thl_name);
    } 
    public function get_po_as_per_atc(Request $request){
        $atc = Po::get_po_as_per_atc($request->atc);
        return response()->json($atc);
    }
    
}