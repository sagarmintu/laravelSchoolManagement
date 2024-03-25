<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;
use App\Models\WeekModel;
use App\Models\ClassSubjectTimetableModel;

class CalendarController extends Controller
{
    public function calendar()
    {
        $result = array();
        $getRecord = ClassSubjectModel::mySubject(Auth::user()->class_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->subjects_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) 
            {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalender_day'] = $valueW->fullcalender_day;

                $classSubject = ClassSubjectTimetableModel::getRecordClassTimetable($value->class_id, $value->subject_id, $valueW->id);

                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $week[] = $dataW;
                }
            }

            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        
        $data['getMyTimetable'] = $result;
        return view("student.calender", $data);
    }
}
