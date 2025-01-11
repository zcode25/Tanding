<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LandingController;
// Superadmin
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\Superadmin\AdminController as SuperadminAdminController;
use App\Http\Controllers\Superadmin\EventController as SuperadminEventController;
use App\Http\Controllers\Superadmin\CategoryController as SuperadminCategoryController;
use App\Http\Controllers\Superadmin\AgeController as SuperadminAgeController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

// User
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ContingentController as UserContingentController;
use App\Http\Controllers\User\AthleteController as UserAthleteController;
use App\Http\Controllers\User\EventController as UserEventController;

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


// Superadmin
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

Route::controller(SuperadminCategoryController::class)->group(function() {
    Route::get('/superadminCategory', 'index')->name('superadminCategory')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminCategory/create', 'create')->name('superadminCategory.create')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminCategory/store', 'store')->name('superadminCategory.store')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminCategory/edit/{category:category_id}', 'edit')->name('superadminCategory.edit')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminCategory/update/{category:category_id}', 'update')->name('superadminCategory.update')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::delete('/superadminCategory/destroy/{category:category_id}', 'destroy')->name('superadminCategory.destroy')->middleware(['auth', 'CheckRole:Superadmin']);
});

Route::controller(SuperadminAgeController::class)->group(function() {
    Route::get('/superadminAge', 'index')->name('superadminAge')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminAge/create', 'create')->name('superadminAge.create')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminAge/store', 'store')->name('superadminAge.store')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminAge/edit/{age:age_id}', 'edit')->name('superadminAge.edit')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminAge/update/{age:age_id}', 'update')->name('superadminAge.update')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::delete('/superadminAge/destroy/{age:age_id}', 'destroy')->name('superadminAge.destroy')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminAge/detail/{age:age_id}', 'detail')->name('superadminAge.detail')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminAge/class/store', 'classStore')->name('superadminAge.class.store')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::delete('/superadminAge/class/destroy/{matchclass:class_id}', 'classDestroy')->name('superadminAge.class.destroy')->middleware(['auth', 'CheckRole:Superadmin']);
});


// Admin
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


// User
Route::controller(UserDashboardController::class)->group(function() {
    Route::get('/userDashboard', 'index')->name('userDashboard')->middleware(['auth', 'CheckRole:User']);
});

Route::controller(UserContingentController::class)->group(function() {
    Route::get('/userContingent', 'index')->name('userContingent')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userContingent/update/{contingent:contingent_id}', 'update')->name('userContingent.update')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userContingent/user/update/{user:id}', 'updateUser')->name('userContingent.updateUser')->middleware(['auth', 'CheckRole:User']);
});

Route::controller(UserAthleteController::class)->group(function() {
    Route::get('/userAthlete', 'index')->name('userAthlete')->middleware(['auth', 'CheckRole:User']);
    Route::get('/userAthlete/create', 'create')->name('userAthlete.create')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userAthlete/store', 'store')->name('userAthlete.store')->middleware(['auth', 'CheckRole:User']);
    Route::get('/userAthlete/edit/{athlete:athlete_id}', 'edit')->name('userAthlete.edit')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userAthlete/update/{athlete:athlete_id}', 'update')->name('userAthlete.update')->middleware(['auth', 'CheckRole:User']);
    Route::delete('/userAthlete/destroy/{athlete:athlete_id}', 'destroy')->name('userAthlete.destroy')->middleware(['auth', 'CheckRole:User']);
    Route::get('/userAthlete/template', 'downloadTemplate')->name('userAthlete.template')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userAthlete/import', 'importAthletes')->name('userAthlete.import')->middleware(['auth', 'CheckRole:User']);
    
});

Route::controller(UserEventController::class)->group(function() {
    Route::get('/userEvent', 'index')->name('userEvent')->middleware(['auth', 'CheckRole:User']);
    Route::get('/userEvent/register/{event:event_id}', 'register')->name('userEvent.register')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userEvent/register/store', 'registerStore')->name('userEvent.registerStore')->middleware(['auth', 'CheckRole:User']);
    Route::get('/ages/{category:category_id}', 'getAges')->middleware(['auth', 'CheckRole:User']);
    Route::get('/classes/{age:age_id}', 'getClasses')->middleware(['auth', 'CheckRole:User']);
    Route::get('/get-category-amount/{category_id}', 'getCategoryAmount')->middleware(['auth', 'CheckRole:User']);
});