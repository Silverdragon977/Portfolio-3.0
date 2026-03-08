<?php
// /routes/web.php
use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GithubProjectsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProjectController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Exception\CommandNotFoundException;


/////////////////////////////////////////////////////////////
////////    Public Routes    ////////////////////////////////
/////////////////////////////////////////////////////////////
// Old non-RESTful routes - It did work but it was not following RESTful conventions and was a bit messy. I have refactored it to follow RESTful conventions and to be more organized.
// Route::get('/',fn() => view('index'))->name('homePage');
// // This will call the publicIndex for the public route /projects as projectsPage
// Route::get('/projects', [PublicProjectController::class, 'index'])->name('projectsPage'); 
// Route::get('/resume', fn () => view('webpages.resume'))->name('resumePage');
//
// New RESTful routes for public pages
Route::view('/', 'index')->name('home');

Route::get('/projects', [PublicProjectController::class, 'index'])
    ->name('projects.index');

Route::get('/projects/{project}', [PublicProjectController::class, 'show'])
    ->name('projects.show');

Route::view('/resume', 'webpages.resume')->name('resume');
//////////////////////////////////////////////////////////////
//
//
//////////////////////////////////////////////////////////////
////////     Routes Protected with Authorization     /////////
//////////////////////////////////////////////////////////////
// Old non-RESTful routes  - It did work but it was not following RESTful conventions and was a bit messy. I have refactored it to follow RESTful conventions and to be more organized.
// Route::middleware(['auth'])->group(function(){
//     Route::get('/games', fn()=>view('webpages.click-hero'))->name('clickHero');
//     Route::get('/contact', [CommentController::class, 'create'])->name('contactPage');
//     Route::post('/contact', [CommentController::class, 'store'])->name('contact.store');
//     //
//     // Dashboard need Authorization and Verification
//     Route::get('dashboard', fn()=> view('dashboard'))->middleware('verified')->name('dashboard');
//     //
//     // User Profile Page Routes
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// Refactored RESTful routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::view('/ClickHero', 'webpages.clickHero')->name('ClickHero');
    Route::get('/contact', [CommentController::class, 'create'])
        ->name('contact.create');

    Route::post('/contact', [CommentController::class, 'store'])
        ->name('contact.store');

    Route::view('/dashboard', 'dashboard')
        ->middleware('verified')
        ->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});
//////////////////////////////////////////////////////////////
//
//
//////////////////////////////////////////////////////////////
////////    Admin Panel Routes    ////////////////////////////
//////////////////////////////////////////////////////////////
// Old non-RESTful routes  - It did work but it was not following RESTful conventions and was a bit messy. I have refactored it to follow RESTful conventions and to be more organized.
// Route::middleware(['auth', 'admin'])->group(function() {
//     Route::get('/admin', [AdminRouteController::class, 'index'])->name('admin.index');
//     //// Project Routes
//     // Create
//     Route::get('/admin/createProject', [GithubProjectsController::class, 'create'])->name('admin.projects.create');
//     Route::post('/admin/createProject', [GithubProjectsController::class, 'store'])->name('admin.projects.store');
//     // Edit/Update
//     Route::get('/admin/editProject/{project}', [GithubProjectsController::class, 'edit'])->name('admin.projects.edit');
//     Route::put('/admin/editProject/{project}', [GithubProjectsController::class, 'update'])->name('admin.projects.update');
//     // Delete
//     Route::delete('/admin/deleteProject/{project}', [GithubProjectsController::class, 'destroy'])->name('admin.projects.destroy');
//     Route::delete('/admin/deleteComment/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
// });
//
//  Refactored RESTful routes for Admin Panel
Route::middleware(['auth', 'admin'])
    ->prefix('admin') // All routes have /admin/
    ->name('admin.')  // All route names start with admin. 
    ->group(function () {

        Route::get('/', [AdminRouteController::class, 'index']) 
            ->name('dashboard');
            //  /admin/
            //  admin.dashboard

        Route::resource('projects', GithubProjectsController::class)
            ->except(['show']);
            // Shows the github projects and allows admin to create, edit, update and delete projects

        Route::delete('comments/{comment}', [CommentController::class, 'destroy'])
            ->name('comments.destroy');
            // Allows admin to delete comments from the contact form

        Route::delete('/users/{user}', [AdminRouteController::class, 'deleteUser'])
            ->name('users.delete');
            // Allows admin to delete users from the admin panel




});
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////

require __DIR__.'/auth.php';
