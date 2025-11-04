<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        $user = Auth::user();

        if($user->role === 'admin'){
            return view('dashboard.admin_list');

        }else if($user->role === 'customer'){
            return view('dashboard.user_list');
        }
    }
}
