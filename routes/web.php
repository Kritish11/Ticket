<?php

use App\Http\Controllers\AdminControllers\BannerController;
use App\Http\Controllers\AdminControllers\BusController;
use App\Http\Controllers\AdminControllers\BusRouteController;
use App\Http\Controllers\AdminControllers\BusFeatureController;
use App\Http\Controllers\AdminControllers\BusStandardController;
use App\Http\Controllers\AdminControllers\GraphicController;
use App\Http\Controllers\AdminControllers\ScheduleController;
use App\Http\Controllers\AdminControllers\AdminUserController;  // Update this line
use App\Http\Controllers\AuthController;
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

// Public routes
Route::get('/', function () {
    return view('index');
});
Route::get('/search', function() {
    return view('search');
});
Route::get('/contact', function() {
    return view('contact');
});
Route::get('/aboutus', function() {
    return view('aboutus');
});

Route::get('/login', function() {
    if (session()->has('is_logged_in')) {
        return redirect('/');
    }
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function() {
    return view('register');
});
Route::get('/emailvalid', function() {
    return view('emailvalid');
});
Route::get('/terms', function() {
    return view('terms');
});
Route::get('/policy', function() {
    return view('policy');
});

Route::post('/route_add',[BusRouteController::class,'addRoute'])->name('route.save');

// Registration and verification routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/email/verify', function() {
    if (!session()->has('user_id')) {
        return redirect('/register');
    }
    return view('emailvalid');
})->name('email.verify');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');

// Authentication Routes
Route::middleware(['user.auth'])->group(function() {
    Route::post('/book-ticket', 'BookingController@store')->name('book.ticket');
    Route::get('/mybookings', 'BookingController@index')->name('user.bookings');
    Route::get('/profile', 'UserController@profile')->name('user.profile');
});

// Protected booking routes
Route::middleware(['user.auth'])->group(function() {
    Route::get('/mybooking', function() {
        return view('mybooking');
    });
    Route::get('/seatselect', function() {
        return view('seatselect');
    });
    Route::get('/reservation', function() {
        return view('reservation');
    });
});

// Search and Booking Flow Routes
Route::get('/search', function() {
    return view('search');
});

Route::get('/seatselect/{scheduleId}', [BookingController::class, 'showSeatSelection'])
    ->name('booking.seats');

Route::get('/reservation/{scheduleId}', [BookingController::class, 'showReservation'])
    ->middleware('user.auth')
    ->name('booking.reservation');

// Admin guest routes (accessible without login)
Route::get('/adminlogin', function() {
    if (session()->has('is_admin')) {
        return redirect()->route('admin.dashboard');
    }
    return view('AdminViews.login');
})->name('admin.login');

Route::post('/adminlogin', [AdminUserController::class, 'login'])->name('admin.login.submit');

// Admin protected routes
Route::middleware(['admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', function() {
        return view('AdminViews.mainpage');
    })->name('admin.dashboard');

    Route::post('/logout', [AdminUserController::class, 'logout'])->name('admin.logout');

    Route::get('/buses', [BusController::class, 'index'])->name('admin.buses');
    Route::get('/routes', [BusRouteController::class, 'showRoute'])->name('admin.routes');

    Route::post('/route_add',[BusRouteController::class,'addRoute'])->name('route.save');
    Route::post('/route/{id}', [BusRouteController::class, 'updateRoute'])->name('route.update');
    Route::delete('/route/{id}', [BusRouteController::class, 'deleteRoute'])->name('route.delete');

    // Feature routes
    Route::post('/feature_add',[BusFeatureController::class,'addFeature'])->name('feature.save');
    Route::get('/features', [BusFeatureController::class, 'getFeatures'])->name('features.get');
    Route::delete('/feature/{id}', [BusFeatureController::class, 'deleteFeature'])->name('feature.delete');

    // Standard routes
    Route::post('/standard_add',[BusStandardController::class,'addStandard'])->name('standard.save');
    Route::get('/standards', [BusStandardController::class, 'getStandards'])->name('standards.get');
    Route::delete('/standard/{id}', [BusStandardController::class, 'deleteStandard'])->name('standard.delete');

    // Author Route
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.get');
    Route::post('/author/add', [AuthorController::class, 'store'])->name('author.save');
    Route::delete('/author/{id}', [AuthorController::class, 'status'])->name('author.delete');
    Route::get('/active-authors', [AuthorController::class, 'getActiveAuthors'])->name('authors.active');

    // Blog Route
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.get');
    Route::post('/blog/add', [BlogController::class, 'store'])->name('blog.save');
    Route::post('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.delete');

    // Buses
    Route::get('/buses', [BusController::class, 'index'])->name('admin.buses');
    Route::get('/buses/create', [BusController::class, 'create'])->name('admin.buses.create');
    Route::post('/buses', [BusController::class, 'store'])->name('admin.buses.store');
    Route::get('/buses/{bus}/edit', [BusController::class, 'edit'])->name('admin.buses.edit');
    Route::put('/buses/{bus}', [BusController::class, 'update'])->name('admin.buses.update');
    Route::delete('/buses/{bus}', [BusController::class, 'destroy'])->name('admin.buses.destroy');
    Route::get('/bus-standards', [BusStandardController::class, 'getStandards']);
    Route::get('/bus-features', [BusFeatureController::class, 'getFeatures']);

    // Schedule routes
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('admin.schedules');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('admin.schedules.store');
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('admin.schedules.update');
    Route::put('/schedules/{schedule}/status', [ScheduleController::class, 'updateStatus'])->name('admin.schedules.status');
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('admin.schedules.destroy');

    Route::get('/routes', [BusRouteController::class, 'getRoutes']);
    Route::post('/banners', [BannerController::class, 'store']);

    // Banner routes
    Route::get('/banners', [BannerController::class, 'index']);
    Route::post('/banners', [BannerController::class, 'store']);
    Route::put('/banners/{banner}', [BannerController::class, 'update']);
    Route::delete('/banners/{banner}', [BannerController::class, 'destroy']);

    // Graphic routes
    Route::get('/graphics', [GraphicController::class, 'index']);
    Route::post('/graphics', [GraphicController::class, 'store']);
    Route::match(['put', 'patch'], '/graphics/{graphic}', [GraphicController::class, 'update']);
    Route::delete('/graphics/{graphic}', [GraphicController::class, 'destroy']);
});
