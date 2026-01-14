<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model {
    protected $fillable = ['name', 'serial_number', 'status', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    // Helper to check if currently assigned
    public function isAssigned() {
        return $this->status === 'assigned';
    }
}
