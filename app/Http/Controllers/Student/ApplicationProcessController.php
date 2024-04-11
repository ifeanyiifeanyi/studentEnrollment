<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Payment;
use App\Models\PaymentMethod;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use Unicodeveloper\Flutterwave\Facades\Flutterwave as UnicodeveloperFlutterwave;


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


    // process flutterWave
    public function processPayment(Request $request)
    {
        // dd($request);
        $request->validate([
            'payment_method_id' => 'required'
        ]);

        $user = auth()->user();
        $application = $user->applications->first();
        // if (!$application || !is_null($application->payment_id)) {
        //     return redirect()->back()->withErrors('Payment has already been made or no application found.');
        // }

        $reference = Flutterwave::generateReference();

        $paymentAmount = $request->amount;
        $paymentMethodId = $request->payment_method_id;

        $paymentMethod = PaymentMethod::find($paymentMethodId);


        if ($paymentMethod->name == "Flutterwave") {
            try {
                $data = [
                    'tx_ref' => $reference,
                    'amount' => $paymentAmount,
                    'currency' => 'NGN',
                    'email' => $user->email,
                    'redirect_url' => route('student.payment.callback'),
                    'payment_options' => 'card',
                    'customer' => [
                        'email' => $user->email,
                        "phone_number" => $user->student->phone,
                        "name" => $user->first_name . " " . $user->last_name
                    ],
                    'customizations' => [
                        'title' => 'Application Payment',
                        'description' => 'Payment for application #' . $application->invoice_number,
                    ],
                ];


                $payment = Flutterwave::initializePayment($data);

                if ($payment['status'] !== 'success') {
                    return redirect()->back()->withErrors('An error occurred while processing the payment.');
                }

                // $transactionId = $payment;
                // dd($transactionId);

                return redirect($payment['data']['link']);
            } catch (\Exception $e) {
                dd($e->getMessage());

                return redirect()->back()->withErrors('An error occurred: ' . $e->getMessage());
            }
        }
    }



    public function handlePaymentCallBack(Request $request)
    {
        try {
            $status = $request->input('status');
            if ($status === 'successful') {

                $transactionId = Flutterwave::getTransactionIDFromCallback();
                $data = Flutterwave::verifyTransaction($transactionId);
                // dd($data);

                $user = User::where('email', $data['data']['customer']['email'])->first();

                if ($user) {
                    $application = $user->applications()->first();
                    $paymentMethodId = PaymentMethod::where('name', 'Flutterwave')->first()->id;
                // dd($paymentMethodId);


                    $paymentData = [
                        'user_id' => $user->id,
                        'amount' => $data['data']['amount'],
                        'payment_method' => 'Flutterwave',
                        'payment_status' => 'Successful',
                        'transaction_id' => $transactionId,
                        'payment_method_id' => $paymentMethodId,
                    ];

                    $payment = Payment::create($paymentData);

                    if ($application) {
                        $application->update(['payment_id' => $payment->id]);
                    }

                    return view('student.payment.success', [
                        'user' => $user,
                        'application' => $application,
                        'payment' => $payment,
                    ]);
                }
            } elseif ($status == 'cancelled') {
                $userSlug = optional(auth()->user())->nameSlug;
                return redirect()->route('payment.view.finalStep', ['userSlug' => $userSlug])
                    ->withErrors('Payment was cancelled.');
            } else {
                $userSlug = optional(auth()->user())->nameSlug;
                return redirect()->route('payment.view.finalStep', ['userSlug' => $userSlug])
                    ->withErrors('Payment was not successful. Please try again.');
            }
        } catch (\Exception $e) {
            // Log the error
            // dd($e->getMessage());

            // Redirect with an error message
            $userSlug = optional(auth()->user())->nameSlug;
            return redirect()->route('payment.view.finalStep', ['userSlug' => $userSlug])
                ->withErrors('An error occurred while processing the payment. Please try again.');
        }
    }

    public function showSuccess()
    {
        $user = auth()->user();
        $application = $user->applications->first(); // Example, adjust based on your application logic
        $payment = $application ? $application->payment : null; // Example logic

        if (!$payment || !$user || $application) {
            return redirect()->route('payment.view.finalStep', ['userSlug' => $user->nameSlug])
            ->withErrors('An error occurred while processing the payment. Please try again.');
        }

        return view('student.payment.success', compact('user', 'application', 'payment'));
    }
}
