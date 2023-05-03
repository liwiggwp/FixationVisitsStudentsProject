<?php

use App\Http\Controllers\LessonController;
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

Route::get('/',[LessonController::class, 'index']);
// Route::get('post/',[PostController::class, 'index'])->name('post.index');
// Route::get('post/search',[PostController::class, 'search'])->name('post.search');
// Route::get('post/create',[PostController::class, 'create'])->name('post.create');
// Route::post('post/store',[PostController::class, 'store'])->name('post.store');
// Route::get('post/show/{id}',[PostController::class, 'show'])->name('post.show');
// Route::get('post/edit/{id}',[PostController::class, 'edit'])->name('post.edit');
// Route::post('post/update/{id}',[PostController::class, 'update'])->name('post.update');
// Route::delete('post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
// Route::post('comment/{post_id}',[CommentsController::class, 'save_comment']);


Auth::routes();

/*
 Admin
 */

// Route::middleware(['role:admin'])->prefix('admin_panel')->group(function (){
//     Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'index'])->name('homeAdmin');
//     Route::get('admin/',[PostController::class, 'indexAdmin'])->name('admin.post.index');
//     Route::get('/create',[PostController::class, 'cre'])->name('admin.post.create');
//     Route::post('/store',[PostController::class, 'st'])->name('admin.post.store');
//     Route::get('/show/{id}',[PostController::class, 'sh'])->name('admin.post.show');

//     Route::get('/edit/{id}',[PostController::class, 'ed'])->name('admin.post.edit');
//     Route::post('/update/{id}',[PostController::class, 'upd'])->name('admin.post.update');
//     Route::delete('/{id}', [PostController::class, 'destroyAdmin'])->name('admin.post.destroy');
//     Route::get('/restore/{id}', [PostController::class, 'restoreAdmin'])->name('admin.post.restore');

//     Route::get('person/',[UserController::class, 'index'])->name('admin.user.index');
//     Route::get('person/show/{id}',[UserController::class, 'view_post'])->name('admin.user.view');
//     Route::get('person/restore/{id}', [UserController::class, 'restoreUser'])->name('admin.user.restore');
// });

// /*
//  Profile
//  */

// Route::get('/user/{name}',[ProfileController::class, 'index'])->name('profile.index');
// Route::get('/user/profile/{name}',[ProfileController::class, 'show'])->name('profile.show');

// /*
//  Friend
//  */

// Route::middleware(['auth', 'verified'])->prefix('friends')->name('friend.')->group(function () {
//     Route::get('/', [FriendController::class, 'index'])->name('index');
//     Route::get('/inquiry', [FriendController::class, 'inquiry'])->name('inquiry');
//     Route::get('/add/{name}', [FriendController::class, 'getAdd'])->name('add');
//     Route::get('/show/{name}', [FriendController::class, 'show'])->name('show');

//     Route::get('/accept/{name}', [FriendController::class, 'getAccept'])->name('accept');
//     Route::post('/delete/{name}', [FriendController::class, 'postDelete'])->name('delete');
// });

/*
 Wall
 */
// Route::get('/wall',  [PostController::class, 'wallPost'])
//     ->middleware('verified')->name('timeline.index');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
