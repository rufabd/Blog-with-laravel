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

Route::post('/register',[AuthController::class,"register"]);  // User register
Route::post('/logout',[AuthController::class,"logout"]);  // User logout
Route::post('/login',[AuthController::class,"login"]);    // User login
Route::resource("/user",AuthController::class);   
// Route::get('/user',[AuthController::class,"show"]);       // Show specific user
Route::get('/user/{id}',[AuthController::class,"show"]);       // Show specific user
Route::get('/users',[AuthController::class,"index"]);     // Show all users


Route::post('/blogPosts',[BlogPostController::class,"store"]);  // create blog post
Route::put('/blogPost/{id}', [BlogPostController::class, 'update']); // update blog post
Route::delete('/blogPost/{id}', [BlogPostController::class, 'destroy']); // delete blog
Route::get('/blogPost/{id}', [BlogPostController::class, 'show']);  // view specific blog
Route::get('/blogPosts', [BlogPostController::class, 'index']);    // view blogs list
Route::get('/blogPosts/search/{title}', [BlogPostController::class, 'search']);  // search for blog


Route::post('/categories',[CategoryController::class,"store"]); // create category
Route::put('/category/{id}', [CategoryController::class, 'update']); // update category
Route::get('/categories',[CategoryController::class,'index']);    // view category
Route::get('/category/{id}', [CategoryController::class, 'show']);  // view specific category
Route::delete('/category/{id}', [CategoryController::class, 'destroy']); // delete category


Route::post('/comments', [CommentController::class, 'store']); // create comment
Route::put('/comment/{id}', [CommentController::class, 'update']); // update comment
Route::get('/comments', [CommentController::class, 'index']);    // view comments
Route::get('/comment/{id}', [CommentController::class, 'show']);  // view specific comment
Route::delete('/comment/{id}', [CommentController::class, 'destroy']); // delete comment