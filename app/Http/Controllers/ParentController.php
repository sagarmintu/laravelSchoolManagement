<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ParentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getParent();
        return view('admin.parent.list',$data);
    }

    public function add()
    {
        return view('admin.parent.add');
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'address' => 'max:255',
            'occupation' => 'max:255',
            'mobile_number' => 'max:15|min:8',
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);

        if(!empty($request->file('profile_picture')))
        {
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$extension;
            $file->move('upload/profile/', $filename);
            $student->profile_picture = $filename;
        }

        $student->occupation = trim($request->occupation);
        $student->mobile_number = trim($request->mobile_number);
        $student->address = trim($request->address);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = trim($request->password);
        $student->user_type = 4;
        $student->save();
        return redirect('admin/parent/list')->with('success', 'Parent Successfully Added');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            return view('admin.parent.edit',$data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'address' => 'max:255',
            'occupation' => 'max:255',
            'mobile_number' => 'max:15|min:8',
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);

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

        $student->occupation = trim($request->occupation);
        $student->mobile_number = trim($request->mobile_number);
        $student->address = trim($request->address);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password))
        {
            $student->password = trim($request->password);
        }
        $student->save();
        return redirect('admin/parent/list')->with('success', 'Parent Data Updated Successfully');
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', 'Parent Data Deleted Successfully');
        }
        else
        {
            abort(404);
        }
    }

    public function myStudent($id)
    {
        $data['getParent'] = User::getSingle($id);
        $data['parent_id'] = $id;
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);
        return view('admin.parent.myStudent',$data);
    }

    public function AddStudentToParent($student_id, $parent_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = $parent_id;
        $student->save();
        return redirect()->back()->with('success', 'Student Successfully Assisgned To Parent');
    }

    public function deleteStudentToParent($student_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = null;
        $student->save();
        return redirect()->back()->with('success', 'Deleted The Student Assisgned To Parent');
    }

    public function myStudentParent()
    {
        $id = Auth::user()->id;
        $data['getParent'] = User::getSingle($id);
        $data['getRecord'] = User::getMyStudent($id);
        return view('parent.myStudentParent',$data);
    }
}
