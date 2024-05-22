<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

//-> Landing Page
Route::get('/', [Controllers\LandingPageController::class, "home"]);
Route::get('/posts', [Controllers\LandingPageController::class, "posts"]);
Route::get('/post/{slug}',  [Controllers\LandingPageController::class, "post"]);
Route::get('/about', [Controllers\LandingPageController::class, "about"]);
Route::get('/contact', [Controllers\LandingPageController::class, "contact"]);

//-> Auth Page
