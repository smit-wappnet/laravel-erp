<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GuestController;
use App\Models\Employee;
use App\Models\User;
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

// Guest User
Route::get('/', [GuestController::class, 'index'])->middleware('guest')->name("welcome");


Route::get('/signin', [AuthController::class, 'signin_view'])->middleware('guest')->name("auth.signin");
Route::post('/signin', [AuthController::class, 'signin'])->middleware('guest');

Route::get('/signup', [AuthController::class, 'signup_view'])->middleware('guest')->name("auth.signup");
Route::post('/signup', [AuthController::class, 'signup'])->middleware('guest');


// After Login
Route::get('/', [AuthController::class, 'dashboard'])->middleware("auth");

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware("auth")->name('dashboard');

Route::get('/employees', [EmployeeController::class, 'index'])->middleware('auth')->name('employees');
Route::post('/employees', [EmployeeController::class, 'create'])->middleware('auth');
Route::get('/employees/delete/{employee}', [EmployeeController::class, 'delete'])->middleware('auth')->name('employees.delete');
Route::get('/employees/edit/{employee}', [EmployeeController::class, 'edit'])->middleware('auth')->name('employees.edit');
Route::post('/employees/edit/{employee}', [EmployeeController::class, 'update'])->middleware('auth')->name('employees.edit');


Route::get('/signout', [AuthController::class, 'signout'])->middleware('auth')->name('signout');
