<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Exports\ApplicationsExport;
use App\Imports\ApplicationsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class StudentManagementController extends Controller
{
    public function index()
    {
        $students = User::with(['applications' => function ($query) {
            $query->select('applications.*', 'departments.name as department_name')
                ->join('departments', 'applications.department_id', '=', 'departments.id');
        }])
            ->where('role', 'student')
            ->simplePaginate(100);
        // $students = User::where('role', 'student')->simplePaginate('100');
        // dd($students);
        return view('admin.studentManagement.index', compact('students'));
    }

    public function show($slug)
    {

        $student = User::with(['applications' => function ($query) {
            $query->select('applications.*', 'departments.name as department_name')
                ->join('departments', 'applications.department_id', '=', 'departments.id');
        }])
            ->where('role', 'student')
            ->where('nameSlug', $slug)
            ->first();
        return view('admin.studentManagement.show', compact('student'));
    }









    public function application(Request $request)
    {
        $departments = Department::latest()->get();
        $departmentId = $request->input('department_id');

        if ($departmentId) {
            $applications = Application::with(['user.student', 'department'])
                ->where('department_id', $departmentId)
                ->simplePaginate(50);
        } else {
            $applications = Application::with(['user.student', 'department'])->simplePaginate(50);
        }

        return view('admin.studentManagement.application', compact('applications', 'departments'));
    }

    public function exportApplications(Request $request)
    {
        $departmentId = $request->input('department_id');
        return Excel::download(new ApplicationsExport($departmentId), 'applications.xlsx');
    }


















    // public function import()
    // {
    //     $this->validate(request(), [
    //         'file' => 'required|file|mimes:xlsx,xls',
    //     ]);
    //     // dd(request()->file('file')->get());
    //     // Import the applications from the Excel file
    //     // config(['excel.import.startRow' => 2    ]);

    //     Excel::import(new ApplicationsImport, request()->file('file'));
    //     $notification = [
    //         'message' => 'Applications imported successfully.',
    //         'alert-type' => 'success'
    //     ];

    //     return redirect()->route('admin.student.application')->with($notification);
    // }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');

        // Validate the file or perform other pre-import logic here

        Excel::import(new ApplicationsImport, $file);

        return back()->withSuccess('Applications updated successfully.');
    }
}
