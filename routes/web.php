<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//-> Landing
Route::get('/', [Controllers\LandingController::class, "home"]);
Route::get('posts', [Controllers\LandingController::class, "posts"])->name('posts');
Route::get('post/{slug}',  [Controllers\LandingController::class, "post"]);
Route::get('articles/{username}',  [Controllers\LandingController::class, "author_articles"]);
Route::get('about', [Controllers\LandingController::class, "about"]);
Route::get('contact', [Controllers\LandingController::class, "contact"]);

//-> Auth
Route::match(['get', 'post'], 'register', [Controllers\AuthController::class, 'register'])->name('register');
Route::get('activation/{code}', [Controllers\AuthController::class, 'activateAccount'])->name('activation');
Route::match(['get', 'post'], 'login', [Controllers\AuthController::class, 'login'])->name('login');
Route::get('logout', [Controllers\AuthController::class, 'logout']);

//-> Portfolio
Route::get('portfolio', [Controllers\PortfolioController::class, 'manage'])->name('portfolio');
Route::get('portfolio/{slug}', [Controllers\PortfolioController::class, 'public']);
Route::match(['get', 'post'], 'edit/portfolio/{on}', [Controllers\PortfolioController::class, 'editable'])->name('portfolio-editable');
