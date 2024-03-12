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

        if(Auth::user()->user_type == 1)
        {
            return view('admin.my_account', $data);
        }
        else if(Auth::user()->user_type == 2)
        {
            return view('teacher.my_account', $data);
        }
        else if(Auth::user()->user_type == 3)
        {
            return view('student.my_account', $data);
        }
        else if(Auth::user()->user_type == 4)
        {
            return view('parent.my_account', $data);
        }
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

    public function updateStudentAccount(Request $request)
    {
        $id = Auth::user()->id;

        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'caste' => 'max:50',
            'religion' => 'max:50',
            'height' => 'max:10',
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_picture);
            }
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$extension;
            $file->move('upload/profile/', $filename);
            $student->profile_picture = $filename;
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->email = trim($request->email);
        $student->save();
        return redirect()->back()->with('success', 'Account Details Are Updated');
    }

    public function updateTeacherAccount(Request $request)
    {
        $id = Auth::user()->id;

        request()->validate([
            'email' => 'required|email|unique:users',
            'address' => 'max:255',
            'occupation' => 'max:255',
            'mobile_number' => 'max:15|min:8',
        ]);

        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($parent->getProfile()))
            {
                unlink('upload/profile/'.$parent->profile_picture);
            }
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$extension;
            $file->move('upload/profile/', $filename);
            $parent->profile_picture = $filename;
        }

        $parent->occupation = trim($request->occupation);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->address = trim($request->address);
        $parent->email = trim($request->email);
        $parent->save();
        return redirect()->back()->with('success', 'Account Details Are Updated');
    }

    public function updateAdminAccount(Request $request)
    {
        $id = Auth::user()->id;

        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email  = trim($request->email);
        $admin->save();
        return redirect()->back()->with('success', 'Account Details Are Updated');
    }
}