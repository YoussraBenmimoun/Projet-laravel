<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentaryController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;

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

Route::get('/',[PageController::class,'index'])->name('home');

Route::get('/user/category/{id}',[PageController::class,'category'])->name('category-recipes');
Route::get('/user/recipe/{id}',[PageController::class,'recipe'])->name('recipe-details');

// Route::get('/admin',function(){
//     return view('admin.layout');
// });

// Route::get('/user',function(){
//     return view('layouts/app');
// })->name('user');

Route::get('/register', [RegisterController::class, 'create'])->name('registerForm');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/import', [RecipeController::class, 'showImportForm'])->name('recipes.showImportForm');
Route::post('/recipes/import', [RecipeController::class, 'import'])->name('recipes.import');

Route::get('recipes/search',[RecipeController::class,'search'])->name("recipes.search");

Route::get('users/search',[UserController::class,'search'])->name("users.search");

Route::get('categories/search',[CategoryController::class,'search'])->name("categories.search");

Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate-pdf');

Route::resource('recipes',RecipeController::class);

Route::resource('users',UserController::class);

Route::resource('categories',CategoryController::class);

Route::resource('commentaries',CommentaryController::class);

Route::middleware(['auth', 'role:0'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.layout');
    })->name('admin');
});

// Route::middleware(['auth', 'role:1'])->group(function () {
//     Route::get('/user', function () {
//         return view('layouts/app');
//     })->name('user');
// });

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/user', [PageController::class,'user'])->name('user');
});

