<?php


namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
   
    public function index()
    {
        $facilities = Facility::with('rooms')->get();
        return response()->json($facilities);
    }

    
    public function show($id)
    {
        $facility = Facility::with('rooms')->findOrFail($id);
        return response()->json($facility);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'rooms' => 'array', 
        ]);

        $facility = Facility::create($validatedData);

        
        if (isset($validatedData['rooms'])) {
            $facility->rooms()->sync($validatedData['rooms']);
        }

        return response()->json($facility, 201);
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'rooms' => 'array', 
        ]);

        $facility = Facility::findOrFail($id);
        $facility->update($validatedData);

       
        if (isset($validatedData['rooms'])) {
            $facility->rooms()->sync($validatedData['rooms']);
        }

        return response()->json($facility);
    }

   
    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);

       
        $facility->delete();

        return response()->json(null, 204);
    }
}

