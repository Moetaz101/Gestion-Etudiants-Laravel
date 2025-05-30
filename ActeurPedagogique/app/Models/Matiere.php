<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = ['nom_matiere', 'niveau'];

    /**
     * Relation avec les chapitres
     */
    public function chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }
}