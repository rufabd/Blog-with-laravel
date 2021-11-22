<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProblemController;
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

// General

Route::post('/register',[AuthController::class,"register"]);  // User register
Route::post('/login',[AuthController::class,"login"]);    // User login
Route::post('/logout',[AuthController::class,"logout"]);  // User logout
Route::resource("/user",AuthController::class);


Route::get('/blogPost/{id}', [BlogPostController::class, 'show']);  // view specific blog
Route::get('/blogPosts', [BlogPostController::class, 'index']);    // view blogs list
Route::get('/blogPosts/search/{title}', [BlogPostController::class, 'search']);  // search for blog

Route::get('/categories',[CategoryController::class,'index']);    // view category list
Route::get('/category/{id}', [CategoryController::class, 'show']);  // view specific category

Route::get('/comments', [CommentController::class, 'index']);    // view comments

Route::get('/feedbacks', [FeedbackController::class, 'index']);    // View feedbacks

Route::post('/contact-me', [ContactController::class, 'store']); // create contact record

Route::post('/report-problem', [ProblemController::class, 'store']);  // Report a problem



// Admin rights
Route::group(['middleware'=>['auth:sanctum','role:admin']],function(){
    Route::delete('/blogPost/{id}', [BlogPostController::class, 'destroy']); // delete blog
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']); // delete category

    // Route::post('/logout',[AuthController::class,"logout"]);  // User logout
    Route::get('/users',[AuthController::class,"index"]);     // Show all users
    Route::get('/user/{id}',[AuthController::class,"show"]);       // Show specific user

    Route::get('/comment/{id}', [CommentController::class, 'show']);  // view specific comment
    Route::delete('/comment/{id}', [CommentController::class, 'destroy']); // delete comment

    Route::get('/contacts', [ContactController::class, 'index']);  // view all contact records
    Route::delete('/contact/{id}', [ContactController::class, 'destroy']); // delete contact record
    Route::get('/contact/{id}', [ContactController::class, 'show']);  // View specific contact record

    Route::get('/feedback/{id}',[FeedbackController::class, 'show']);  // View specific feedback
    Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy']); // Delete feedback

    Route::get('/reported-problems', [ProblemController::class, 'index']);    // View problems
    Route::get('/reported-problem/{id}', [ProblemController::class, 'show']);  // View specific problem
    Route::delete('/reported-problem/{id}', [ProblemController::class, 'destroy']); // Delete problem
});

// blogWriter rights
Route::group(['middleware'=>['auth:sanctum','role:blogWriter']],function(){
    Route::post('/blogPosts',[BlogPostController::class,"store"]);  // create blog post
    Route::put('/blogPost/{id}', [BlogPostController::class, 'update']); // update blog post
    Route::delete('/blogPost/{id}', [BlogPostController::class, 'destroy']); // delete blog post

    Route::post('/categories',[CategoryController::class,"store"]); // create category
    Route::put('/category/{id}', [CategoryController::class, 'update']); // update category
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']); // delete category

});

// User rights
Route::group(['middleware'=>['auth:sanctum','role:user']],function(){
    Route::post('/comments', [CommentController::class, 'store']); // create comment
    Route::put('/comment/{id}', [CommentController::class, 'update']); // update comment
    Route::post('/feedbacks', [FeedbackController::class, 'store']); // Create feedback
});



// Route::get('/user',[AuthController::class,"show"]);       // Show specific user

































