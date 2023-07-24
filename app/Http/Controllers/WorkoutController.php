<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exercise;
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
        $workouts = Workout::where('user_id', Auth::id())->orderBy('datum', 'desc')->get();
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
        $categories = Category::all();
        return view('fitness.workouts.create', compact('categories'));
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
            'datum' => 'required',
            'category_id' => 'required'
        ]);
        Workout::create([
            'name' => $request->name,
            'datum' => $request->datum,
            'category_id' => $request->category_id,
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
    public function show(Workout $workout)
    {
        $all_exercises = Category::where('id', $workout->category_id)->first()->exercises;
        $workout_exercises = $workout->exercises;
        // dd($workout_exercises);
        $available_exercises = $all_exercises->whereNotIn('name', $workout->exercises->pluck('name')->toArray())->all();
        // dd($available_exercise);
        return view('fitness.workouts.show', compact('workout', 'workout_exercises', 'available_exercises'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        // $sel_category = Category::where('id', $workout->category_id)->first();
        $exercises = Category::where('id', $workout->category_id)->first()->exercises;
        $categories = Category::all();
        return view('fitness.workouts.update', compact('workout', 'categories', 'exercises'));
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
            'datum' => 'required',
            'category_id' => 'required'
        ]);
        $workout->update([
            'name' => $request->name,
            'datum' => $request->datum,
            'category_id' => $request->category_id
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

    public function selectCategories(Request $request, Workout $workout) {
        $sel_category = Category::where('id', $request->category_id)->first();
        $exercises = $sel_category->exercises;
        // dd($sel_category);

        $categories = Category::all();

        return view('fitness.workouts.edit', compact('workout', 'categories', 'sel_category', 'exercises'));
    }

    public function assignExercises(Request $request, Workout $workout) {
        $workout->exercises()->sync($request->exercises);
        return back()->with('message', 'Exercises added.');
        // if ($request->exercises != null) {
        //     $sel_exercise = Exercise::where('id', $request->exercises[0])->first();
        //     dd($sel_exercise);
        // }
    }

    public function attachExercise(Request $request, Workout $workout) {
        // dd($request->beschreibung);
        $workout->exercises()->attach($request->exercise_id, ['beschreibung' => $request->beschreibung]);
        return $this->show_workout_exercises($workout);
    }

    public function detachExercise(Request $request, Workout $workout) {
        $workout->exercises()->detach($request->exercise_id);
        return $this->show_workout_exercises($workout);
    }

    public function updateExercise(Request $request, Workout $workout) {
        $exercise_id = $request->query('exercise_id');
        $exercise_name = $request->query('exercise_name');
        $beschreibung = $request->query('beschreibung');

        return view('fitness.workouts.update_beschreibung', compact('workout', 'exercise_id', 'exercise_name', 'beschreibung'));
        
        // $workout->exercises()->updateExistingPivot($exercise_id, ['beschreibung' => $beschreibung . ' updated']);
        // return back()->with('message', 'Exercise updated.');
    }

    public function updateBeschreibung(Request $request, Workout $workout, Exercise $exercise) {
        $exercise_id = $request->query('exercise_id');
        $beschreibung = $request->beschreibung;
        
        $workout->exercises()->updateExistingPivot($exercise_id, ['beschreibung' => $beschreibung]);

        return $this->show_workout_exercises($workout);
    }

    private function show_workout_exercises(Workout $workout) {
        $all_exercises = Category::where('id', $workout->category_id)->first()->exercises;
        $workout_exercises = $workout->exercises;
        // dd($workout_exercises);
        $available_exercises = $all_exercises->whereNotIn('name', $workout->exercises->pluck('name')->toArray())->all();
        // dd($available_exercise);
        return view('fitness.workouts.show', compact('workout', 'workout_exercises', 'available_exercises'));
    }

    public function copy_workout(Workout $workout) {
       
        $curr_workout = Workout::create([
            'name' => $workout->name,
            'datum' => now(),
            'category_id' => $workout->category_id,
            'user_id' => $workout->user_id
        ]);
        foreach($workout->exercises as $curr_exercise) {
            $curr_workout->exercises()->attach($curr_exercise->id, ['beschreibung' => $curr_exercise->pivot->beschreibung]);
        }
        return to_route('workouts.index')->with('message', 'Workout copy successfully.');
    }
}
