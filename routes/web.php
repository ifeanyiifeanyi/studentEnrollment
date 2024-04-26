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
use App\Http\Controllers\Admin\ManageAdminController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\StudentManagementController;
use App\Http\Controllers\Student\ApplicationProcessController;
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

Route::get('/payment', function () {
    return view('student.application.index'); 
})->name('payment.view');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::controller(AdminDashboardController::class)->group(function(){
        Route::get('dashboard', 'index')->name('admin.dashboard');
        Route::get('logout', 'logout')->name('admin.logout');

        Route::get('site-settings', 'siteSettings')->name('site.settings');
        Route::post('site-settings/store', 'siteSettingStore')->name('site.setting.store');
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

        Route::get('exam-subject', 'subjects')->name("admin.subject");
        Route::post('exam-subject/store', 'subjectStore')->name("admin.subject.store");
        Route::get('exam-subject/del/{subject}', 'subjectDel')->name("admin.subject.del");
    
    });

    Route::controller(StudentManagementController::class)->group(function(){
        Route::get('student-management', 'index')->name('admin.student.management');
        Route::get('student-applications', 'application')->name('admin.student.application');
        Route::get('student-application-ref', 'applicationRef')->name('admin.student.applicationRef');
        Route::get('student-application-pdf', 'exportPdf')->name('admin.student.applications.exportPDF');


        Route::post('/import-applications', 'import')->name('admin.student.applications.import');
        Route::get('student-applications/export', 'exportApplications')->name('admin.student.applications.export');
        Route::get('view-student/{slug}','show')->name('admin.show.student');

        Route::post('/delete-multiple-students', 'deleteMultipleStudents')->name('admin.students.deleteMultiple');
        Route::get('delete-student/{slug}', 'destroy')->name('admin.destroy.student');


        
        
        Route::get('edit-student/{slug}', 'edit')->name('admin.edit.student');
        Route::patch('update-student/{slug}', 'update')->name('admin.update.student');
    });



    Route::controller(PaymentMethodController::class)->group(function(){
        Route::get('payment-method-management/{id?}', 'index')->name('admin.payment.manage');
        Route::post('payment-method-manager', 'store')->name('admin.payment.store');
        Route::patch('payment-method-manage/{id}', 'update')->name('admin.payment.update');
        Route::get('payment-method-del/{id}', 'destroy')->name('admin.payment.destroy');

        // manage payments paid by students
        Route::get('student-application-payment', 'studentApplicationPayment')->name('admin.studentApplication.payment');
    });

    Route::controller(ManageAdminController::class)->group(function(){
        Route::get('manage-admin', 'index')->name('admin.manage.admin');
        Route::get('manage-admin/create', 'create')->name('admin.manage.create');
        Route::post('manage-admin/store', 'store')->name('admin.manage.store');
        Route::get('manage-admin/edit/{slug}', 'edit')->name('admin.manage.edit');
        Route::patch('manage-admin/update/{slug}', 'update')->name('admin.manage.update');
    });





});

Route::prefix('student')->middleware(['auth', 'verified', 'role:student'])->group(function(){
    Route::controller(StudentDashboardController::class)->group(function(){
        Route::get('dashboard', 'dashboard')->name('student.dashboard')->middleware('check.payment.status');
        Route::get('logout', 'logout')->name('student.logout');

        Route::get('faculty-user/{slug}', 'facultyDetail')->name('student.faculty.show');
        Route::get('department-user/{id}', 'departmentDetail')->name('student.department.show');
    });

    Route::controller(StudentProfileController::class)->middleware('check.payment.status')->group(function(){
        Route::get('profile', 'profile')->name('student.profile');
        Route::get('profile/set-password', 'setPassword')->name('student.profile.setPassword');
        Route::patch('profile/update-password', 'updatePassword')->name('student.profile.updatePassword');
        Route::patch('profile/update', 'update')->name('student.profile.update');
    });

    //NOTE: remember there is a task to delete application not paid after 20days(DeleteUnpaidApplications)
    Route::controller(ApplicationProcessController::class)->group(function(){
        Route::get('application-process', 'index')->name('student.application.process')->middleware('check.application.status');
        Route::get('/payment/{userSlug}', 'finalApplicationStep')->name('payment.view.finalStep');

        Route::post('application-process/store','processPayment')->name('student.payment.process');
        Route::get('handle/flutter-payment-call', 'handlePaymentCallBack')->name('student.payment.callbackFlutter');
        Route::get('handle/paystack-payment-call', 'handlePaymentCallBackPayStack')->name('student.payment.callbackPaystack');


        Route::get('/payment/success', 'showSuccess')->name('student.payment.success');

    });



});
require __DIR__ . '/auth.php';
