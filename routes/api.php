<?php // routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MtgCardController;

Route::post('/mtg-cards/{id}/image', [MtgCardController::class, 'storeImage'])->middleware('throttle:60,1');

