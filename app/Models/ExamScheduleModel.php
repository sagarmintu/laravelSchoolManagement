<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleModel extends Model
{
    use HasFactory;

    protected $table = 'exam_schedules';

    protected $fillable = [
        'exam_id',
        'class_id',
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
        'room_number',
        'full_mark',
        'pass_mark',
    ];

    static public function getRecordSingle($exam_id, $class_id, $subject_id)
    {
        return self::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function deleteRecord($exam_id, $class_id)
    {
        self::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->delete();
    }

    static public function getExam($class_id)
    {
        return ExamScheduleModel::select('exam_schedules.*','exams.name as exam_name')
                    ->join('exams', 'exams.id', '=', 'exam_schedules.exam_id')
                    ->where('exam_schedules.class_id', '=', $class_id)
                    ->groupBy('exam_id')
                    ->orderBy('exam_schedules.id', 'asc')
                    ->get();
    }

    static public function getExamTimetable($exam_id, $class_id)
    {
        return ExamScheduleModel::select('exam_schedules.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
                    ->join('subjects', 'subjects.id', '=', 'exam_schedules.subject_id')
                    ->where('exam_schedules.exam_id', '=', $exam_id)
                    ->where('exam_schedules.class_id', '=', $class_id)
                    ->get();
    }
}
