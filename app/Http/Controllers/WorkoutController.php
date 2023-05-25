<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workouts = Workout::where('user_id', Auth::id())->get();
        return view('fitness.workouts.index', compact('workouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Workout::class);
        return view('fitness.workouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workout $workout)
    {
        $this->authorize('create', Workout::class);
        $request->validate([
            'name' => 'required', 
            'datum' => 'required'
        ]);
        Workout::create([
            'name' => $request->name,
            'datum' => $request->datum,
            'user_id' => Auth::id()
        ]);

        return to_route('workouts.index')->with('message', 'Workout created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        return view('fitness.workouts.edit', compact('workout'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workout $workout)
    {
        $this->authorize('update', $workout);

        $request->validate([
            'name' => 'required', 
            'datum' => 'required'
        ]);
        $workout->update([
            'name' => $request->name,
            'datum' => $request->datum
        ]);

        return to_route('workouts.index')->with('message', 'Workout updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout)
    {
        $this->authorize('delete', $workout);
        
        $workout->delete();
        return to_route('workouts.index')->with('message', 'Workout deleted successfully.');
    }
}
