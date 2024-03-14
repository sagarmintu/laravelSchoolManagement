<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = AssignClassTeacherModel::getRecord();
        return view('admin.assign_class_teacher.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        return view('admin.assign_class_teacher.add', $data);
    }

    public function insert(Request $request)
    {
        if (!empty($request->teacher_id)) 
        {
            foreach($request->teacher_id as $teacher_id)
            {
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
                if (!empty($getAlreadyFirst)) 
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } 
                else 
                {
                    $aasign_subject =  new AssignClassTeacherModel;
                    $aasign_subject->class_id = $request->class_id;
                    $aasign_subject->teacher_id = $teacher_id;
                    $aasign_subject->status = $request->status;
                    $aasign_subject->created_by = Auth::user()->id;
                    $aasign_subject->save();
                }
            }
            return redirect('admin/assign_class_teacher/list')->with('success', 'Teacher Is Assigned To Class According To Subject');
        } 
        else 
        {
            return redirect('admin/assign_class_teacher/list')->with('error', 'Something Went Wrong');
        }
    }

    public function edit($id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        if (!empty($getRecord)) 
        {
            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherId'] = AssignClassTeacherModel::getAssignTeacherId($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            return view('admin.assign_class_teacher.edit', $data);
        } 
        else 
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        AssignClassTeacherModel::deleteTeacher($request->class_id);

        if (!empty($request->teacher_id)) 
        {
            foreach($request->teacher_id as $teacher_id)
            {
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
                if (!empty($getAlreadyFirst)) 
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } 
                else 
                {
                    $aasign_subject =  new AssignClassTeacherModel;
                    $aasign_subject->class_id = $request->class_id;
                    $aasign_subject->teacher_id = $teacher_id;
                    $aasign_subject->status = $request->status;
                    $aasign_subject->created_by = Auth::user()->id;
                    $aasign_subject->save();
                }
            }
        }
        
        return redirect('admin/assign_class_teacher/list')->with('success', 'Assign Class To Teacher Updated');
    }

    public function edit_single($id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        if (!empty($getRecord)) 
        {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            return view('admin.assign_class_teacher.edit_single', $data);
        } 
        else 
        {
            abort(404);
        }
    }

    public function update_single($id, Request $request)
    {
        $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $request->teacher_id);

        if (!empty($getAlreadyFirst)) 
        {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect('admin/assign_class_teacher/list')->with('success', 'Status Successfully Updated');
        } 
        else 
        {
            $aasign_subject =  AssignClassTeacherModel::getSingle($id);
            $aasign_subject->class_id = $request->class_id;
            $aasign_subject->teacher_id = $request->teacher_id;
            $aasign_subject->status = $request->status;
            $aasign_subject->save();
            return redirect('admin/assign_class_teacher/list')->with('success', 'Assign Class To Teacher Updated');
        }
    }

    public function delete($id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        $getRecord->delete();
        return redirect()->back()->with('success', 'Assign Class To Teacher Deleted');
    }

    public function showClassSubject()
    {
        $data['getRecord'] = AssignClassTeacherModel::getMyClassSubject(Auth::user()->id);
        return view('teacher.my_class_subject', $data);
    }
}