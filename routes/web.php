<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\AdminProfileController;
use League\CommonMark\Extension\SmartPunct\DashParser;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ExamManagerController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentProfileController;

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
    return view('auth.login');
});


Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::controller(AdminDashboardController::class)->group(function(){
        Route::get('dashboard', 'index')->name('admin.dashboard');
        Route::get('logout', 'logout')->name('admin.logout');
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
        Route::get('edit-faculty/{slug}', 'edit')->name('admin.edit.faculty');
        Route::get('view-faculty/{slug}', 'show')->name('admin.show.faculty');
        Route::patch('update-faculty/{slug}', 'update')->name('admin.update.faculty');
    });

    Route::controller(DepartmentController::class)->group(function(){
        Route::get('department-management', 'index')->name('admin.manage.department');
        Route::get('create-department', 'create')->name('admin.create.department');
        Route::post('store-department','store')->name('admin.store.department');
        Route::get('delete-department/{slug}', 'destroy')->name('admin.destroy.department');
        Route::get('edit-department/{slug}', 'edit')->name('admin.edit.department');
        Route::get('view-department/{slug}','show')->name('admin.show.department');
        Route::patch('update-department/{slug}', 'update')->name('admin.update.department');
    });
    // Route::resource("department",DepartmentController::class);

    Route::controller(ExamManagerController::class)->group(function(){
        Route::get('exam-management', 'index')->name('admin.exam.manager');
        Route::post('exam-management/store', 'store')->name("admin.exam.store");
        Route::get('exam-management-details', "examDetails")->name('admin.exam.details');
        Route::get('exam-management-details/{id}', "examInformation")->name('admin.exam.information');
        Route::get('exam-management-details/{id}/edit', "edit")->name('admin.exam.edit');
        Route::patch('exam-management-details/{id}/update', "update")->name('admin.exam.update');
        Route::get('exam-management-details/del/{id}', "destroy")->name('admin.exam.destroy');
    
    });

});

Route::prefix('student')->middleware('auth', 'verified', 'role:student')->group(function(){
    Route::controller(StudentDashboardController::class)->group(function(){
        Route::get('dashboard', 'dashboard')->name('student.dashboard');
        Route::get('logout', 'logout')->name('student.logout');
    });

    Route::controller(StudentProfileController::class)->group(function(){
        Route::get('profile', 'profile')->name('student.profile');
        Route::get('profile/set-password', 'setPassword')->name('student.profile.setPassword');
        Route::patch('profile/update-password', 'updatePassword')->name('student.profile.updatePassword');
        Route::patch('profile/update', 'update')->name('student.profile.update');
    });
});
require __DIR__ . '/auth.php';
