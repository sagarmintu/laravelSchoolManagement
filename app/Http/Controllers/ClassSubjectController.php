<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassSubjectModel::getRecord();
        return view('admin.assign_subject.list',$data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request)
    {
        if (!empty($request->subject_id)) 
        {
            foreach($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)) 
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } 
                else 
                {
                    $aasign_subject =  new ClassSubjectModel;
                    $aasign_subject->class_id = $request->class_id;
                    $aasign_subject->subject_id = $subject_id;
                    $aasign_subject->status = $request->status;
                    $aasign_subject->created_by = Auth::user()->id;
                    $aasign_subject->save();
                }
            }
            return redirect('admin/assign_subject/list')->with('success', 'Subject Is Successfully Assign To Class');
        } 
        else 
        {
            return redirect('admin/assign_subject/list')->with('error', 'Subject Name Is Not Found');
        }
    }

    public function edit($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);
        if (!empty($getRecord)) 
        {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectId'] = ClassSubjectModel::getAssignSubjectId($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            return view('admin.assign_subject.edit', $data);
        } 
        else 
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        ClassSubjectModel::deleteSubject($request->class_id);

        if (!empty($request->subject_id)) 
        {
            foreach($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)) 
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } 
                else 
                {
                    $aasign_subject =  new ClassSubjectModel;
                    $aasign_subject->class_id = $request->class_id;
                    $aasign_subject->subject_id = $subject_id;
                    $aasign_subject->status = $request->status;
                    $aasign_subject->created_by = Auth::user()->id;
                    $aasign_subject->save();
                }
            }
        } 
            return redirect('admin/assign_subject/list')->with('success', 'Subject Is Updated Assign To Class');
    }

    public function delete($id)
    {
        $delete_assign_subject = ClassSubjectModel::getSingle($id);
        $delete_assign_subject->is_delete = 1;
        $delete_assign_subject->save();
        return redirect('admin/assign_subject/list')->with('success', 'Recxord Successfully Deleted');
    }

    public function edit_single($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);
        if (!empty($getRecord)) 
        {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            return view('admin.assign_subject.edit_single', $data);
        } 
        else 
        {
            abort(404);
        }
    }

    public function update_single($id, Request $request)
    {

        $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id);

        if (!empty($getAlreadyFirst)) 
        {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect('admin/assign_subject/list')->with('success', 'Status Successfully Updated');
        } 
        else 
        {
            $aasign_subject =  ClassSubjectModel::getSingle($id);
            $aasign_subject->class_id = $request->class_id;
            $aasign_subject->subject_id = $request->subject_id;
            $aasign_subject->status = $request->status;
            $aasign_subject->save();
            return redirect('admin/assign_subject/list')->with('success', 'Subject Is Updated Assign To Class');
        }

    }
}
