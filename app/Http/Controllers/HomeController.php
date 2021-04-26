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
        if($clg_group == 'A'){
            // return view('dash/dash');
            return redirect()->action('App\Http\Controllers\DashController@index');
        }else{
            return redirect()->action('App\Http\Controllers\CallsController@atnd_call');
        }
    }
}
