<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        
        if(Auth::user()->hasRole('superadministrator')){

            return view('superadmin.dashboard');
        }
        elseif(Auth::user()->hasRole('administrator')){
            return 'test';

            return view('admin.dashboard');
        }
        elseif(Auth::user()->hasRole('user')){

            return view('user.dashboard');
        }
        

    }
}
