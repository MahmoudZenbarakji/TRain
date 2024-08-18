<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    
    public function index()
    {
        $rooms = Room::with(['facility', 'sports'])->get();
        return response()->json($rooms);
    }

   
    public function show($id)
    {
        $room = Room::with(['facility', 'sports'])->findOrFail($id);
        return response()->json($room);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'facility_id' => 'required|exists:facilities,id',
            'sports' => 'array', 
        ]);

        $room = Room::create($validatedData);

        return response()->json($room, 201);
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'facility_id' => 'required|exists:facilities,id',
            'sports' => 'array', 
        ]);

        $room = Room::findOrFail($id);
        $room->update($validatedData);

        return response()->json($room);
    }

    
    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        
        $room->delete();

        return response()->json(null, 204);
    }
}
