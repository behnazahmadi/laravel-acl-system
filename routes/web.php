<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name("dashboard");

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('user/settings/two-factor', [ProfileController::class, 'updateTwoFactorSettings'])->name('user.enable_2fa');

});
Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::post('/users/{id}/login', [UserController::class, 'loginAsUser'])->name('users.login');

});
Route::middleware(['auth'])->group(function () {
    Route::resource('blogs', \App\Http\Controllers\BlogController::class);

});
Route::get('two-factor', [TwoFactorController::class, 'showTwoFactorForm'])->name('auth.two_factor');
Route::post('two-factor', [TwoFactorController::class, 'verifyOtp'])->name("auth.two_factor.post");
require __DIR__ . '/auth.php';
Route::get('/test-email', function () {
    Mail::raw('Test email body', function ($message) {
        $message->to('behnaz.ahmadi1996@gmail.com')
            ->subject('Test Email from Mailtrap');
    });

    return 'Email sent!';
});
