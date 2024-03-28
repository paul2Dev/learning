<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index'])->name('index');


Route::get('/user/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'profileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'changePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'passwordUpdate'])->name('user.password.update');
});

require __DIR__.'/auth.php';

//admin group
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'profileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'changePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'passwordUpdate'])->name('admin.password.update');
});

//instruction group
Route::get('/instructor/login', [InstructorController::class, 'login'])->name('instructor.login');
Route::middleware(['auth', 'roles:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'instructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 'logout'])->name('instructor.logout');
    Route::get('/instructor/profile', [InstructorController::class, 'profile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'profileStore'])->name('instructor.profile.store');
    Route::get('/instructor/change/password', [InstructorController::class, 'changePassword'])->name('instructor.change.password');
    Route::post('/instructor/password/update', [InstructorController::class, 'passwordUpdate'])->name('instructor.password.update');
});
