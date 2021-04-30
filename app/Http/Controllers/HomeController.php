<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clg_group = Auth::user()->clg_group;
      // var_dump($clg_group);die();
        if($clg_group == 'A'){
            // return view('dash/dash');
            return redirect()->action('App\Http\Controllers\DashController@index');
        }elseif($clg_group == 'UG-ISO')
        {
            // return view('home',compact( 'Bins','Vehicle','Bins_count','Users_count','Dumps_count','Vehicle_count'));
            return view('dash.isolation_dash');
            // return view('dashboard.home1');
        }
        else{
            return redirect()->action('App\Http\Controllers\DashController@index');

        }
    }
}
