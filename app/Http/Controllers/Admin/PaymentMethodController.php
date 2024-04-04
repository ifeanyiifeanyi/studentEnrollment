<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index($id = null)
    {
        $paymentMethods = PaymentMethod::latest()->get();
        $paymentMethod = null;

        if ($id) {
            $paymentMethod = PaymentMethod::findOrFail($id);
            // dd($paymentMethod);
        }

        return view('admin.paymentMethod.index', compact('paymentMethods', 'paymentMethod'));
    }

    public function store(Request $request)
    {
        $payment = $request->validate([
            'name' => 'required|string|min:2|unique:payment_methods',
            'description' => 'nullable|string'
        ]);

        PaymentMethod::create($payment);
        $notification = [
            'message' => 'Payment Method Created!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function update(Request $request, $id)
    {
        $payment = PaymentMethod::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|min:2|unique:payment_methods,name,' . $payment->id,
            'description' => 'nullable|string'
        ]);

        $payment->update($validatedData);

        $notification = [
            'message' => 'Payment Method Updated!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.payment.manage')->with($notification);
    }
}
