<?php

use App\Http\Controllers\Resources\FilesController;
use Illuminate\Support\Facades\Route;

Route::resource('/resources/files', FilesController::class)->except('destroy');
Route::get('/resources/files/{file}/delete', [FilesController::class, 'delete'])->name('files.delete');
Route::get('/resources/files/{file}/download', [FilesController::class, 'download'])->name('files.download');
