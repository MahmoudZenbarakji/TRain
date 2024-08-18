<?php


namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    
    public function index()
    {
        $subscriptions = Subscription::with(['user', 'offers'])->get(); 
        return response()->json($subscriptions);
    }

    
    public function show($id)
    {
        $subscription = Subscription::with(['user', 'offers'])->findOrFail($id);
        return response()->json($subscription);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', 
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:255',
            'offers' => 'array', 
        ]);

        $subscription = Subscription::create($validatedData);

        return response()->json($subscription, 201);
    }

    // Update a subscription
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:255',
            'offers' => 'array',
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->update($validatedData);

        return response()->json($subscription);
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);

        // Delete the subscription
        $subscription->delete();

        return response()->json(null, 204);
    }
}
