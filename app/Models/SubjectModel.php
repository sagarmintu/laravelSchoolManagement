<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SubjectModel extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'type',
        'status',
    ];

    static public function getRecord()
    {
        $classDetails = SubjectModel::select('subjects.*','users.name as created_by_name')
                            ->join('users','users.id','subjects.created_by');

        if(!empty(Request::get('name')))
        {
            $classDetails = $classDetails->where('subjects.name','like','%'.Request::get('name').'%');
        }

        if(!empty(Request::get('type')))
        {
            $classDetails = $classDetails->where('subjects.type','=',Request::get('type'));
        }

        if(!empty(Request::get('date')))
        {
            $classDetails = $classDetails->whereDate('subjects.created_at','=', Request::get('date'));
        }

        $classDetails = $classDetails->where('subjects.is_delete','=', 0)
                            ->orderBy('subjects.id','asc')
                            ->paginate(5);
        return $classDetails;
    }

    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }
}
