<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Models\WeekModel;

class AssignClassTeacherModel extends Model
{
    use HasFactory;

    protected $table = 'assign_class_teacher';

    protected $fillable = [
        'class_id',
        'teacher_id',
        'status',
    ];

    static public function getRecord()
    {
        $return = self::select('assign_class_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'users.name as created_by_name')
                    ->join('users as teacher', 'teacher.id', '=', 'assign_class_teacher.teacher_id')
                    ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
                    ->join('users', 'users.id', '=', 'assign_class_teacher.created_by')
                    ->where('assign_class_teacher.is_delete', '=', 0);

        if(!empty(Request::get('class_name')))
        {
            $return = $return->where('class.name','like','%'.Request::get('class_name').'%');
        }

        if(!empty(Request::get('teacher_name')))
        {
            $return = $return->where('teacher.name','like','%'.Request::get('teacher_name').'%');
        }

        if(!empty(Request::get('date')))
        {
            $return = $return->whereDate('assign_class_teacher.created_at','=', Request::get('date'));
        }

        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == '100') ? 0 : 1;
            $return = $return->where('users.status','=', $status);
        }


        $return = $return->orderBy('assign_class_teacher.id','asc')
                    ->paginate(10);

        return $return;
    }

    static public function getAlreadyFirst($class_id, $teacher_id)
    {
        return self::where('class_id','=',$class_id)->where('teacher_id','=',$teacher_id)->first();
    }

    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }

    static public function getAssignTeacherId($class_id)
    {
        return self::where('class_id','=',$class_id)->where('is_delete','=', 0)->get();
    }

    static public function deleteTeacher($class_id)
    {
        return self::where('class_id','=',$class_id)->delete();
    }

    static public function getMyClassSubject($teacher_id)
    {
        $return = self::select('assign_class_teacher.*', 'class.name as class_name', 'subjects.name as subject_name', 'subjects.type as subject_type', 'class.id as class_id', 'subjects.id as subject_id')
                    ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
                    ->join('class_subjects', 'class_subjects.class_id', '=', 'class.id')
                    ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                    ->where('assign_class_teacher.is_delete', '=', 0)
                    ->where('assign_class_teacher.status', '=', 0)
                    ->where('subjects.status', '=', 0)
                    ->where('subjects.is_delete', '=', 0)
                    ->where('class_subjects.status', '=', 0)
                    ->where('class_subjects.is_delete', '=', 0)
                    ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
                    ->paginate(20);

        return $return;
    }

    static public function getTimetable($class_id, $subject_id)
    {
        $getWeek = WeekModel::getWeekUsingName(date('l'));
        return ClassSubjectTimetableModel::getRecordClassTimetable($class_id, $subject_id, $getWeek->id);
    }
}
