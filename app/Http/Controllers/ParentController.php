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
}
