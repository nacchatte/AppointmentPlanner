<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\PdfController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

//register & login
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register-action', [UserController::class, 'store']);
Route::post('/check-details', [UserController::class, 'checkDetails'])->name('checkDetails');
Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login-action', [LoginController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Verified Email
Route::get('/email/verify', function () {
    return view('Auth.email-verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/updateAnalytics/{year}/{month}', [AdminController::class, 'updateAnalytics'])->name('updateAnalytics')->middleware('auth');


//staff
Route::post('/check-staff-name', [StaffController::class, 'checkStaffName'])->middleware('auth'); //check the name if exist
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create')->middleware('auth');//add page
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store')->middleware('auth');// add action
Route::get('/staff', [StaffController::class, 'index'])->name('staffview')->middleware('auth');// view list of staff
Route::get('/staffdetail', [StaffController::class, 'staffdetail'])->name('staffdetail')->middleware('auth');
Route::get('/staff/{id}', [StaffController::class, 'show'])->name('staff.show')->middleware('auth');//edit page
Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update')->middleware('auth');// edit action
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy')->middleware('auth');


//Customer
Route::post('/check-customer-name', [CustomerController::class, 'checkCustomerName'])->middleware('auth'); //check the name if exist
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index')->middleware('auth');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create')->middleware('auth');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store')->middleware('auth');
Route::get('/customerdetail', [CustomerController::class, 'customerdetail'])->name('customerdetail')->middleware('auth');
Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show')->middleware('auth');
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit')->middleware('auth');
Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update')->middleware('auth');
Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy')->middleware('auth');

// For appointments listing, creating, and storing
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index')->middleware('auth');
Route::get('/appointments/table', [AppointmentController::class, 'tableview'])->name('appointments.table')->middleware('auth');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create')->middleware('auth');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store')->middleware('auth');

// For showing, editing, updating, and deleting appointments
Route::get('/appointmentsdetails/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show')->middleware('auth');
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update')->middleware('auth');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy')->middleware('auth');
Route::get('/check-customer', [AppointmentController::class, 'checkCustomer'])->middleware('auth');
Route::get('/get-appointments', [AppointmentController::class, 'getAppointments'])->middleware('auth');
Route::get('/getdetails/{appointment}', [AppointmentController::class, 'getAppointmentDetails'])->middleware('auth');

//PDF
Route::get('/generate-sales-report/{month}/{year}', [PdfController::class, 'generateSalesReport'])->name('sales-reports.view')->middleware('auth');
Route::get('/sales-reports/{month}/{year}/download', [PdfController::class, 'downloadPdf'])->name('sales-reports.download')->middleware('auth');
Route::post('/sendmail/{month}/{year}', [PdfController::class, 'sendSalesReportEmail'])->name('sales-reports.email')->middleware('auth');
Route::get('/sales-reports', [PdfController::class, 'index'])->name('sales-reports');
