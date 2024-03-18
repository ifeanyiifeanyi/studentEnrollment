<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use League\CommonMark\Extension\SmartPunct\DashParser;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FacultyController;

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

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::controller(AdminDashboardController::class)->group(function(){
        Route::get('dashboard', 'index')->name('admin.dashboard');
        Route::get('logout', 'logout')->name('admin.logout');
        // Route::get('profile', ProfileController::class)->name('admin.profile');
    });

    Route::controller(AdminProfileController::class)->group(function(){
        Route::get('profile', 'show')->name('admin.profile');
        Route::get('profile/set-password', 'setPassword')->name('admin.profile.setPassword');
        Route::patch('profile/update-password', 'updatePassword')->name('admin.profile.updatePassword');
        Route::post('profile/update', 'update')->name('admin.profile.update');
    });

    Route::controller(FacultyController::class)->group(function(){
        Route::get('faculty-management', 'index')->name('admin.manage.faculty');
        Route::get('create-faculty', 'create')->name('admin.create.faculty');
        Route::post('store-faculty', 'store')->name('admin.store.faculty');
        Route::get('delete-faculty/{slug}', 'destroy')->name('admin.destroy.faculty');
    });
     

});

require __DIR__ . '/auth.php';
