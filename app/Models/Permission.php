<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName): bool {
        return $this->role()->where('name', $roleName)->exists();
    }
}
