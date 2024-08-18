<?php

// app/Http/Controllers/OfferController.php
namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    
    public function index()
    {
        $offers = Offer::all();
        return response()->json($offers);
    }

    
    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        return response()->json($offer);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $offer = Offer::create($validatedData);

        return response()->json($offer, 201);
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $offer = Offer::findOrFail($id);
        $offer->update($validatedData);

        return response()->json($offer);
    }

   
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        
        $offer->delete();

        return response()->json(null, 204);
    }
}
