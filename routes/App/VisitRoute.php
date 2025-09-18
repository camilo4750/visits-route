<?php

use App\Http\Controllers\Visit\VisitController;
use Illuminate\Support\Facades\Route;

Route::prefix('visits')->group(function () {
    Route::post('/store', [VisitController::class, 'store'])->name('visits.store');
});