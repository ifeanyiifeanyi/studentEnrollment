<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentManagementController extends Controller
{
    public function index(){
        $students = User::with('student')->latest()->get();
        // dd($students);
        return view('admin.studentManagement.index', compact('students'));
    }
}
