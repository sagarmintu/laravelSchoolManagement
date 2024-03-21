<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ExamModel extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $fillable = [
        'name',
        'note',
    ];

    static public function getRecord()
    {
        $return = self::select('exams.*', 'users.name as created_name')
                    ->join('users','users.id','=','exams.created_by');

        if(!empty(Request::get('name')))
        {
            $return = $return->where('exams.name','like','%'.Request::get('name').'%');
        }

        if(!empty(Request::get('date')))
        {
            $return = $return->whereDate('exams.created_at','=', Request::get('date'));
        }

        $return = $return->where('exams.is_delete', '=', 0)
                    ->orderBy('exams.id', 'asc')
                    ->paginate(50);

        return $return;
    }

    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }
}
