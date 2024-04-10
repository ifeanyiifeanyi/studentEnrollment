<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\PaymentMethod;

class ApplicationProcessController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $application = $user->applications->first();
        // dd($application);
        if ($application && is_null($application->payment_id)) {
            // Application form has been filled, but payment is pending
            return redirect()->route('payment.view.finalStep', ['userSlug' => $user->nameSlug])->with('info', 'Please complete the payment to finalize your application.');
        }
        return view('student.application.index');
    }

    public function finalApplicationStep($userSlug)
    {
        $user = User::Where('nameSlug', $userSlug)->first();
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors('You must be logged in to access this page.');
        }
        // Check if the user was found
        if (!$user) {
            return redirect()->back()->withErrors('User not found.');
        }
        // Check if the authenticated user matches the user found by the slug
        if (auth()->user()->id !== $user->id) {
            return redirect()->back()->withErrors('You are not authorized to access this page.');
        }
        // Find the application associated with the user
        $application = Application::where('user_id', $user->id)->first();
        // Check if the application was found
        if (!$application) {
            return redirect()->back()->withErrors('Application not found for this user.');
        }
        $paymentMethods = PaymentMethod::latest()->get();
        // dd($application->department);

        return view('student.payment.index', compact('user', 'application', 'paymentMethods'));
    }
}
