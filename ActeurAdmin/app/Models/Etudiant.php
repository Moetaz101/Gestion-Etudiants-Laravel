<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    
    protected $table = 'etudiants';
    
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'classe',
        'sexe',
        'specialite'
    ];
    
    // Les options pour les listes déroulantes
    public static function getClasseOptions()
    {
        return [
            'Licence 1' => 'Licence 1',
            'Licence 2' => 'Licence 2',
            'Licence 3' => 'Licence 3',
            'Master 1' => 'Master 1',
            'Master 2' => 'Master 2'
        ];
    }
    
    public static function getSpecialiteOptions()
    {
        return [
            'Informatique' => 'Informatique',
            'Réseaux' => 'Réseaux',
            'Mathématiques' => 'Mathématiques',
            'Physique' => 'Physique',
            'Chimie' => 'Chimie',
            'Biologie' => 'Biologie',
            'Économie' => 'Économie',
            'Gestion' => 'Gestion'
        ];
    }
    
    public static function getSexeOptions()
    {
        return [
            'Homme' => 'Homme',
            'Femme' => 'Femme'
        ];
    }
}