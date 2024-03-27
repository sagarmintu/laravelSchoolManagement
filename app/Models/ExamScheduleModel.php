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
                    ->groupBy('exam_schedules.exam_id')
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

    static public function getExamTimetableTeacher($teacher_id)
    {
        return ExamScheduleModel::select('exam_schedules.*', 'class.name as class_name', 'subjects.name as subject_name', 'exams.name as exam_name')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'exam_schedules.class_id')
            ->join('class', 'class.id', '=', 'exam_schedules.class_id')
            ->join('subjects', 'subjects.id', '=', 'exam_schedules.subject_id')
            ->join('exams','exams.id', '=', 'exam_schedules.exam_id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->get();
    }

    static public function getSubject($exam_id,$class_id)
    {
        return ExamScheduleModel::select('exam_schedules.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
                ->join('subjects', 'subjects.id', '=', 'exam_schedules.subject_id')
                ->where('exam_schedules.exam_id', '=', $exam_id)
                ->where('exam_schedules.class_id', '=', $class_id)
                ->get();
    }

    static public function getMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return MarkRegisterModel::checkAlreadyMark($student_id, $exam_id, $class_id, $subject_id);
    }

    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }

    static public function getExamTeacher($teacher_id)
    {
        return ExamScheduleModel::select('exam_schedules.*','exams.name as exam_name')
                    ->join('exams', 'exams.id', '=', 'exam_schedules.exam_id')
                    ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'exam_schedules.class_id')
                    ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
                    ->groupBy('exam_schedules.exam_id')
                    ->orderBy('exam_schedules.id', 'asc')
                    ->get();
    }
}