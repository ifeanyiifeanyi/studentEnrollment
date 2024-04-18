<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Application;
use App\Models\Student;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Log;


class ApplicationsImport implements ToModel, WithHeadingRow
{
    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        // dd($row);
        // Use the exact column headings from the Excel file
        $email = $row['Email']; // Email column as appears in Excel file
        $examScore = $row['Exam Score']; // Exam Score column as appears in Excel file
        $departmentName = $row['Department']; // Department column as appears in Excel file
        $admissionStatus = $row['Admission Status']; // Admission Status column as appears in Excel file

        $user = User::where('email', $email)->first();

        if (!$user) {
            Log::warning("User with email {$email} not found.");
            return null;
        }

        // Update the student's exam score
        $student = $user->student;
        if ($student) {
            $student->exam_score = $examScore;
            $student->save();
        } else {
            Log::warning("Student record for user {$user->id} not found.");
        }

        // Update the application's admission status
        $department = Department::where('name', $departmentName)->first();
        if ($department) {
            $application = Application::where('user_id', $user->id)
                ->where('department_id', $department->id)
                ->first();
            if ($application) {
                $application->admission_status = $admissionStatus;
                $application->save();
            } else {
                Log::warning("Application for user {$user->id} in department {$department->id} not found.");
            }
        } else {
            Log::warning("Department {$departmentName} not found.");
        }

        return null; // We're not creating a new model, just updating.
    }
}
