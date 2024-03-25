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
        $departments = Department::doesntHave('exam_managers')->get();
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

        $examSubjects = $request->input('exam_subject');
        $examSubjectsJson = json_encode($examSubjects);

        $exam = new ExamManager;
        $exam->department_id = $request->input('department_id');
        $exam->exam_subject = $examSubjectsJson;
        $exam->venue = $request->input('venue');
        $exam->date_time = $request->input('date_time');
        $exam->save();


        $notification = [
            'message' => 'Department Exam Subject Created!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function examDetails()
    {
        $exams = ExamManager::latest()->simplePaginate('20');
        return view('admin.subjects.details', compact('exams'));
    }

    public function examInformation($id){
        $exam = ExamManager::find($id);
        return view('admin.subjects.information', compact('exam'));
    }

    public function edit($id){
        $exam = ExamManager::find($id);
        $departments = Department::all();
        return view('admin.subjects.edit', compact('exam', 'departments'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'exam_subject.*' => 'required|string',
            'venue' => 'required|string',
            'date_time' => 'required',
        ], [
            'exam_subject.*.required' => 'Please enter exam subject',
        ]);

        $examSubjects = $request->input('exam_subject');
        $examSubjectsJson = json_encode($examSubjects);

        $exam = ExamManager::find($id);
        $exam->department_id = $request->input('department_id');
        $exam->exam_subject = $examSubjectsJson;
        $exam->venue = $request->input('venue');
        $exam->date_time = $request->input('date_time');
        $exam->save();

        $notification = [
            'message' => 'Department Exam Subject Update!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.exam.details')->with($notification);
    }

    public function destroy($id){
        $exam = ExamManager::find($id);
        // dd($exam);
        $exam->delete();

        $notification = [
           'message' => 'Department Exam Subject Deleted!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
