<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Login;

class DashController extends Controller
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        // echo 'hhhh';die;
        return view('dash.dash');
    }
}
