<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FraisController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/visiteur/initpwds', [VisiteurController::class, "initPasswords"]);

Route::post('/visiteur/login', [VisiteurController::class, "login"]);

Route::get('visiteur/logout', [VisiteurController::class, "logout"])->middleware('auth:sanctum');

Route::get('visiteur/unauth', [VisiteurController::class, "unauthorized"])->name('login');

Route::get('/frais/{idFrais}', [FraisController::class, "detail"])->middleware('auth:sanctum');

Route::post('frais/ajout', [FraisController::class, "ajout"])->middleware('auth:sanctum');

Route::post('frais/modif', [FraisController::class, "modif"])->middleware('auth:sanctum');

Route::delete('frais/suppr', [FraisController::class, "suppr"])->middleware('auth:sanctum');

Route::get('frais/liste/{idVisiteur}', [FraisController::class, "ListeFraisVisiteur"])->middleware('auth:sanctum');

