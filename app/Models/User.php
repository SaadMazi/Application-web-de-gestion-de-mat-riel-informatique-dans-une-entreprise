<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Don't forget to add 'role' here!
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * RELATIONSHIPS
     */

    // A user can have many materials assigned to them
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // A user can report many maintenance issues
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    /**
     * HELPER FUNCTIONS
     */

    // Check if user is Admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}

