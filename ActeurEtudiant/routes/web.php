<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;

Route::get('/', function () {
    return redirect()->route('inscriptions.index');
});

Route::resource('inscriptions', InscriptionController::class);