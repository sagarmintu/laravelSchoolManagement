<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimetableModel extends Model
{
    use HasFactory;

    protected $table = 'class_subject_timetable';

    protected $fillable = [
        'class_id',
        'subject_id',
        'week_id',
        'start_time',
        'end_time',
        'room_number',
    ];

    static public function getRecordClassTimetable($class_id,$subject_id,$week_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->where('week_id', '=', $week_id)->first();
    }
}
