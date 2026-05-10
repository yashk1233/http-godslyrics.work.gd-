<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[App\Http\Controllers\AdminController::class,'index']);
Route::get('admin',[App\Http\Controllers\AdminController::class,'admin']);
Route::get('/create-new-song',[App\Http\Controllers\AdminController::class,'createNewSong']);
Route::get('/view-songs',[App\Http\Controllers\AdminController::class,'ViewSongs']);
Route::get('/search-songs',[App\Http\Controllers\AdminController::class,'searchSongs']);
Route::post('/save-new-song',[App\Http\Controllers\AdminController::class,'SaveNewSong']);
Route::post('/get-songs-data',[App\Http\Controllers\AdminController::class,'getSongsData']);
Route::post('/get-songs-by-title',[App\Http\Controllers\AdminController::class,'getSongsByTitle']);
Route::get('/present-song/{id}/{schedules?}',[App\Http\Controllers\AdminController::class,'presentSong']);
Route::get('/edit-song/{id}',[App\Http\Controllers\AdminController::class,'editSong']);
Route::post('/update-song',[App\Http\Controllers\AdminController::class,'updateSong']);
Route::post('/schedule-song', [App\Http\Controllers\AdminController::class, 'scheduleSong']);
Route::post('/remove-schedule-song', [App\Http\Controllers\AdminController::class, 'removeScheduleSong']);
Route::post('/remove-all-schedule-songs', [App\Http\Controllers\AdminController::class, 'removeAllScheduleSongs']);
Route::get('/list-schedule-song',[App\Http\Controllers\AdminController::class,'listScheduleSong']);

// Background Image Routes
Route::get('/manage-backgrounds', [App\Http\Controllers\AdminController::class, 'manageBackgrounds']);
Route::post('/upload-background', [App\Http\Controllers\AdminController::class, 'uploadBackground']);
Route::post('/set-active-background', [App\Http\Controllers\AdminController::class, 'setActiveBackground']);
Route::get('/delete-background/{id}', [App\Http\Controllers\AdminController::class, 'deleteBackground']);
Route::post('/save-settings', [App\Http\Controllers\AdminController::class, 'saveSettings']);