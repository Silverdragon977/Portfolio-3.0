<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('homePage');

Route::get('/projects', function () {
    return view('webpages.projects');
})->name('projectsPage');

Route::get('/resume', function () {
    return view('webpages.resume');
})->name('resumePage');

Route::get('/contact', function () {
    return view('webpages.contact');
})->name('contactPage');

Route::get('/admin', function () {
    return view('protectedWebPages.indexAdmin');
})->middleware('admin')->name('adminPage');

Route::get('/games', function(){
    return view('webpages.clickHero');
})->middleware('auth')->name('clickHero');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
