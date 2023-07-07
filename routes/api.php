<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

//Route::resource('game', GameController::class);
Route::get('game',[GameController::class, 'index']);
Route::post('game/store',[GameController::class, 'store']);
Route::get('game/show/{id}',[GameController::class, 'show']);
Route::put('game/update/{id}', [GameController::class, 'update']);
Route::delete('game/delete/{id}',[GameController::class, 'destroy']);
