<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController; // Add Post Controller
use App\Http\Controllers\GithubProjectsController;

// Get Method Route's
Route::get('/', function () {
    return view('index');
})->name('homePage');

Route::get('/contact', function () {
    return view('webpages.contact');
})->name("contactPage");

Route::get('/resume', function () {
    return view('webpages.resume');
})->name("resumePage");

Route::get('/projects', function(){
    return view('webpages.projects');
})->name('projectsPage');













// // Parameters using routes
// Route::get('/parameterExample/{firstname}/{lastname}', function ($firstname, $lastname) {
//     return "Hello, " . $firstname . " " . $lastname;
// });
// // Grouped routes
// // Good for  /portfolio/multipleLinksHere
// //           /portfolio/company
// //           /portfolio/organization
// Route::prefix("portfolio")->group(function(){
//     Route::get('/company', function () {
//         return view('client');
//         });
//     });
//     Route::get('/organization', function () {
//         return view('organization');
//         });
//     });
// Route::get('/test2', function () {
//     return view('test');
// })->name("testpage2");


///////////////////////
// Post Route Example
////////////////////////
Route::post("/formsubmitted", function(Request $request){
    // We use the class Request to get a $request var as parameter 
    // Grabbing RAW Data

    $request->validate([
        'Email' => 'required | min:8 | max:255 | email',
        'Password' => 'required | min:8'
    ]);

    $email = $request->input("Email");
    $password = $request->input("Password");

    return "Your email is $email, and your Password is $password";
})->name("formSubmitted");

// // Post Controller Route @ website/public/posts
// // Important for CRUD points to posts method create
// Route::resource('posts', PostController::class);

///////////////////////////////////////
// Projects CRUD and Public Routes   //
//                                   //
// Public route to view projects
// Route::get('/projects', [GithubProjectsController::class, 'index'])->name('projects.index');

// // Admin routes - protected by auth and is_admin middleware
// Route::middleware(['auth', 'is_admin'])->prefix('admin')->as('admin.')->group(function () {
//     Route::resource('github_projects', GithubProjectsController::class)->except(['show']);
// });


///////////////////////////////////////////
