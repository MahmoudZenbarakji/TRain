<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use App\Http\Resources\SportResource;
use Illuminate\Support\Facades\Validator;
class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sports = Sport::get();
        if($sports->count() >0){
            return SportResource::collection($sports);
        }else{
            return response()->json(['message'=>"no record"],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

            "name"  => "required",
            "description"   => "required",
        
        ]
        );
        if($validator->fails())
        {
            return response()->json([
                "message"  => "all fiels are mandatory",
                "error"   => $validator->messages(),
            ],422);
            
        }
        $sport  =   Sport::create([
            'name'  =>  $request->name,
            'description'   => $request->description,
        ]);
        return response()->json([
            'message'   => 'Sports created successfully',
            'data'  => new SportResource($sport)  
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sport $sport)
    {
        return new SportResource($sport);
    }


    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sport $sport)
    {
        $validator = Validator::make($request->all(),[

            "name"  => "required",
            "description"   => "required",
        
        ]
        );
        if($validator->fails())
        {
            return response()->json([
                "message"  => "all fiels are mandatory",
                "error"   => $validator->messages(),
            ],422);
            
        }
        $sport->update([
            'name'  =>  $request->name,
            'description'   => $request->description,
        ]);
        return response()->json([
            'message'   => 'Sports created successfully',
            'data'  => new SportResource($sport)  
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sport $sport)
    {
        $sport->delete();
        return response()->json([
            'message'   => 'Sports deleted successfully',
        ],200);
    }
}
