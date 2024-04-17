<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentManagementController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        // $students = User::with('applications.department')->where('role', 'student')->simplePaginate('100');
        $students = User::where('role', 'student')->simplePaginate('100');
        // dd($students);
        return view('admin.studentManagement.index', compact('students', 'departments'));
    }

    public function show($slug)
    {

        $student = User::where('role', 'student')->where('nameSlug', $slug)->first();
        return view('admin.studentManagement.show', compact('student'));
    }

    public function application(Request $request)
    {
        $departmentId = $request->input('department_id');

        if ($departmentId) {
            $applications = Application::with('user', 'payment')
                ->whereHas('department', function ($query) use ($departmentId) {
                    $query->where('id', $departmentId);
                })
                ->simplePaginate('50');

            $selectedDepartment = Department::findOrFail($departmentId);
        } else {
            $applications = Application::with('user', 'department', 'payment')->simplePaginate('50');
            $selectedDepartment = null;
        }

        return view('admin.studentManagement.application', compact('applications', 'selectedDepartment'));
    }
}
