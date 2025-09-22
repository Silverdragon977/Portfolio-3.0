<?php
# /routes/web.php
use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GithubProjectsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Exception\CommandNotFoundException;


#############################################################
########    Public Routes    ################################
#############################################################
Route::get('/',fn() => view('index'))->name('homePage');
## This will call the publicIndex for the public route /projects as projectsPage
Route::get('/projects', [GithubProjectsController::class, 'index'])->name('projectsPage'); 
Route::get('/resume', fn () => view('webpages.resume'))->name('resumePage');
##############################################################
##
##
##############################################################
########     Routes Protected with Authorization     #########
##############################################################
Route::middleware(['auth'])->group(function(){
    Route::get('/games', fn()=>view('webpages.click-hero'))->name('clickHero');
    Route::get('/contact', [CommentController::class, 'create'])->name('contact');
    Route::post('/contact', [CommentController::class, 'store'])->name('contact.store');
    ##
    # Dashboard need Authorization and Verification
    Route::get('dashboard', fn()=> view('dashboard'))->middleware('verified')->name('dashboard');
    ##
    # User Profile Page Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
##############################################################
##
##
##############################################################
########    Admin Panel Routes    ############################
##############################################################

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin', [AdminRouteController::class, 'index'])->name('admin.index');
    Route::resource('projects', GithubProjectsController::class);
    Route::resource('comments', CommentController::class);
    ## Add more resources here
    ## Route::resource('comments', CommentController::class);
    ## Route::resource('users', UserController::class);
});
##############################################################
##############################################################

// ## Index
// Route::get('/admin', [AdminRouteController::class, 'index']
// )->middleware('admin')->name('admin.index');
// ## Create New Project
// Route::get('/admin/createProject', [AdminRouteController::class, 'createProject']
// )->middleware('admin')->name('admin.createProject');

// // Store New Project
// Route::post('/admin', [AdminRouteController::class, 'storeProject']
// )->middleware('admin')->name('admin.storeProject');

// // Edit Projects
// Route::get('/admin/{project}/editProject', [AdminRouteController::class, 'editProject']
// )->middleware('admin')->name('admin.editProject');

// // Update Projects
// Route::put('/admin/{project}/updateProject', [AdminRouteController::class, 'updateProject']
// )->middleware('admin')->name('admin.updateProject');

// // Delete Projects
// Route::delete('/admin/{project}/deleteProject', [AdminRouteController::class, 'deleteProject']
// )->middleware('admin')->name('admin.deleteProject');

require __DIR__.'/auth.php';
