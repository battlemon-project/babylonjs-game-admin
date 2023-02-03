<?php

use App\Http\Controllers\Resources\FoldersController;
use Illuminate\Support\Facades\Route;

Route::resource('/resources/folders', FoldersController::class)->except('destroy');
Route::get('/resources/folders/{folder}/delete', [FoldersController::class, 'delete'])->name('folders.delete');
