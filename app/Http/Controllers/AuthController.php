<?php

namespace App\Http\Controllers;

use to;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
      $user = User::getEmailSingle($request->email);
      if (!empty($user)) {
        $user->remember_token = Str::random(30);
        $user->save();
        Mail::to($user->email)->send(new ForgotPasswordMail($user));

        return redirect()->back()->with('success' ,"please check your email and reset your password");
        
      }else{
        return redirect()->back()->with('error' ,"Email not found in the system.");
      }
     }

     public function reset($remember_token){
      $user = User::getTokenSingle($remember_token);
      if (!empty($user)) {
        $data['user'] = $user;
        return view('auth.reset',$data);
      }else{
        abort(404);
      }
     }
     public function postReset($token,  Request $request){
      if ($request->password == $request->cpassword) {
      $user = User::getTokenSingle($token);
        $user ->password = Hash::make($request->password);
        $user->remember_token = Str::random(30);
        $user->save();
        return redirect(url(''))->with('success',"password  successfully reset");
      } else {
        return redirect()->back()->with('error' ,"Password and confim password does not match.");
        
      }
      
     }
    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
