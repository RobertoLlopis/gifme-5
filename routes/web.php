<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikePostController;
use App\Http\Controllers\FollowingUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeDislikePostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\UserController;
use App\Models\LikeDislikePost;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Display
Route::middleware(['auth:sanctum', 'verified'])->get('/', [HomeController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/profile/{user_id}', [ProfileController::class, 'index'])->name('profile');
Route::middleware(['auth:sanctum', 'verified'])->get('/profile/username/{user_name}', [ProfileController::class, 'byUserName']);
// Creating elements
Route::middleware(['auth:sanctum', 'verified'])->post('/comment', [CommentController::class, 'createComment'])->name("create_post_comment");

//Comments
Route::get('/comments/{id}', [CommentController::class, 'getCommentsById']);

// Posts CRUD 
Route::middleware(['auth:sanctum', 'verified'])->post('/post', [PostController::class, 'createPost'])->name("create_post");
Route::middleware(['auth:sanctum', 'verified'])->post('/deletePost/{post_id}', [PostController::class, 'deletePost']);

// LikeDislike CRUD
Route::middleware(['auth:sanctum', 'verified'])->post('/updateLikeStatus', [LikeDislikePostController::class, 'likeDislikeFilter']);
Route::middleware(['auth:sanctum', 'verified'])->post('/updateLikes', [LikeDislikePostController::class, 'likeDislikeFilter']);


// Following CRUD
Route::middleware(['auth:sanctum', 'verified'])->post('/follow/{user_following_id}', [FollowingUserController::class, 'followingFilter']);

// Search engine
Route::middleware(['auth:sanctum', 'verified'])->post('/search', [UserController::class, 'getUsersByUsername']);


/*============================
======= Retrieve Info
=============================*/

//=================== Getting USERS
// for listing when "@"
Route::get('/getUsers', [HomeController::class, 'getUsers']);
// by ID
Route::get('/user/{user_id}', [HomeController::class, 'getUserInfo']);

//=================== Getting POSTS
// Getting posts by id
Route::get('/posts/{id}', [ProfileController::class, 'getPostsCardsInfo']);
//raw info
Route::get('/getInfoBack', [HomeController::class, 'getPostsInfo']);

//=================== Getting FOLLOWING
// list by ID
Route::get('/following/{id}', [HomeController::class, 'getAllFollowingById']);

Route::get('/postStatus/{id}', [LikeDislikePost::class, 'getPostLikesDislikes']);
