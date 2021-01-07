<?php

use App\Http\Controllers\DislikePostController;
use App\Http\Controllers\FollowingUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikePostController;
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
Route::middleware(['auth:sanctum', 'verified'])->get('/profile/{user_id}', [ProfileController::class, 'index']);

// Creating elements
Route::middleware(['auth:sanctum', 'verified'])->post('/post', [PostController::class, 'createPost'])->name("create_post");
Route::middleware(['auth:sanctum', 'verified'])->post('/comment', [CommentController::class, 'createComment'])->name("create_post_comment");
Route::middleware(['auth:sanctum', 'verified'])->post('/likePost', [LikePostController::class, 'createLikePost'])->name("create_like_post");
Route::middleware(['auth:sanctum', 'verified'])->post('/dislikePost', [DislikePostController::class, 'createDislikePost'])->name("create_dislike_post");
Route::middleware(['auth:sanctum', 'verified'])->post('/follow/{user_following_id}', [FollowingUserController::class, 'createFollowing']);
// Destroying elements
Route::middleware(['auth:sanctum', 'verified'])->delete('/post/{id}', [ArticlesController::class, 'deletePost'])->name("delete_article");


// Getting info for posts
Route::get('/getInfoBack', [HomeController::class, 'getPostsInfo']);

// Getting users foro listing when "@"
Route::get('/getUsers', [HomeController::class, 'getUsers']);

// Getting following list by id
Route::get('/following/{id}', [HomeController::class, 'getAllFollowingById']);

// Getting posts by id
Route::get('/posts/{id}', [ProfileController::class, 'getPostsCardsInfo']);




/* //TO DELETE ROBERTO
Route::post('/add-comment', [HomeController::class, 'addComment']);
Route::post('/add-post', [HomeController::class, 'addPost']); */