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
use App\Http\Controllers\Superadmin\AccountController as SuperadminAccountController;
use App\Http\Controllers\Superadmin\PaymentController as SuperadminPaymentController;
use App\Http\Controllers\Superadmin\ContingentController as SuperadminContingentController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\DrawController as AdminDrawController;
use App\Http\Controllers\Admin\MatchController as AdminMatchController;
use App\Http\Controllers\Admin\MedalController as AdminMedalController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\ContingentController as AdminContingentController;
use App\Http\Controllers\Admin\ParticipantController as AdminParticipantController;
use App\Http\Controllers\Admin\BracketController as AdminBracketController;

// User
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ContingentController as UserContingentController;
use App\Http\Controllers\User\AthleteController as UserAthleteController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\User\AccountController as UserAccountController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(LandingController::class)->group(function() {
    Route::get('/', 'index')->name('landing')->middleware('guest');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'index')->middleware('role.redirect')->name('login');
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
    Route::post('/superadminAdmin/reset-password/{user:id}', 'resetPassword')->name('superadminAdmin.resetPassword')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminAdmin/update/{user:id}', 'update')->name('superadminAdmin.update')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::delete('/superadminAdmin/destroy/{user:id}', 'destroy')->name('superadminAdmin.destroy')->middleware(['auth', 'CheckRole:Superadmin']);
});


Route::controller(SuperadminAccountController::class)->group(function() {
    Route::get('/superadminAccount/{user:id}', 'index')->name('superadminAccount')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminAccount/update/{user:id}', 'update')->name('superadminAccount.update')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminAccount/reset-password/{user:id}', 'resetPassword')->name('superadminAccount.resetPassword')->middleware(['auth', 'CheckRole:Superadmin']);
});

Route::controller(SuperAdminContingentController::class)->group(function() {
    Route::get('/superadminContingent', 'index')->name('superadminContingent')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminContingent/detail/{contingent:contingent_id}', 'detail')->name('superadminContingent')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminContingent/export/{contingent:contingent_id}', 'export')->name('superadminContingent')->middleware(['auth', 'CheckRole:Superadmin']);
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

Route::controller(SuperadminPaymentController::class)->group(function() {
    Route::get('/superadminPayment', 'index')->name('superadminPayment')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminPayment/create', 'create')->name('superadminPayment.create')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminPayment/store', 'store')->name('superadminPayment.store')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::get('/superadminPayment/edit/{paymentmethod:paymentmethod_id}', 'edit')->name('superadminPayment.edit')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::post('/superadminPayment/update/{paymentmethod:paymentmethod_id}', 'update')->name('superadminPayment.update')->middleware(['auth', 'CheckRole:Superadmin']);
    Route::delete('/superadminPayment/destroy/{paymentmethod:paymentmethod_id}', 'destroy')->name('superadminPayment.destroy')->middleware(['auth', 'CheckRole:Superadmin']);
});



