<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassModel::getRecord();
        return view('admin.class.list',$data);
    }

    public function add()
    {
        return view('admin.class.add');
    }

    public function insert(Request $request)
    {
        $class = new ClassModel;
        $class->name = $request->name;
        $class->status = $request->status;
        $class->created_by = Auth::user()->id;
        $class->save();
        return redirect('admin/class/list')->with('success', 'New Class Is Created');
    }

    public function edit($id)
    {
        $data['getRecord'] = ClassModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            return view('admin.class.edit',$data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $class = ClassModel::getSingle($id);
        $class->name = $request->name;
        $class->status = $request->status;
        $class->save();
        return redirect('admin/class/list')->with('success', 'Class Is Updated');
    }

    public function delete($id)
    {
        $class = ClassModel::getSingle($id);
        $class->is_delete = 1;
        $class->save();
        return redirect('admin/class/list')->with('success', 'Class Data Is Deleted');
    }
}
