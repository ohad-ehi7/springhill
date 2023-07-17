<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
       if (!empty(Auth::check())) {
        if (Auth::user()->user_type == 1) {
            return redirect('admin/dashboard');
            
          }
          else if (Auth::user()->user_type == 2) {
            return redirect('teacher/dashboard');
            
          }
          else if (Auth::user()->user_type == 3) {
            return redirect('student/dashboard');
            
          }elseif (Auth::user()->user_type == 4) {
            return redirect('parent/dashboard');
            
          }
        
       }
       return view('auth.login');

    }

    public function authLogin(Request $request){
        $remenber =!empty($request->remenber) ? true : false;
    if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password], $remenber)){
      if (Auth::user()->user_type == 1) {
        return redirect('admin/dashboard');
        
      }
      else if (Auth::user()->user_type == 2) {
        return redirect('teacher/dashboard');
        
      }
      else if (Auth::user()->user_type == 3) {
        return redirect('student/dashboard');
        
      }elseif (Auth::user()->user_type == 4) {
        return redirect('parent/dashboard');
        
      }

    }else{
        return redirect()->back()->with('error','Please enter currect email and password');
    }

        
    }

    public function forgotPassword(){
      return view('auth.forgot');
    }
     public function postForgotPassword(Request $request){
      //  dd($request->all());
      $getEmailSingle = User::getEmailSingle($request->email);
      dd($getEmailSingle);
     }
    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