// Admin
Route::controller(AdminDashboardController::class)->group(function() {
    Route::get('/adminDashboard', 'index')->name('adminDashboard')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminAccountController::class)->group(function() {
    Route::get('/adminAccount/{user:id}', 'index')->name('adminAccount')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminAccount/update/{user:id}', 'update')->name('adminAccount.update')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminAccount/reset-password/{user:id}', 'resetPassword')->name('adminAccount.resetPassword')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminContingentController::class)->group(function() {
    Route::get('/adminContingent', 'index')->name('adminContingent')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminContingent/detail/{contingent:contingent_id}', 'detail')->name('adminContingent')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminContingent/export/{contingent:contingent_id}', 'export')->name('adminContingent')->middleware(['auth', 'CheckRole:Admin']);
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

    Route::get('/adminEvent/category/{event:event_id}', 'category')->name('adminEvent.category')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/category/create/{event:event_id}', 'categoryCreate')->name('adminEvent.category.create')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminEvent/category/store', 'categoryStore')->name('adminEvent.category.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/category/edit/{category:category_id}', 'categoryEdit')->name('adminEvent.category.edit')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminEvent/category/update/{category:category_id}', 'categoryUpdate')->name('adminEvent.category.update')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminEvent/category/destroy/{category:category_id}', 'categoryDestroy')->name('adminEvent.category.destroy')->middleware(['auth', 'CheckRole:Admin']);

    Route::get('/adminEvent/age/{event:event_id}', 'age')->name('adminEvent.age')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/age/create/{event:event_id}', 'ageCreate')->name('adminEvent.age.create')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminEvent/age/store', 'ageStore')->name('adminEvent.age.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/age/edit/{age:age_id}', 'ageEdit')->name('adminEvent.age.edit')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminEvent/age/update/{age:age_id}', 'ageUpdate')->name('adminEvent.age.update')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminEvent/age/destroy/{age:age_id}', 'ageDestroy')->name('adminEvent.age.destroy')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminEvent/age/detail/{age:age_id}', 'ageDetail')->name('adminEvent.age.detail')->middleware(['auth', 'CheckRole:Admin']);

    Route::post('/adminEvent/class/store', 'classStore')->name('adminEvent.class.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminEvent/class/destroy/{matchclass:class_id}', 'classDestroy')->name('adminEvent.class.destroy')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminPaymentController::class)->group(function() {
    Route::get('/adminPayment/{event:event_id}', 'index')->name('adminPayment')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminPayment/detail/{payment:payment_id}', 'detail')->name('adminPayment.detail')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminPayment/invoice/{payment:payment_id}', 'invoice')->name('adminPayment.invoice')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminPayment/detail/store/{payment:payment_id}', 'store')->name('adminPayment.store')->middleware(['auth', 'CheckRole:Admin']);
});


