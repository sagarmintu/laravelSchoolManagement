<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function change_password()
    {
        return view('profile.change_password');
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password Successfully Updated');
        }
        else
        {
            return redirect()->back()->with('error', 'Password Is Not Matching');
        }
    }

    public function myAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        return view('teacher.my_account', $data);
    }

    public function updateMyAccount(Request $request)
    {
        $id = Auth::user()->id;

        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:15|min:8',
            'marital_status' => 'max:50',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->marital_status = trim($request->marital_status);

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($teacher->getProfile()))
            {
                unlink('upload/profile/'.$teacher->profile_picture);
            }
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$extension;
            $file->move('upload/profile/', $filename);
            $teacher->profile_picture = $filename;
        }

        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->email = trim($request->email);
        $teacher->save();
        return redirect()->back()->with('success', 'Account Details Are Updated');
    }
}
