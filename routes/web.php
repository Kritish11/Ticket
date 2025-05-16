<?php

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





//admin routes
Route::get('/adminlogin', function() {
    return view('AdminViews.login');
});

Route::get('/admindashboard', function() {
    return view('AdminViews.mainpage');
});
