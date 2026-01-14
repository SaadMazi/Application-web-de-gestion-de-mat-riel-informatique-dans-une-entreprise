<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {
    protected $fillable = ['user_id', 'material_id', 'start_date', 'end_date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function material() {
        return $this->belongsTo(Material::class);
    }
}
