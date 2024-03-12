<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SubjectModel;
use App\Models\ClassModel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalAdmin = User::count();
        $totalSubject = SubjectModel::count();
        $totalClass = ClassModel::count();

        $totalAdminCount = User::where('user_type','1')->count();
        $totalTeacherCount = User::where('user_type','2')->count();
        $totalStudentCount = User::where('user_type','3')->count();
        $totalParentCount = User::where('user_type','4')->count();

        if(Auth::user()->user_type == 1)
        {
            return view('admin.dashboard', compact('totalAdmin', 'totalSubject', 'totalClass', 'totalAdminCount', 'totalStudentCount'));
        }
        elseif (Auth::user()->user_type == 2) 
        {
            return view('teacher.dashboard', compact('totalTeacherCount'));
        }
        elseif (Auth::user()->user_type == 3) 
        {
            return view('student.dashboard', compact('totalStudentCount'));
        }
        elseif (Auth::user()->user_type == 4) 
        {
            return view('parent.dashboard', compact('totalParentCount'));
        }
    }
}
