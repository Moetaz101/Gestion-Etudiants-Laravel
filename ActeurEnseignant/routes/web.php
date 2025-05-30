<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluationController;

// Route d'accueil redirige vers la liste des évaluations
Route::get('/', function () {
    return redirect()->route('evaluations.index');
});

// Routes pour les évaluations (CRUD)
Route::resource('evaluations', EvaluationController::class);