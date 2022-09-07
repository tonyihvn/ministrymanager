<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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


Auth::routes();
Auth::routes(['verify' => true]);
// ->middleware('role:editor,approver');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

// MEMBERS
Route::get('/members', [App\Http\Controllers\HomeController::class, 'members'])->name('members')->middleware('role:Worker,Admin,Followup,Pastor,Finance,Super');
Route::get('/add-new', [App\Http\Controllers\HomeController::class, 'addNew'])->name('add-new')->middleware('role:Worker,Admin,Followup,Pastor,Super');
Route::post('/addnew', [App\Http\Controllers\HomeController::class, 'create'])->name('addnew')->middleware('role:Worker,Admin,Followup,Pastor,Super');
Route::get('/edit-member/{id}/', [App\Http\Controllers\HomeController::class, 'editMember'])->name('edit-member')->middleware('role:Worker,Admin,Followup,Pastor,Super');
Route::get('/member/{id}/', [App\Http\Controllers\HomeController::class, 'member'])->name('member')->middleware('role:Worker,Admin,Member,Followup,Pastor,Super');
Route::get('/delete-member/{id}', [App\Http\Controllers\HomeController::class, 'deleteMember'])->name('delete-member')->middleware('role:Admin,Followup,Pastor,Super');
Route::post('/settings', [App\Http\Controllers\HomeController::class, 'settings'])->name('settings')->middleware('role:Super');
Route::post('/switchministry', [App\Http\Controllers\HomeController::class, 'switchministry'])->name('switchministry')->middleware('role:Super,Admin');
Route::post('/searchmembers', [App\Http\Controllers\HomeController::class, 'membersSearch'])->name('searchmembers')->middleware('role:Worker,Admin,Followup,Pastor,Finance,Super');


// TASKS / TO DOs
Route::post('/newtask', [App\Http\Controllers\TasksController::class, 'store'])->name('newtask')->middleware('role:Worker,Admin,Followup,Pastor,Super');
Route::post('/newfollowup', [App\Http\Controllers\TasksController::class, 'newfollowup'])->name('newfollowup')->middleware('role:Worker,Admin,Followup,Pastor,Super');
Route::get('/tasks', [App\Http\Controllers\TasksController::class, 'index'])->name('tasks')->middleware('role:Worker,Admin,Followup,ember,Pastor,Super');
Route::get('/completetask/{id}', [App\Http\Controllers\TasksController::class, 'completetask'])->name('completetask')->middleware('role:Worker,Admin,Followup,Pastor,Super');
Route::get('/inprogresstask/{id}', [App\Http\Controllers\TasksController::class, 'inprogresstask'])->name('inprogresstask')->middleware('role:Worker,Admin,Followup,Pastor,Super');
Route::get('/delete-task/{id}', [App\Http\Controllers\TasksController::class, 'destroy'])->name('destroy')->middleware('role:Super');
Route::get('/delete-followup/{id}', [App\Http\Controllers\TasksController::class, 'deletefollowup'])->name('delete-followup')->middleware('role:Worker,Admin,Followup,Pastor,Super');

// ACCOUNT HEADS
Route::get('/account-heads', [App\Http\Controllers\AccountheadsController::class, 'index'])->name('account-heads')->middleware('role:Finance,Admin,Super');
Route::post('/addaccounthead', [App\Http\Controllers\AccountheadsController::class, 'store'])->name('addaccounthead')->middleware('role:Finance,Admin,Super');
Route::get('/delete-acch/{id}', [App\Http\Controllers\AccountheadsController::class, 'destroy'])->name('delete-acch')->middleware('role:Super');

// ATTENDANCE
Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance')->middleware('role:Usher,Admin,Super');
Route::post('/addattendance', [App\Http\Controllers\AttendanceController::class, 'store'])->name('addattendance')->middleware('role:Usher,Admin,Super');
Route::get('/delete-attd/{id}', [App\Http\Controllers\AttendanceController::class, 'destroy'])->name('delete-attd')->middleware('role:Usher,Admin,Super');

// TRANSACTIONS
Route::get('/transactions', [App\Http\Controllers\TransactionsController::class, 'index'])->name('transactions')->middleware('role:Finance,Admin,Super');
Route::post('/addtransaction', [App\Http\Controllers\TransactionsController::class, 'store'])->name('addtransaction')->middleware('role:Finance,Admin,Super');
Route::get('/delete-trans/{id}', [App\Http\Controllers\TransactionsController::class, 'destroy'])->name('delete-trans')->middleware('role:Finance,Super');

// MINISTRIES
Route::get('/ministries', [App\Http\Controllers\MinistriesController::class, 'index'])->name('ministries')->middleware('role:Admin,Super,Pastor');
Route::post('/addministry', [App\Http\Controllers\MinistriesController::class, 'store'])->name('addministry')->middleware('role:Admin,Super,Pastor');
Route::get('/delete-mins/{id}', [App\Http\Controllers\MinistriesController::class, 'destroy'])->name('delete-mins')->middleware('role:Admin,Super,Pastor');

// HOUSE FELLOWSHIPS
Route::get('/house-fellowships', [App\Http\Controllers\HousefellowhipsController::class, 'index'])->name('house-fellowships')->middleware('role:Admin,Super,Pastor');
Route::post('/addhfellowship', [App\Http\Controllers\HousefellowhipsController::class, 'store'])->name('addhfellowship')->middleware('role:Admin,Super,Pastor');
Route::get('/delete-hfel/{id}', [App\Http\Controllers\HousefellowhipsController::class, 'destroy'])->name('delete-hfel')->middleware('role:Admin,Super,Pastor');


// PROGRAMMES
Route::get('/programmes', [App\Http\Controllers\ProgrammesController::class, 'index'])->name('programmes')->middleware('role:Member,Admin,Memeber,Super,Pastor');
Route::post('/addprogramme', [App\Http\Controllers\ProgrammesController::class, 'store'])->name('addprogramme')->middleware('role:Admin,Super,Pastor');
Route::get('/post/{id}', [App\Http\Controllers\ProgrammesController::class, 'post'])->name('post');
Route::get('/delete-prog/{id}', [App\Http\Controllers\ProgrammesController::class, 'destroy'])->name('delete-prog')->middleware('role:Admin,Super,Pastor');

// COMMUNICATION
Route::get('/communications', [App\Http\Controllers\HomeController::class, 'communications'])->name('communications')->middleware('role:Admin,Super,Pastor');
Route::post('/sendsms', [App\Http\Controllers\HomeController::class, 'sendSMS'])->name('sendsms')->middleware('role:Admin,Super,Pastor');
Route::get('/sentmessages', [App\Http\Controllers\HomeController::class, 'sentSMS'])->name('sentmessages')->middleware('role:Admin,Super,Pastor');

// AUDITS ROUTES
Route::get('/audits', [App\Http\Controllers\HomeController::class, 'audits'])->name('audits')->middleware('role:Admin,Super,Pastor');
Route::get('/delete-audit/{id}', [App\Http\Controllers\HomeController::class, 'delAudit'])->name('delete-audit')->middleware('role:Admin,Super,Pastor');


// ARTISAN COMMANDS
Route::get('/artisan1/{command}', [App\Http\Controllers\ProgrammesController::class, 'Artisan1']);
Route::get('/artisan2/{command}/{param}', [App\Http\Controllers\ProgrammesController::class, 'Artisan2']);
