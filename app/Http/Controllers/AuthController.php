<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            elseif (Auth::user()->user_type == 2) 
            {
                return redirect('teacher/dashboard');
            }
            elseif (Auth::user()->user_type == 3) 
            {
                return redirect('student/dashboard');
            }
            elseif (Auth::user()->user_type == 4) 
            {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true: false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard')->with('success', 'Welcome To Admin Dashboard');
            }
            elseif (Auth::user()->user_type == 2) 
            {
                return redirect('teacher/dashboard')->with('success', 'Welcome To Teacher Dashboard');
            }
            elseif (Auth::user()->user_type == 3) 
            {
                return redirect('student/dashboard')->with('success', 'Welcome To Student Dashboard');
            }
            elseif (Auth::user()->user_type == 4) 
            {
                return redirect('parent/dashboard')->with('success', 'Welcome To Parent Dashboard');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }
    }

    public function forgot_password()
    {
        return view('auth.forgot_password');
    }

    public function postForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) 
        {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'Please Check Your Email And Reset The Password');
        } 
        else 
        {
            return redirect()->back()->with('error', 'Email Id Not Exists !!!');
        }
        
    }

    public function reset($remember_token)
    {
        $userToken = User::getTokenSingle($remember_token);
        if(!empty($userToken))
        {
            return view('auth.reset_password', compact('userToken'));
        }
        else
        {
            abort(404);
        }
    }

    public function resetPassword($token, Request $request)
    {
        if ($request->password == $request->cpassword) 
        {
            $userToken = User::getTokenSingle($token);
            $userToken->password = Hash::make($request->password);
            $userToken->remember_token = Str::random(30);;
            $userToken->save();
            return redirect(url(''))->with('success', 'Password Successfully Reset');
        } 
        else 
        {
            return redirect()->back()->with('error', 'Password And Confirm Password Does Not Match');
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
