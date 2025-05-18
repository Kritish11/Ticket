<?php

use App\Http\Controllers\AdminControllers\BusRouteController;
use App\Http\Controllers\AdminControllers\BusFeatureController;
use App\Http\Controllers\AdminControllers\BusStandardController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogController;
use App\Models\blog;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/login', function() {
    return view('login');
});
Route::get('/register', function() {
    return view('register');
});
Route::get('/aboutus', function() {
    return view('aboutus');
});
Route::get('/contact', function() {
    return view('contact');
});
Route::get('/emailvalid', function() {
    return view('emailvalid');
});
Route::get('/search', function() {
    return view('search');
});
Route::get('/seatselect', function() {
    return view('seatselect');
});
Route::get('/mybooking', function() {
    return view('mybooking');
});
Route::get('/reservation', function() {
    return view('reservation');
});
Route::get('/ticket', function() {
    return view('ticket');
});
Route::get('/terms', function() {
    return view('terms');
});
Route::get('/policy', function() {
    return view('policy');
});

Route::post('/route_add',[BusRouteController::class,'addRoute'])->name('route.save');

//admin routes
Route::get('/adminlogin', function() {
    return view('AdminViews.login');
});

Route::get('/admindashboard', function() {
    $activeAuthors = \App\Models\author::where('status', 1)->get();
    return view('AdminViews.mainpage', compact('activeAuthors'));
});

Route::get('/admin/routes', [BusRouteController::class, 'showRoute'])->name('admin.routes');
Route::post('/route_add',[BusRouteController::class,'addRoute'])->name('route.save');
Route::post('/route/{id}', [BusRouteController::class, 'updateRoute'])->name('route.update');
Route::delete('/route/{id}', [BusRouteController::class, 'deleteRoute'])->name('route.delete');

// Feature routes
Route::post('/feature_add',[BusFeatureController::class,'addFeature'])->name('feature.save');
Route::get('/admin/features', [BusFeatureController::class, 'getFeatures'])->name('features.get');
Route::delete('/feature/{id}', [BusFeatureController::class, 'deleteFeature'])->name('feature.delete');

// Standard routes
Route::post('/standard_add',[BusStandardController::class,'addStandard'])->name('standard.save');
Route::get('/admin/standards', [BusStandardController::class, 'getStandards'])->name('standards.get');
Route::delete('/standard/{id}', [BusStandardController::class, 'deleteStandard'])->name('standard.delete');

//Author Route
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.get');
Route::post('/author/add', [AuthorController::class, 'store'])->name('author.save');
Route::delete('/author/{id}', [AuthorController::class, 'status'])->name('author.delete');
Route::get('/active-authors', [AuthorController::class, 'getActiveAuthors'])->name('authors.active');

// Blog Route
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.get');
Route::post('/blog/add', [BlogController::class, 'store'])->name('blog.save');
Route::post('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');
Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
