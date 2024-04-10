@extends('student.layouts.studentLayout')

@section('title', 'Payment Success')

@section('student')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Successful</div>

                <div class="card-body">
                    <p>Thank you, {{ $user->fullName }}! Your payment for the application #{{ $application->invoice_number }} has been processed successfully.</p>

                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ Storage::url($user->student->passport_photo) }}" class="img-fluid" alt="Passport Photo">
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group">
                                <li class="list-group-item">Invoice Number: {{ $application->invoice_number }}</li>
                                <li class="list-group-item">Application Number: {{ $user->student->application_unique_number }}</li>
                                <li class="list-group-item">Full Name: {{ $user->fullName }}</li>
                                <li class="list-group-item">Application Date: {{ $application->created_at->format('jS F, Y') }}</li>
                                <li class="list-group-item">Department: {{ $application->department->name }}</li>
                                <li class="list-group-item">Faculty: {{ $application->department->faculty->name }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button onclick="window.print()" class="btn btn-primary">Print Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection