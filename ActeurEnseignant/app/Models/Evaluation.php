<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    
    /**
     * Les attributs assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'etudiant_nom',
        'etudiant_prenom',
        'matiere',
        'note',
        'date',
        'message'
    ];
    
    /**
     * Les règles de conversion des attributs.
     *
     * @var array
     */
    protected $casts = [
        'note' => 'float',
        'date' => 'date',
    ];
}