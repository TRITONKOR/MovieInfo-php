<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/', [FilmController::class, 'index'])->name('home');
Route::post('/search', [FilmController::class, 'search'])->name('search');
Route::post('/send-film-results', [FilmController::class, 'sendFilmSearchResults'])->name('sendFilmSearchResults');
