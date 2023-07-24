<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'datum', 'user_id', 'category_id'];

    public function exercises() {
        return $this->belongsToMany(Exercise::class)->withPivot('beschreibung');
    }

    public function hasExercise($name) {
        return $this->exercises()->where('name', $name)->exists();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
