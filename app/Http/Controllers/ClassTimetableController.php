<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\WeekModel;
use App\Models\ClassSubjectTimetableModel;
use Illuminate\Support\Facades\Auth;

class ClassTimetableController extends Controller
{
    public function list(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if(!empty($request->class_id))
        {
            $data['getSubject'] = ClassSubjectModel::mySubject($request->class_id);
        }

        $getWeek = WeekModel::getRecord();
        $week = array();
        
        foreach($getWeek as $value)
        {
            $dataW = array();
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;

            if(!empty($request->class_id) && !empty($request->subject_id))
            {
                $classSubject = ClassSubjectTimetableModel::getRecordClassTimetable($request->class_id,$request->subject_id,$value->id);
                if(!empty($classSubject))
                {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
            }
            else
            {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }

            $week[] = $dataW;
        }

        $data['week'] = $week;

        return view('admin.class_timetable.list', $data);
    }

    public function get_subject(Request $request)
    {
        $getSubject = ClassSubjectModel::mySubject($request->class_id);

        $html = "<option value=''>select Subject</option>";

        foreach($getSubject as $value)
        {
            $html .= "<option value='".$value->subject_id."'>".$value->subjects_name."</option>";
        }
        
        $json['html'] = $html;
        echo json_encode($json);
    }

    public function insert_update(Request $request)
    {
        ClassSubjectTimetableModel::where('class_id', '=', $request->class_id)->where('subject_id', '=', $request->subject_id)->delete();

        foreach($request->timetable as $timetable)
        {
            if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']))
            {
                $class_timetable = new ClassSubjectTimetableModel;
                $class_timetable->class_id = $request->class_id;
                $class_timetable->subject_id = $request->subject_id;
                $class_timetable->week_id = $timetable['week_id'];
                $class_timetable->start_time = $timetable['start_time'];
                $class_timetable->end_time = $timetable['end_time'];
                $class_timetable->room_number = $timetable['room_number'];
                $class_timetable->save();
            }
        }
        return redirect()->back()->with('success', 'Class Timetable Is Added Successfully');
    }

    public function myTimetable()
    {
        $result = array();
        $getRecord = ClassSubjectModel::mySubject(Auth::user()->class_id);
        foreach($getRecord as $value)
        {
            $dataS['name'] = $value->subjects_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $valueW)
            {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;

                $classSubject = ClassSubjectTimetableModel::getRecordClassTimetable($value->class_id,$value->subject_id,$valueW->id);

                if(!empty($classSubject))
                {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }

                $week[] = $dataW;
            }

            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getRecord'] = $result;
        return view('student.myTimetable', $data);
    }
}
