<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register',[AuthController::class,"register"]);
Route::post('/logout',[AuthController::class,"logout"]);
Route::post('/login',[AuthController::class,"login"]);
Route::resource("/user",AuthController::class);
Route::get('/user',[AuthController::class,"show"]);
Route::get('/users',[AuthController::class,"index"]);

Route::post('/blogPosts',[BlogPostController::class,"store"]);  // create blog post

Route::post('/categories',[CategoryController::class,"store"]); // create category

Route::get('/blogPosts',[BlogPostController::class,'index']);
Route::get('/categories',[CategoryController::class,'index']);    // view category

Route::post('/comments', [CommentController::class, 'store']); // create comment
Route::get('/comments', [CommentController::class, 'index']);    // view comments