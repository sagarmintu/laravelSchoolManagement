<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ClassModel;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        return view('admin.student.list',$data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        return view('admin.student.add', $data);
    }

    public function insert(Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users',
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
            'caste' => 'max:50',
            'religion' => 'max:50',
            'height' => 'max:10',
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_picture')))
        {
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

        if(!empty($request->admission_date))
        {
            $student->admission_date = trim($request->admission_date);
        }
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = trim($request->password);
        $student->user_type = 3;
        $student->save();
        return redirect('admin/student/list')->with('success', 'New Student Successfully Added');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['getClass'] = ClassModel::getClass();
            return view('admin.student.edit',$data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
            'caste' => 'max:50',
            'religion' => 'max:50',
            'height' => 'max:10',
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
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

        if(!empty($request->admission_date))
        {
            $student->admission_date = trim($request->admission_date);
        }
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password))
        {
            $student->password = trim($request->password);
        }
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student Data Updated Successfully');
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', 'Student Data Deleted Successfully');
        }
        else
        {
            abort(404);
        }
    }
}
