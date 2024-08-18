<?php


namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Offer;
use App\Models\Sport;
use Illuminate\Http\Request;
use App\Http\Controllers\SportController;
class ClubController extends Controller
{
   
    public function index()
    {
        
        $offers = Offer::all(); 
        $sports = Sport::all();
        return view('club.index', compact('offers','sports'));
    }

    
    public function applySubscription(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'sport_id' => 'nullable|exists:sports,id', 
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'offer_id' => 'nullable|exists:offers,id', 
        ]);

       
        $subscription = Subscription::create($validatedData);

        return redirect()->back()->with('success', 'Subscription applied successfully!');
    }
}