Route::controller(AdminRegisterController::class)->group(function() {
    Route::get('/adminRegister/{event:event_id}', 'index')->name('adminRegister')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminRegister/detail/{competition:competition_id}', 'detail')->name('adminRegister.detail')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminRegister/export/{competition:competition_id}', 'export')->name('adminRegister.export')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminRegister/edit/{register:register_id}', 'edit')->name('adminRegister.edit')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminDrawController::class)->group(function() {
    Route::get('/adminDraw/{event:event_id}', 'index')->name('adminDraw')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminDraw/detail/{competition:competition_id}', 'detail')->name('adminDraw.detail')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminDraw/tanding/{competition:competition_id}', 'tanding')->name('adminDraw.tanding')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminDraw/tandingDraw/{competition}/{matchclass}', 'tandingDraw')->name('adminDraw.tandingDraw')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminDraw/tgrDraw/{competition:competition_id}', 'tgrDraw')->name('adminDraw.tgrDraw')->middleware(['auth', 'CheckRole:Admin']);

    Route::post('/adminDraw/draw/random', 'randomDraw')->name('draw.random')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminDraw/draw/save', 'saveDraw')->name('draw.save')->middleware(['auth', 'CheckRole:Admin']);

    Route::get('/adminDraw/draw/tandingExport/{competition}/{matchclass}', 'tandingExportDraw')->name('draw.export.tanding')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminDraw/draw/tgrExport/{competition}', 'tgrExportDraw')->name('draw.export.tgr')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminParticipantController::class)->group(function() {
    Route::get('/adminParticipant/{event:event_id}', 'index')->name('adminParticipant')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminParticipant/detail/{competition:competition_id}', 'detail')->name('adminParticipant.detail')->middleware(['auth', 'CheckRole:Admin']);
    
    Route::get('/adminParticipant/participant/downloadTemplate', 'downloadTemplate')->name('adminParticipant.downloadTemplate')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminParticipant/participant/importTemplate', 'importTemplate')->name('adminParticipant.importTemplate')->middleware(['auth', 'CheckRole:Admin']);
    
    Route::get('/adminParticipant/tanding/{competition:competition_id}', 'tanding')->name('adminParticipant.tanding')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminParticipant/tandingParticipant/{competition}/{matchclass}', 'tandingParticipant')->name('adminParticipant.tandingParticipant')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminParticipant/tandingParticipant/store', 'tandingParticipantStore')->name('adminParticipant.tandingParticipant.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminParticipant/participant/destroy/{participant}', 'participantDestroy')->name('adminParticipant.tandingParticipant.destroy')->middleware(['auth', 'CheckRole:Admin']);

    Route::get('/adminParticipant/tgrParticipant/{competition}', 'tgrParticipant')->name('adminParticipant.tgrParticipant')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminParticipant/tgrParticipant/store', 'tgrParticipantStore')->name('adminParticipant.tgrParticipant.store')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminBracketController::class)->group(function() {
    Route::get('/adminBracket/{event:event_id}', 'index')->name('adminBracket')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminBracket/detail/{competition:competition_id}', 'detail')->name('adminBracket.detail')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminBracket/tanding/{competition}/{matchclass}', 'tanding')->name('adminBracket.tanding')->middleware(['auth', 'CheckRole:Admin']);

    Route::post('/adminBracket/bracket/store', 'store')->name('adminBracket.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminBracket/bracket/destroy/{bracket:bracket_id}', 'destroy')->name('adminBracket.destroy')->middleware(['auth', 'CheckRole:Admin']);

    Route::get('/adminBracket/bracket/participant/{bracket:bracket_id}', 'bracketParticipant')->name('adminBracket.participant')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminBracket/bracket/participant/store/{bracket:bracket_id}', 'bracketParticipantStore')->name('adminBracket.participant.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminBracket/bracket/participant/destroy/{bracketparticipant:bracketpart_id}', 'bracketParticipantDestroy')->name('adminBracket.participant.destroy')->middleware(['auth', 'CheckRole:Admin']);

    Route::get('/adminBracket/bracket/match/{bracket:bracket_id}', 'bracketMatch')->name('adminBracket.match')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminBracket/bracket/match/store/{bracket:bracket_id}', 'bracketMatchStore')->name('adminBracket.match.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminBracket/bracket/match/update/{bracketmatch:match_id}', 'bracketMatchUpdate')->name('adminBracket.match.update')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminBracket/bracket/match/destroy/{bracketmatch:match_id}', 'bracketMatchDestroy')->name('adminBracket.match.destroy')->middleware(['auth', 'CheckRole:Admin']);
});

Route::controller(AdminMatchController::class)->group(function() {
    Route::get('/adminMatch/{event:event_id}', 'index')->name('adminMatch')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminMatch/detail/{competition:competition_id}', 'detail')->name('adminMatch.detail')->middleware(['auth', 'CheckRole:Admin']);
    
    Route::get('/adminMatch/tanding/{register:register_id}', 'tanding')->name('adminMatch.tanding')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminMatch/tandingMatch/{register:register_id}', 'tandingMatch')->name('adminMatch.tandingMatch')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminMatch/tandingMatch/store', 'tandingMatchStore')->name('adminMatch.tandingMatch.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminMatch/tandingMatch/update/{matchtanding:matchtanding_id}', 'tandingMatchUpdate')->name('adminMatch.tandingMatch.update')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminMatch/tandingMatch/destroy/{matchtanding:matchtanding_id}', 'tandingMatchDestroy')->name('adminMatch.tandingMatch.destroy')->middleware(['auth', 'CheckRole:Admin']);
    

    Route::get('/adminMatch/tgrMatch/{competition:competition_id}', 'tgrMatch')->name('adminMatch.tgrMatch')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminMatch/tgrMatch/store', 'tgrMatchStore')->name('adminMatch.tgrMatch.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::post('/adminMatch/tgrMatch/update/{matchtgr:matchtgr_id}', 'tgrMatchUpdate')->name('adminMatch.tgrMatch.update')->middleware(['auth', 'CheckRole:Admin']);
    
    Route::delete('/adminMatch/tgrMatch/destroy/{matchtgr:matchtgr_id}', 'tgrMatchDestroy')->name('adminMatch.tgrMatch.destroy')->middleware(['auth', 'CheckRole:Admin']);
});


