<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[App\Http\Controllers\AdminController::class,'ViewSongs']);
Route::get('admin',[App\Http\Controllers\AdminController::class,'admin']);
Route::get('/create-new-song',[App\Http\Controllers\AdminController::class,'createNewSong']);
Route::get('/view-songs',[App\Http\Controllers\AdminController::class,'ViewSongs']);
Route::post('/save-new-song',[App\Http\Controllers\AdminController::class,'SaveNewSong']);
Route::post('/get-songs-data',[App\Http\Controllers\AdminController::class,'getSongsData']);
Route::get('/present-song/{id}/{ids}',[App\Http\Controllers\AdminController::class,'presentSong']);
Route::get('/edit-song/{id}',[App\Http\Controllers\AdminController::class,'editSong']);
Route::post('/update-song',[App\Http\Controllers\AdminController::class,'updateSong']);
Route::post('/schedule-song', [App\Http\Controllers\AdminController::class, 'scheduleSong']);
Route::post('/remove-schedule-song', [App\Http\Controllers\AdminController::class, 'removeScheduleSong']);
Route::post('/remove-all-schedule-songs', [App\Http\Controllers\AdminController::class, 'removeAllScheduleSongs']);
Route::get('/list-schedule-song',[App\Http\Controllers\AdminController::class,'listScheduleSong']);