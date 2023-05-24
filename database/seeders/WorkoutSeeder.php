<?php

namespace Database\Seeders;

use App\Models\Workout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Workout::create([
            'name' => 'Rücken',
            'datum' => now(),
        ]);
        Workout::create([
            'name' => 'Brust',
            'datum' => now(),
        ]);
        Workout::create([
            'name' => 'Schultern',
            'datum' => now(),
        ]);
        Workout::create([
            'name' => 'Bizeps',
            'datum' => now(),
        ]);
        Workout::create([
            'name' => 'Trizeps',
            'datum' => now(),
        ]);
    }
}
