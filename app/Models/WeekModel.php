<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekModel extends Model
{
    use HasFactory;

    protected $table = 'weeks';

    protected $fillable = [
        'name',
    ];

    static public function getRecord()
    {
        return WeekModel::get();
    }

    static public function getWeekUsingName($weekname)
    {
        return WeekModel::where('name','=',$weekname)->first();
    }
}
