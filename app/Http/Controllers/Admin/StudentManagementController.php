<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use App\Models\Application;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ApplicationsExport;
use App\Imports\ApplicationsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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

        $documentKeys = [
            'birth_certificate' => 'document_birth_certificate',
            'local_government_identification' => 'document_local_government_identification',
            'medical_report' => 'document_medical_report',
            'secondary_school_certificate' => 'document_secondary_school_certificate_type'
        ];

        $documents = [];
        foreach ($documentKeys as $label => $key) {
            $filename = $student->student->$key;
            if ($filename) { // Corrected path check
                $filePath = Storage::url($filename); // Corrected URL generation
                $isPdf = Str::endsWith($filename, '.pdf');
                $documents[$label] = [
                    'filePath' => $filePath,
                    'isPdf' => $isPdf,
                    'exists' => true
                ];
            } else {
                $documents[$label] = [
                    'exists' => false
                ];
            }
        }
        // dd($documents);


        return view('admin.studentManagement.show', compact('student', 'documents'));
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



    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');


        Excel::import(new ApplicationsImport, $file);
        $notification = [
            'message' => 'File Import Was Successful!!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }



    public function deleteMultipleStudents(Request $request)
    {
        $userIds = $request->input('selected_students'); // These are user IDs.

        DB::transaction(function () use ($userIds) {
            $students = Student::whereIn('user_id', $userIds)->get();
            // dd($students);

            foreach ($students as $student) {
                // List of document columns to check and potentially delete
                $documentFields = [
                    'document_birth_certificate',
                    'document_local_government_identification',
                    'document_medical_report',
                    'document_secondary_school_certificate'
                ];
                // dd($student->passport_photo);
                // Delete passport photo if it exists
                if ($student->passport_photo && Storage::disk('public')->exists($student->passport_photo)) {
                    Storage::disk('public')->delete($student->passport_photo);
                }

                // Check and delete each document if it exists
                foreach ($documentFields as $field) {
                    if ($student->$field && Storage::disk('public')->exists($student->$field)) {
                        Storage::disk('public')->delete($student->$field);
                    }
                }

                // Delete the student record
                $student->delete();
            }

            // Delete users associated with these student records
            User::whereIn('id', $userIds)->delete();
        });
        $notification = [
            'message' => 'Students deleted successfully!!',
            'alert-type' => 'success'
        ];


        return redirect()->back()->with($notification);
    }

    public function destroy($slug)
    {
        DB::transaction(function () use ($slug) {
            $user = User::where('nameSlug', $slug)->firstOrFail(); // Find the user by slug
            // dd($user);

            $student = $user->student; // Assuming there is a 'student' relationship defined in the User model
            // dd($student);


            // Check and delete files associated with the student
            $filesToDelete = [
                $student->passport_photo,
                $student->document_birth_certificate,
                $student->document_local_government_identification,
                $student->document_medical_report,
                $student->document_secondary_school_certificate
            ];

            foreach ($filesToDelete as $filePath) {
                if ($filePath && Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }

            // Delete the student record
            $student->delete();

            // Optionally delete the user if required
            $user->delete();
        });

        $notification = [
            'message' => 'Student deleted successfully!!',
            'alert-type' => 'success'
        ];


        return redirect()->back()->with($notification);
    }
}
