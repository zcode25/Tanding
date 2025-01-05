<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\Superadmin\AdminController as SuperadminAdminController;
use App\Http\Controllers\Superadmin\EventController as SuperadminEventController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(LandingController::class)->group(function() {
    Route::get('/', 'index')->name('landing')->middleware('guest');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login/authenticate', 'authenticate')->name('login.authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(RegisterController::class)->group(function() {
    Route::get('/register', 'index')->name('register')->middleware('guest');
    Route::post('/register/store', 'store')->name('store')->middleware('guest');
});

Route::controller(SuperadminDashboardController::class)->group(function() {
    Route::get('/superadminDashboard', 'index')->name('superadminDashboard')->middleware(['auth', 'CheckRole:Superadmin']);
});

Route::controller(SuperadminAdminController::class)->group(function() {
    Route::get('/superadminAdmin', 'index')->name('superadminAdmin')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminAdmin/create', 'create')->name('superadminAdmin.create')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminAdmin/store', 'store')->name('superadminAdmin.store')->middleware(['auth', 'CheckRole:Superadmin']); 
    Route::get('/superadminAdmin/edit/{user:id}', 'edit')->name('superadminAdmin.edit')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminAdmin/update/{user:id}', 'update')->name('superadminAdmin.update')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::delete('/superadminAdmin/destroy/{user:id}', 'destroy')->name('superadminAdmin.destroy')->middleware(['auth', 'CheckRole:Superadmin']);
});


Route::controller(SuperadminEventController::class)->group(function() {
    Route::get('/superadminEvent', 'index')->name('superadminEvent')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminEvent/create', 'create')->name('superadminEvent.create')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminEvent/store', 'store')->name('superadminEvent.store')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminEvent/edit/{event:event_id}', 'edit')->name('superadminEvent.edit')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminEvent/update/{event:event_id}', 'update')->name('superadminEvent.update')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminEvent/detail/{event:event_id}', 'detail')->name('superadminEvent.detail')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminEvent/admin/store', 'adminStore')->name('superadminEvent.adminStore')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::delete('/superadminEvent/admin/destroy/{administrator:administrator_id}', 'adminDestroy')->name('superadminEvent.adminDestroy')->middleware(['auth', 'CheckRole:Superadmin']);
});

Route::controller(AdminDashboardController::class)->group(function() {
    Route::get('/adminDashboard', 'index')->name('adminDashboard')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminEventController::class)->group(function() {
    Route::get('/adminEvent', 'index')->name('adminEvent')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/detail/{event:event_id}', 'detail')->name('adminEvent.detail')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/information/{event:event_id}', 'information')->name('adminEvent.information')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminEvent/information/store', 'informationStore')->name('adminEvent.information.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminEvent/banner/store', 'bannerStore')->name('adminEvent.banner.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminEvent/banner/destroy/{banner:banner_id}', 'bannerDestroy')->name('adminEvent.banner.destroy')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/document/{event:event_id}', 'document')->name('adminEvent.document')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminEvent/document/store', 'documentStore')->name('adminEvent.document.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminEvent/document/destroy/{document:document_id}', 'documentDestroy')->name('adminEvent.document.destroy')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/competition/{event:event_id}', 'competition')->name('adminEvent.competition')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminEvent/competition/store', 'competitionStore')->name('adminEvent.competition.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminEvent/competition/destroy/{competition:competition_id}', 'competitionDestroy')->name('adminEvent.competition.destroy')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminDashboardController::class)->group(function() {
    Route::get('/adminDashboard', 'index')->name('adminDashboard')->middleware(['auth', 'CheckRole:Admin']);
});
