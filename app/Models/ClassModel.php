<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    protected $fillable = [
        'name',
        'status',
    ];

    static public function getRecord()
    {
        $classDetails = ClassModel::select('class.*','users.name as created_by_name')
                            ->join('users','users.id','class.created_by');

        if(!empty(Request::get('name')))
        {
            $classDetails = $classDetails->where('class.name','like','%'.Request::get('name').'%');
        }

        if(!empty(Request::get('date')))
        {
            $classDetails = $classDetails->whereDate('class.created_at','=', Request::get('date'));
        }

        $classDetails = $classDetails->where('class.is_delete','=', 0)
                            ->orderBy('class.id','asc')
                            ->paginate(5);
        return $classDetails;
    }

    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }
}
