<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        return view('student.profile.index', ['user' => auth()->user()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'first_name' =>'required|string',
            'last_name' =>'required|string',
            'other_names' =>'required|string',
            'email' =>'required|email',
            'gender' =>'required|string',
            'religion' =>'required|string',
            'dob' =>'required|date',
            'current_residence_address' =>'required|string',
            'permanent_residence_address' =>'required|string',
            'secondary_school_attended' =>'required|string',
            'secondary_school_graduation_year' =>'required|date',
            'phone' =>'required|string',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
