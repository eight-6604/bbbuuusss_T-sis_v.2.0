<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function login_post(Request $request){
        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password],true)){
            $user = Auth::user();

            if($user->role === 'admin'){
                return redirect('admin/dashboard');
            }else if($user->role === 'customer'){
                return redirect('user/dashboard');
            }else{
                return redirect('/')->with('error','No Available Email.');
            }
        }else{
            return redirect()->back()->with('error','Invalid Credentials.');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
