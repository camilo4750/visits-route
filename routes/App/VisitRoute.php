<?php

use App\Http\Controllers\Visit\VisitController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/visits', [VisitController::class, 'index'])->name('visits.index');
    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');
    Route::get('/visits/{id}', [VisitController::class, 'show'])->name('visits.show');
    Route::put('/visits/{id}', [VisitController::class, 'update'])->name('visits.update');
    Route::delete('/visits/{id}', [VisitController::class, 'destroy'])->name('visits.destroy');
});