<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CountryController;

Route::resource('users', UserController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('currencies', CurrencyController::class)->only('index');
Route::resource('countries', CountryController::class)->only('index');
