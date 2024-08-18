<?php

// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // List all payments
    public function index()
    {
        $payments = Payment::with('subscription')->get(); // Assuming Payment is related to Subscription
        return response()->json($payments);
    }

    // Show a specific payment
    public function show($id)
    {
        $payment = Payment::with('subscription')->findOrFail($id);
        return response()->json($payment);
    }

    // Create a new payment
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id', // Assuming Payment is related to Subscription
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $payment = Payment::create($validatedData);

        return response()->json($payment, 201);
    }

    // Update a payment
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($validatedData);

        return response()->json($payment);
    }
    public function filter(Request $request)
    {
        $query = Payment::query();

        
        if ($request->has('subscription_id')) {
            $query->where('subscription_id', $request->input('subscription_id'));
        }

        
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

       
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('payment_date', [
                $request->input('start_date'),
                $request->input('end_date'),
            ]);
        }

        
        if ($request->has('min_amount') && $request->has('max_amount')) {
            $query->whereBetween('amount', [
                $request->input('min_amount'),
                $request->input('max_amount'),
            ]);
        }

        $payments = $query->with('subscription')->get();

        return response()->json($payments);
    }

    
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

        
        $payment->delete();

        return response()->json(null, 204);
    }
}

        