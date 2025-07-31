<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiHomiliaController;

// Route::get('/', "App\Http\Controllers\GeminiHomiliaController@create")->name("gemini-homilia.create");
Route::get('/', fn() => view('home'))->name("gemini-homilia.create");
Route::post('/gemini-homilia', "App\Http\Controllers\GeminiHomiliaController@store")->name("gemini-homilia.store");
Route::post('/export-pdf', [GeminiHomiliaController::class, 'exportPdf'])->name('gemini-homilia.export-pdf');

