<?php

use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\GithubProjects; 


## UnProtected Routes

Route::get('/', function () {
    return view('index');
})->name('homePage');

Route::get('/projects', function () {
    $projects = GithubProjects::all();
    return view('webpages.projects', compact('projects'));
})->name('projectsPage');

Route::get('/resume', function () {
    return view('webpages.resume');
})->name('resumePage');


## Protected Routes
Route::get('/games', function(){
    return view('webpages.clickHero');
})->middleware('auth')->name('clickHero');

Route::get('/contact', function () {
    return view('webpages.contact');
})->middleware('auth')->name('contactPage');

## User Profile Page Routes

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



## Admin Routes

// Old way of doing things
// Route::get('/admin', function () {
//     return view('protectedWebPages.indexAdmin');
// })->middleware('admin')->name('adminPage');

// Index
Route::get('/admin', [AdminRouteController::class, 'index']
)->middleware('admin')->name('admin.index');
// Create New Project
Route::get('/admin/createProject', [AdminRouteController::class, 'createProject']
)->middleware('admin')->name('admin.createProject');

// Store New Project
Route::post('/admin', [AdminRouteController::class, 'storeProject']
)->middleware('admin')->name('admin.storeProject');

// Edit Projects
Route::get('/admin/{project}/editProject', [AdminRouteController::class, 'editProject']
)->middleware('admin')->name('admin.editProject');

// Update Projects
Route::put('/admin/{project}/updateProject', [AdminRouteController::class, 'updateProject']
)->middleware('admin')->name('admin.updateProject');

// Delete Projects
Route::delete('/admin/{project}/deleteProject', [AdminRouteController::class, 'deleteProject']
)->middleware('admin')->name('admin.deleteProject');

require __DIR__.'/auth.php';
