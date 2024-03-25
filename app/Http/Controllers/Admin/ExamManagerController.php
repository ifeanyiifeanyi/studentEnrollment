<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\ExamManager;
use Illuminate\Http\Request;

class ExamManagerController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.subjects.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'exam_subject.*' => 'required',
            'venue' => 'required',
            'date_time' => 'required',
        ], [
            'exam_subject.*.required' => 'Please enter exam subject',
        ]);

        // $exam = new ExamManager;
        // $exam->department_id = $request->input('department_id');
        // $exam->exam_subject = $request->input('exam_subject');
        // $exam->venue = $request->input('venue');
        // $exam->date_time = $request->input('date_time');
        // $exam->save();


        $examSubjects = $request->input('exam_subject');
        $examSubjectsJson = json_encode($examSubjects);

        $exam = new ExamManager;
        $exam->department_id = $request->input('department_id');
        $exam->exam_subject = $examSubjectsJson;
        $exam->venue = $request->input('venue');
        $exam->date_time = $request->input('date_time');
        $exam->save();

        // $departmentId = $request->input('department_id');
        // $subjects = $request->input('exam_subject');
        // $venue = $request->input('venue');
        // $date_time = $request->input('date_time');

        // // Create exam subjects
        // foreach ($subjects as $subject) {
        //     ExamManager::create([
        //         'department_id' => $departmentId,
        //         'exam_subject' => $subject,
        //         'venue' => $venue,
        //         'date_time' => $date_time
        //     ]);
        // }

        $notification = [
            'message' => 'Department Exam Subject Created!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
