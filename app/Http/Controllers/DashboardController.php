<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        $user = Auth::user();

        if($user->role === 'admin'){
            echo "Admin Dashboard"; die();

        }else if($user->role === 'customer'){
            echo "User Dashboard"; die();
        }
    }
}
