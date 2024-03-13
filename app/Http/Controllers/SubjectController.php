<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubjectModel;
use App\Models\User;
use App\Models\ClassSubjectModel;

class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubjectModel::getRecord();
        return view('admin.subject.list',$data);
    }

    public function add()
    {
        return view('admin.subject.add');
    }

    public function insert(Request $request)
    {
        $subject = new SubjectModel;
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->created_by = Auth::user()->id;
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'New Subject Is Created');
    }

    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            return view('admin.subject.edit',$data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $subject = SubjectModel::getSingle($id);
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'Subject Is Updated');
    }

    public function delete($id)
    {
        $subject = SubjectModel::getSingle($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'Subject Data Is Deleted');
    }

    public function mySubject()
    {
        $data['getRecord'] = ClassSubjectModel::mySubject(Auth::user()->class_id);
        return view('student.my_subject', $data);
    }

    public function subjectList($student_id)
    {
        $user = User::getSingle($student_id);
        $data['user'] = $user;
        $data['getRecord'] = ClassSubjectModel::mySubject($user->class_id);
        return view('parent.my_student_subject', $data);
    }
}
