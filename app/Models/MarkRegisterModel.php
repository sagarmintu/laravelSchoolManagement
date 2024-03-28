<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkRegisterModel extends Model
{
    use HasFactory;

    protected $table = 'mark_register';

    protected $fillable = [
        'student_id',
        'exam_id',
        'class_id',
        'subject_id',
        'class_work',
        'home_work',
        'test_work',
        'exam',
    ];

    static public function checkAlreadyMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return MarkRegisterModel::where('student_id', '=', $student_id)->where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function getExam($student_id)
    {
        return self::select('mark_register.*', 'exams.name as exam_name')
                    ->join('exams', 'exams.id', '=', 'mark_register.exam_id')
                    ->where('mark_register.student_id', '=', $student_id)
                    ->groupBy('mark_register.exam_id')
                    ->get();
    }

    static public function getExamSubject($exam_id, $student_id)
    {
        return self::select('mark_register.*', 'exams.name as exam_name', 'subjects.name as subject_name')
                    ->join('exams', 'exams.id', '=', 'mark_register.exam_id')
                    ->join('subjects', 'subjects.id', '=', 'mark_register.subject_id')
                    ->where('mark_register.exam_id', '=', $exam_id)
                    ->where('mark_register.student_id', '=', $student_id)
                    ->get();
    }
}
