<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

// Routes pour la gestion des étudiants
Route::resource('etudiants', EtudiantController::class);

// Route d'accueil redirigée vers la liste des étudiants
Route::get('/', function () {
    return redirect()->route('etudiants.index');
});