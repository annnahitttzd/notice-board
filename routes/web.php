<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoryController;

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
Route::get('/', function () {
    return view('login');
})->name('login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/approve/{approve_token}', [StoryController::class, 'approveStory'])->name('approve.story');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/add-story', [StoryController::class, 'create'])->name('stories.create');
    Route::post('/admin/add-story', [StoryController::class, 'store'])->name('stories.store');
    Route::get('/approved-stories', [StoryController::class, 'showApprovedStories'])->name('approved.stories');
    Route::get('/logout', [AdminController::class, 'logoutUser'])->name('logout.user');
    Route::get('/story-delete/{id}', [StoryController::class, 'storyDelete'])->name('delete.story');
});






