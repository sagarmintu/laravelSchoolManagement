<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamScheduleModel;
use App\Models\AssignClassTeacherModel;
use App\Models\User;
use App\Models\MarkRegisterModel;

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
        if (!empty($data['getRecord'])) {
            return view('admin.examinations.exam.edit', $data);
        } else {
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
        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', 'Exam Data Is Deleted');
        } else {
            abort(404);
        }
    }

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();

        $result = array();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $getSubject = ClassSubjectModel::mySubject($request->get('class_id'));
            foreach ($getSubject as $value) {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subjects_name'] = $value->subjects_name;
                $dataS['subjects_type'] = $value->subjects_type;

                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);

                if (!empty($ExamSchedule)) {
                    $dataS['exam_date'] = $ExamSchedule->exam_date;
                    $dataS['start_time'] = $ExamSchedule->start_time;
                    $dataS['end_time'] = $ExamSchedule->end_time;
                    $dataS['room_number'] = $ExamSchedule->room_number;
                    $dataS['full_mark'] = $ExamSchedule->full_mark;
                    $dataS['pass_mark'] = $ExamSchedule->pass_mark;
                } else {
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

        if (!empty($request->schedule)) {
            foreach ($request->schedule as $schedule) {
                if (!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number']) && !empty($schedule['full_mark']) && !empty($schedule['pass_mark'])) {
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

    public function examTimetable(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['pass_mark'] = $valueS->pass_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        return view('student.exam_timetable', $data);
    }

    public function examTimetableTeacher()
    {
        $result = array();
        $getclass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach ($getclass as $class) {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;
            $getExam = ExamScheduleModel::getExam($class->class_id);
            $examArray = array();
            foreach ($getExam as $exam) {
                $dataE = array();
                $dataE['exam_name'] = $exam->exam_name;
                $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id, $class->class_id);
                $subjectArray = array();
                foreach ($getExamTimetable as $valueS) {
                    $dataS = array();
                    $dataS['subject_name'] = $valueS->subject_name;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room_number'] = $valueS->room_number;
                    $dataS['full_mark'] = $valueS->full_mark;
                    $dataS['pass_mark'] = $valueS->pass_mark;
                    $subjectArray[] = $dataS;
                }
                $dataE['subject'] = $subjectArray;
                $examArray[] = $dataE;
            }
            $dataC['exam'] = $examArray;
            $result[] = $dataC;
        }
        $data['getRecord'] = $result;
        return view('teacher.exam_timetable', $data);
    }

    public function examTimetableParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $class_id = $getStudent->class_id;
        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['pass_mark'] = $valueS->pass_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['getStudent'] = $getStudent;
        return view('parent.exam_timetable', $data);
    }

    public function mark_register(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        return view('admin.examinations.mark_register', $data);
    }

    public function submit_mark_register(Request $request)
    {
        $validation = 0;
        if (!empty($request->mark)) 
        {
            foreach ($request->mark as $mark) 
            {
                $getExamSchedule = ExamScheduleModel::getSingle($mark['id']);
                $full_mark = $getExamSchedule->full_mark;

                $class_work = !empty($mark['class_work']) ? $mark['class_work'] : 0;
                $home_work = !empty($mark['home_work']) ? $mark['home_work'] : 0;
                $test_work = !empty($mark['test_work']) ? $mark['test_work'] : 0;
                $exam = !empty($mark['exam']) ? $mark['exam'] : 0;

                $total_mark = $class_work + $home_work + $test_work + $exam;

                if ($full_mark >= $total_mark)
                {
                    $getMark = MarkRegisterModel::checkAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id']);

                    if (!empty($getMark)) {
                        $save = $getMark;
                    } else {
                        $save                 = new MarkRegisterModel;
                        $save->created_by =  Auth::user()->id;
                    }
                    $save->student_id = $request->student_id;
                    $save->exam_id = $request->exam_id;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $mark['subject_id'];
                    $save->class_work = $class_work;
                    $save->home_work = $home_work;
                    $save->test_work = $test_work;
                    $save->exam = $exam;
    
                    $save->save();
                }
                else
                {
                    $validation = 1;
                }
            }
        }

        if($validation == 0)
        {
            $json['message'] = "Mark Is Registered Successfully";
        }
        else
        {
            $json['message'] = "Some Subjects Mark Is Greater Than The Full Mark";
        }

        echo json_encode($json);
    }

    public function single_submit_mark_register(Request $request)
    {
        $id = $request->id;
        $getExamSchedule = ExamScheduleModel::getSingle($id);
        $full_mark = $getExamSchedule->full_mark;

        $class_work = !empty($request->class_work) ? $request->class_work : 0;
        $home_work = !empty($request->home_work) ? $request->home_work : 0;
        $test_work = !empty($request->test_work) ? $request->test_work : 0;
        $exam = !empty($request->exam) ? $request->exam : 0;

        $total_mark = $class_work + $home_work + $test_work + $exam;

        if ($full_mark >= $total_mark) 
        {

            $getMark = MarkRegisterModel::checkAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id);

            if (!empty($getMark)) 
            {
                $save = $getMark;
            } 
            else 
            {
                $save             = new MarkRegisterModel;
                $save->created_by =  Auth::user()->id;
            }
            $save->student_id = $request->student_id;
            $save->exam_id = $request->exam_id;
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->class_work = $class_work;
            $save->home_work = $home_work;
            $save->test_work = $test_work;
            $save->exam = $exam;
            $save->save();

            $json['message'] = "Mark Is Registered Successfully";
        }
        else
        {
            $json['message'] = "Your Total Mark Is Greater Than Full Mark.";
        }
        echo json_encode($json);
    }

    public function mark_register_teacher(Request $request)
    {
        $data['getclass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getExam'] = ExamScheduleModel::getExamTeacher(Auth::user()->id);
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        return view('teacher.mark_register', $data);
    }
}