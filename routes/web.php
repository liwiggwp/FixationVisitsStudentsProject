<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
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
Route::get('lesson/',[LessonController::class, 'index'])->name('lesson.index');
Route::get('lesson/create',[LessonController::class, 'create'])->name('lesson.create');
Route::post('lesson/store',[LessonController::class, 'store'])->name('lesson.store');
Route::get('lesson/show/{id}',[LessonController::class, 'show'])->name('lesson.show');
Route::get('lesson/edit/{id}',[LessonController::class, 'edit'])->name('lesson.edit');
Route::post('lesson/update/{id}',[LessonController::class, 'update'])->name('lesson.update');
Route::delete('lessons/destroy/{id}', [LessonController::class, 'destroy'])->name('lesson.destroy');

Auth::routes();

/*
 Admin
 */

Route::middleware(['role:admin'])->prefix('admin_panel')->group(function (){
    Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'index'])->name('homeAdmin');
    Route::get('admin/',[LessonController::class, 'indexAdmin'])->name('admin.lesson.index');
    Route::get('/create',[LessonController::class, 'cre'])->name('admin.lesson.create');
    Route::post('/store',[LessonController::class, 'st'])->name('admin.lesson.store');
    Route::get('/show/{id}',[LessonController::class, 'sh'])->name('admin.lesson.show');

    Route::get('/edit/{id}',[LessonController::class, 'ed'])->name('admin.lesson.edit');
    Route::post('/update/{id}',[LessonController::class, 'upd'])->name('admin.lesson.update');
    Route::delete('/{id}', [LessonController::class, 'destroyAdmin'])->name('admin.lesson.destroy');

    Route::get('person/',[UserController::class, 'index'])->name('admin.user.index');
    Route::get('person/show/{id}',[UserController::class, 'view_post'])->name('admin.user.view');
    Route::get('person/restore/{id}', [UserController::class, 'restoreUser'])->name('admin.user.restore');
});

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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

