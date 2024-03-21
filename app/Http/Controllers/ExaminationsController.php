<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamScheduleModel;

class ExaminationsController extends Controller
{
    public function exam_list()
    {
        $data['getRecord'] = ExamModel::getRecord();
        return view('admin.examinations.exam.list', $data);
    }

    public function add_exam()
    {
        return view('admin.examinations.exam.add');
    }

    public function insert_exam(Request $request)
    {
        $exam = new ExamModel;
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', 'New Exam Is Created');
    }

    public function edit_exam($id)
    {
        $data['getRecord'] = ExamModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            return view('admin.examinations.exam.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update_exam($id, Request $request)
    {
        $exam =  ExamModel::getSingle($id);
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', 'Exam Data Is Updated');
    }

    public function delete_exam($id)
    {
        $getRecord = ExamModel::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', 'Exam Data Is Deleted');
        }
        else
        {
            abort(404);
        }
    }

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();

        $result = array();
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $getSubject = ClassSubjectModel::mySubject($request->get('class_id'));
            foreach($getSubject as $value)
            {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subjects_name'] = $value->subjects_name;
                $dataS['subjects_type'] = $value->subjects_type;

                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);

                if(!empty($ExamSchedule))
                {
                    $dataS['exam_date'] = $ExamSchedule->exam_date;
                    $dataS['start_time'] = $ExamSchedule->start_time;
                    $dataS['end_time'] = $ExamSchedule->end_time;
                    $dataS['room_number'] = $ExamSchedule->room_number;
                    $dataS['full_mark'] = $ExamSchedule->full_mark;
                    $dataS['pass_mark'] = $ExamSchedule->pass_mark;
                }
                else
                {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['pass_mark'] = '';
                }

                $result[] = $dataS;
            }
        }
        $data['getRecord'] = $result;
        return view('admin.examinations.exam_schedule', $data);
    }

    public function exam_schedule_insert(Request $request)
    {
        ExamScheduleModel::deleteRecord($request->exam_id, $request->class_id);
        
        if(!empty($request->schedule))
        {
            foreach($request->schedule as $schedule)
            {
                if(!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number']) && !empty($schedule['full_mark']) && !empty($schedule['pass_mark']))
                {
                    $exam = new ExamScheduleModel;
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->subject_id = $schedule['subject_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->room_number = $schedule['room_number'];
                    $exam->full_mark = $schedule['full_mark'];
                    $exam->pass_mark = $schedule['pass_mark'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
            }
        }
        return redirect('admin/examinations/exam_schedule')->with('success', 'Exam Schedule Successfully Created');
    }
}