Route::controller(AdminMedalController::class)->group(function() {
    Route::get('/adminMedal/{event:event_id}', 'index')->name('adminMedal')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminRecap/{event:event_id}', 'indexRecap')->name('adminRecap')->middleware(['auth', 'CheckRole:Admin']);


    Route::get('/adminMedal/detail/{competition:competition_id}', 'detail')->name('adminMedal.detail')->middleware(['auth', 'CheckRole:Admin']);
    
    Route::get('/adminMedal/tanding/{competition:competition_id}', 'tanding')->name('adminMedal.tanding')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminMedal/tandingMedal/{competition}/{matchclass}', 'tandingMedal')->name('adminMedal.tandingMedal')->middleware(['auth', 'CheckRole:Admin']);
    Route::get('/adminMedal/medal/participant/{bracket:bracket_id}', 'tandingMedalParticipant')->name('adminMedal.tandingMedalParticipant')->middleware(['auth', 'CheckRole:Admin']);

    Route::post('/adminMedal/tandingMedal/store', 'tandingMedalStore')->name('adminMedal.tandingMedal.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminMedal/tandingMedal/destroy/{medal:medal_id}', 'tandingMedalDestroy')->name('adminMatch.tandingMatch.destroy')->middleware(['auth', 'CheckRole:Admin']);

    Route::get('/adminMedal/tgrMedal/{competition:competition_id}', 'tgrMedal')->name('adminMedal.tgrMedal')->middleware(['auth', 'CheckRole:Admin']);
    
    Route::post('/adminMedal/medal/store', 'medalStore')->name('adminMedal.medal.store')->middleware(['auth', 'CheckRole:Admin']);
    Route::delete('/adminMedal/medal/destroy/{medal:medal_id}', 'medalDestroy')->name('adminMatch.match.destroy')->middleware(['auth', 'CheckRole:Admin']);
});


// User
Route::controller(UserDashboardController::class)->group(function() {
    Route::get('/userDashboard', 'index')->name('userDashboard')->middleware(['auth', 'CheckRole:User']);
});

Route::controller(UserContingentController::class)->group(function() {
    Route::get('/userContingent', 'index')->name('userContingent')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userContingent/update/{contingent:contingent_id}', 'update')->name('userContingent.update')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userContingent/user/update/{user:id}', 'updateUser')->name('userContingent.updateUser')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userContingent/user/reset-password/{user:id}', 'resetPassword')->name('userAccount.resetPassword')->middleware(['auth', 'CheckRole:User']);
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
    Route::delete('/userEvent/register/destroy/{register:register_id}', 'registerDestroy')->name('userEvent.registerDestroy')->middleware(['auth', 'CheckRole:User']);
    Route::get('/userEvent/register/payment/{event:event_id}', 'registerPayment')->name('userEvent.registerPayment')->middleware(['auth', 'CheckRole:User']);
    Route::get('/userEvent/register/payment/invoice/{event:event_id}', 'registerPaymentInvoice')->name('userEvent.registerPaymentInvoice')->middleware(['auth', 'CheckRole:User']);
    Route::post('/userEvent/register/payment/store/{event:event_id}', 'registerPaymentStore')->name('userEvent.registerPaymentStore')->middleware(['auth', 'CheckRole:User']);
    

    Route::get('/ages/{category:category_id}', 'getAges')->middleware(['auth', 'CheckRole:User']);
    Route::get('/classes/{age:age_id}', 'getClasses')->middleware(['auth', 'CheckRole:User']);
    Route::get('/get-category-amount/{category_id}', 'getCategoryAmount')->middleware(['auth', 'CheckRole:User']);
});