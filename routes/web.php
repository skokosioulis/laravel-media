<?php

use Illuminate\Support\Facades\Route;
use Skokosioulis\LaravelMedia\Http\Controllers\MediaController;

/*
|--------------------------------------------------------------------------
| Laravel Media Routes
|--------------------------------------------------------------------------
|
| Here are the routes for the Laravel Media package. These routes provide
| endpoints for media upload, management, and serving.
|
*/

Route::middleware(['web'])->prefix('media')->name('media.')->group(function () {
    // Media upload endpoint
    Route::post('upload', [MediaController::class, 'upload'])->name('upload');
    
    // Media management endpoints
    Route::get('{media}', [MediaController::class, 'show'])->name('show');
    Route::put('{media}', [MediaController::class, 'update'])->name('update');
    Route::delete('{media}', [MediaController::class, 'destroy'])->name('destroy');
    
    // Bulk operations
    Route::post('bulk-delete', [MediaController::class, 'bulkDelete'])->name('bulk-delete');
    
    // Media serving (if not using direct storage links)
    Route::get('serve/{media}', [MediaController::class, 'serve'])->name('serve');
    
    // Thumbnail generation
    Route::get('thumbnail/{media}', [MediaController::class, 'thumbnail'])->name('thumbnail');
});
