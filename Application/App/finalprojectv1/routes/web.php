<?php

use App\Http\Controllers\commentsController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\postPanelController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\signupController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\likesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['sessionmiddleware'])->group(function () {

    Route::get('/index', [indexController::class, 'showindex']);
    Route::get('/index/topiccomments/{postid}', [indexController::class, 'topicCommentsload']);
    Route::get('/logout', [indexController::class, 'logout']);
    Route::get('searchbycate/{element}', [indexController::class, 'searchbycate']);
    Route::get('searchpost', [indexController::class, 'searchedposts']);
    Route::get('fetchdata',[indexController::class,'simpledatafetch']);


    Route::post('/postnow/{id}', [postPanelController::class, 'createpost']);
    Route::get('/showfeed', [postPanelController::class, 'show']);

    Route::get('/status', [statusController::class, 'index']);
    Route::post('/updatestatus', [statusController::class, 'updatestatus']);

    Route::get('/likeme/{id}', [likesController::class, 'likeme']);
    Route::get('getlikes', [likesController::class, 'getLikes']);
    
    Route::get('/profile', [profileController::class, 'index']);
    Route::post('/store', [profileController::class, 'storefile']);
    Route::post('/profile', [profileController::class, 'update']);
    
    Route::get('/addcomment/{id}', [commentsController::class, 'addcomment']);
    Route::get('/getcommentscount', [commentsController::class, 'getcommentscount']);
    Route::get('analyizenow/', [commentsController::class, 'analyizenow']);

    Route::middleware(['admincheck'])->group(function () {

        Route::get('/dashboard', [dashboardController::class, 'index']);

        // Route::get('/postsfordashboard', [dashboardController::class, 'postsinformation']);
        // Route::get('fetchspecificpost/{id}', [dashboardController::class, 'fetchspecificpost']);
        Route::get('/addkeywords', [dashboardController::class, 'addkeywords']); 
        // Route::get('/listallposts', [dashboardController::class, 'allpostlists']);
        // Route::get('dashboard', [dashboardController::class, 'index']);
        // Route::post('getanalysis', [dashboardController::class, 'analyizetext']);
        // Route::get('commentsofselectedpost/{id}', [dashboardController::class, 'commentarray']);
        // Route::get('getindividualcommentanalysis/{commentid}/{postid}', [dashboardController::class, 'getindividualcommentanalysis']);
    
    });

});

Route::get('/signup', [signupController::class, 'index']);
Route::POST('/signup', [signupController::class, 'create']);

Route::get('/login', [LoginController::class, 'index']);
Route::get('/', function () {return redirect('/login');});
Route::post('/login', [LoginController::class, 'login']);
