<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    // Autoriser la modification de ces colonnes
    protected $fillable = [
        'material_id',
        'description_probleme',
        'statut'
    ];

    /**
     * RELATIONS (C'est ce qu'il te manquait)
     */

    // Une maintenance appartient à un matériel
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
