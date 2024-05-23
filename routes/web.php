<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

//-> Landing Page
Route::get('/', [Controllers\LandingController::class, "home"]);
Route::get('posts', [Controllers\LandingController::class, "posts"])->name('posts');
Route::get('post/{slug}',  [Controllers\LandingController::class, "post"]);
Route::get('about', [Controllers\LandingController::class, "about"]);
Route::get('contact', [Controllers\LandingController::class, "contact"]);

//-> Auth Page
Route::get('login', [Controllers\AuthController::class, 'login']);
Route::post('login', [Controllers\AuthController::class, 'login'])->name('login');
Route::get('logout', [Controllers\AuthController::class, 'logout']);
Route::get('register', [Controllers\AuthController::class, 'register']);
Route::post('register', [Controllers\AuthController::class, 'register'])->name('register');
Route::get('activation/{code}', [Controllers\AuthController::class, 'activateAccount'])->name('activation');

//-> Logged Page
Route::get('portfolio', [Controllers\UserController::class, 'portfolio']);
