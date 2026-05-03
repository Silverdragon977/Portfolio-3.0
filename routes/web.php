<?php // /routes/web.php
use App\Http\Controllers\APi\ClickerHeroController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GithubProjectsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProjectController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MtgCardController;
use App\Models\Visitor;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Exception\CommandNotFoundException;



/////////////////////////////////////////////////////////////
////////    Public Routes    ////////////////////////////////
/////////////////////////////////////////////////////////////
//
// New RESTful routes for public pages
Route::get('/', [LocationController::class, 'index'])->name('home');
# IP Tracker Route

Route::get('/projects', [PublicProjectController::class, 'index'])
    ->name('projects.index');

Route::get('/projects/{project}', [PublicProjectController::class, 'show'])
    ->name('projects.show');

Route::view('/resume', 'webpages.resume')->name('resume');

Route::get('/whatIsMyIP', [LocationController::class, 'displayIPData'])->name('whatIsMyIP');

Route::get('/api/mtg-cards', [MtgCardController::class, 'index'])->name('MTGIndex');

Route::get('/mtg-searcher', function () {
    return view('webpages.MTGSearch');
})->name('MTGSearcher');

Route::get('/mtg-searcher/{id}', [MtgCardController::class, 'show']);

Route::get('/contact', [CommentController::class, 'create'])
        ->name('contact.create');

Route::post('/contact', [CommentController::class, 'store'])
        ->middleware('throttle:3,10')
        ->name('contact.store');

//////////////////////////////////////////////////////////////
//
//
//////////////////////////////////////////////////////////////
////////     Routes Protected with Authorization     /////////
//////////////////////////////////////////////////////////////
// Refactored RESTful routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::view('/clickhero', 'webpages.clickHero')->name('ClickHero');

    Route::get('/clickerhero/load', [ClickerHeroController::class, 'load']);
    Route::post('/clickerhero/save', [ClickerHeroController::class, 'store']);
    Route::get('/leaderboard', [ClickerHeroController::class, 'leaderboard']);





    Route::view('/dashboard', 'dashboard')
        ->middleware('verified')
        ->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    // Future Profile Deck routes
    // Route::post('/api/deck/add-card', [DeckController::class, 'addCard']);
    // Route::get('/api/decks', [DeckController::class, 'index']);


});
//////////////////////////////////////////////////////////////
//
//
//////////////////////////////////////////////////////////////
////////    Admin Panel Routes    ////////////////////////////
//////////////////////////////////////////////////////////////

Route::middleware(['auth', 'admin', 'verified'])
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
          
        ///////////////////////////////////
        //  User Stats for ClickerGame  //

        Route::get('/users/{user}/games/clicker',[AdminRouteController::class, 'showClickerStats']
            )->name('users.games.clicker');
        Route::post('/users/{user}/games/clicker/reset', [AdminRouteController::class, 'resetClickerStats']
            )->name('users.games.clicker.reset');


});
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////

require __DIR__.'/auth.php';
