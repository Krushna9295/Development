<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use App\Models\Cluster;
use App\Models\State;
use App\Models\District;
use App\Models\Tahsil;
use App\Models\City;
use App\Models\Calls;

class CallsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function manage_addr(Request $request){
        $data['dist'] = "";
        $data['tahshil'] = "";
        $data['city'] = "";
        $data['state'] = DB::table('tdd_mas_states')->where('st_name','like', $request->loc_state)->get();
        if(!empty($request->dist)){
            $data['dist'] = DB::table('tdd_mas_districts')->where('dst_name','like', $request->dist)->get();
        }
        if(!empty($request->thl)){
            $data['tahshil'] = DB::table('tdd_mas_tahshil')->where('thl_name','like', $request->thl)->get();
        }
        if(!empty($request->city)){
            $data['city'] = DB::table('tdd_mas_city')->where('cty_name','like', $request->city)->get();
        }
        return response()->json($data);
    }
}
