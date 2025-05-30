<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ChapitreController;

Route::get('/', function () {
    return redirect()->route('matieres.index');
});

// Routes pour les matières
Route::resource('matieres', MatiereController::class);

// Routes pour les chapitres
Route::resource('chapitres', ChapitreController::class);