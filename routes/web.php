<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse; // default Laravel response type for JSON responses.
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FitnessLogController;
use App\Http\Middleware\CheckRole; // Middleware for role-checking
use App\Models\Products; // Import the Products model
use App\Models\Mentor;
use App\Models\WorkoutVideo;


Route::get('/', function () {
    return view('welcome');
});

// Define route for displaying the login form
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Define route for the registration page
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Define route for displaying the welcome page
Route::get('welcome', [AuthController::class, 'showWelcomePage'])->name('welcome');

// Define route for the forgot password page and handle the reset process
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Route to handle the registration form submission
Route::post('register-submit', [AuthController::class, 'register'])->name('register.submit');

// Route to handle the login authentication
Route::post('login-submit', [AuthController::class, 'login'])->name('login.submit');

Route::group(['CheckRole' => 'role:admin'], function () {
    Route::get('/admin', [AuthController::class, 'showAdmin'])->name('admin');
    // Other admin routes
});

Route::group(['CheckRole' => 'role:user'], function () {
    Route::get('/main', [AuthController::class, 'showMain'])->name('main');
    // Other user routes
});

Route::post('/fitness-log', [FitnessLogController::class, 'store'])->middleware('auth');
Route::get('/fitness-log', [FitnessLogController::class, 'index'])->middleware('auth');

// Define the route to fetch all products
Route::get('/products', [ProductController::class, 'getProducts']);
// Users API endpoint
Route::get('/users', [AdminController::class, 'getUsers']);
// User count API endpoint
Route::get('/user-count', [AdminController::class, 'getUserCount']);
// video count API endpoint
Route::get('/video-count', [AdminController::class, 'getVideoCount']);

Route::get('/mentors', [AdminController::class, 'getMentors']);
Route::get('/workout-videos', [AdminController::class, 'getWorkoutVideos']);