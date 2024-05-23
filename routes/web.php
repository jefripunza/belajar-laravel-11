<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//-> Landing Page
Route::get('/', [Controllers\LandingController::class, "home"]);
Route::get('/posts', [Controllers\LandingController::class, "posts"])->name('posts');
Route::get('/post/{slug}',  [Controllers\LandingController::class, "post"]);
Route::get('/about', [Controllers\LandingController::class, "about"]);
Route::get('/contact', [Controllers\LandingController::class, "contact"]);

//-> Auth Page
Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('activation/{code}', [AuthController::class, 'activateAccount'])->name('activation');
