<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;

class StudentManagementController extends Controller
{
    public function index(){
        $departments = Department::latest()->get();
        // $students = User::with('applications.department')->where('role', 'student')->simplePaginate('100');
        $students = User::where('role', 'student')->simplePaginate('100');
        // dd($students);
        return view('admin.studentManagement.index', compact('students', 'departments'));
    }

    public function show($slug){

        $student = User::where('role','student')->where('nameSlug',$slug)->first();
        return view('admin.studentManagement.show', compact('student'));

    }
}
