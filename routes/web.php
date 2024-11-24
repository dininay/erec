<?php

use App\Http\Controllers\ApplyController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\JobLevelController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\PeopleAnswerController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegistJobController;
use App\Http\Controllers\ResultTestController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\QuestionEssayController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WorkLocController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/job', [WelcomeController::class, 'indexjob'])->name('job');
Route::get('/job/{reg_code}', [WelcomeController::class, 'indexjobdetail'])->name('jobdetail');
Route::get('/profil', [WelcomeController::class, 'indexprofil'])->name('profil');
Route::get('/applyjob/{reg_code}', [ApplyController::class, 'applyjob'])->name('applyjob');
Route::post('/submit-apply', [ApplyController::class, 'submitApply'])->name('submitapply');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/search-jobs', [RegistJobController::class, 'searchJobs'])->name('search.jobs');

Route::get('/dashboard-crew', function () {
    return view('dashboard-crew');
})->middleware(['auth', 'verified'])->name('dashboard-crew');

Route::get('/dashboard-crew', [DashboardController::class, 'index'])->name('dashboard-crew');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        // Master Data
        Route::resource('category', CategoryController::class)->middleware('role:HR');
        Route::resource('jobtype', JobTypeController::class)->middleware('role:HR');
        Route::resource('joblevel', JobLevelController::class)->middleware('role:HR');
        Route::resource('workloc', WorkLocController::class)->middleware('role:HR');
        Route::resource('people', PeopleController::class)->middleware('role:HR');
        Route::resource('division', DivisionController::class)->middleware('role:HR');
        Route::resource('dept', DeptController::class)->middleware('role:HR');
        Route::resource('job', RegistJobController::class)->middleware('role:HR');
        Route::resource('apply', ApplyController::class)->middleware('role:HR');
        Route::resource('user', UserController::class)->middleware('role:HR');
        Route::get('user/{id}/reset', [UserController::class, 'reset'])->name('user.reset');
        Route::put('user/{id}', [UserController::class, 'ubah'])->name('user.ubah');

        Route::prefix('approval')->name('approval.')->group(function () {
            // Rute untuk 'administration'
            Route::get('administration', [StatusController::class, 'indexadmin'])->name('administration.index');
            Route::get('administration/create', [StatusController::class, 'create'])->name('administration.create');
            Route::post('administration', [StatusController::class, 'store'])->name('administration.store');
            Route::get('administration/{id}', [StatusController::class, 'showadmin'])->name('administration.show');
            Route::get('administration/{people_status_id}/edit', [StatusController::class, 'editadmin'])->name('administration.edit');
            Route::put('administration/{people_status_id}', [StatusController::class, 'updateadmin'])->name('administration.update');
            Route::delete('administration/{id}', [StatusController::class, 'destroyadmin'])->name('administration.destroy');

            // Rute untuk 'interview'
            Route::get('interview', [StatusController::class, 'indexinterview'])->name('interview.index');
            Route::get('interview/create', [StatusController::class, 'create'])->name('interview.create');
            Route::post('interview', [StatusController::class, 'store'])->name('interview.store');
            Route::get('interview/{id}', [StatusController::class, 'showinterview'])->name('interview.show');
            Route::get('interview/{people_status_id}/edit', [StatusController::class, 'editinterview'])->name('interview.edit');
            Route::put('interview/{people_status_id}', [StatusController::class, 'updateinterview'])->name('interview.update');
            Route::delete('interview/{id}', [StatusController::class, 'destroyinterview'])->name('interview.destroy');

            // Rute untuk 'docclear'
            Route::get('docclear', [StatusController::class, 'indexdocclear'])->name('docclear.index');
            Route::get('docclear/create', [StatusController::class, 'create'])->name('docclear.create');
            Route::post('docclear', [StatusController::class, 'store'])->name('docclear.store');
            Route::get('docclear/{id}', [StatusController::class, 'showdocclear'])->name('docclear.show');
            Route::get('docclear/{people_status_id}/edit', [StatusController::class, 'editdocclear'])->name('docclear.edit');
            Route::put('docclear/{people_status_id}', [StatusController::class, 'updatedocclear'])->name('docclear.update');
            Route::delete('docclear/{id}', [StatusController::class, 'destroydocclear'])->name('docclear.destroy');

            // Rute untuk 'oje'
            Route::get('oje', [StatusController::class, 'indexoje'])->name('oje.index');
            Route::get('oje/create', [StatusController::class, 'create'])->name('oje.create');
            Route::post('oje', [StatusController::class, 'store'])->name('oje.store');
            Route::get('oje/{id}', [StatusController::class, 'showoje'])->name('oje.show');
            Route::get('oje/{people_status_id}/edit', [StatusController::class, 'editoje'])->name('oje.edit');
            Route::put('oje/{people_status_id}', [StatusController::class, 'updateoje'])->name('oje.update');
            Route::delete('oje/{id}', [StatusController::class, 'destroyoje'])->name('oje.destroy');

            // Rute untuk 'onboarding'
            Route::get('onboarding', [StatusController::class, 'indexonboarding'])->name('onboarding.index');
            Route::get('onboarding/create', [StatusController::class, 'create'])->name('onboarding.create');
            Route::post('onboarding', [StatusController::class, 'store'])->name('onboarding.store');
            Route::get('onboarding/{id}', [StatusController::class, 'showonboarding'])->name('onboarding.show');
            Route::get('onboarding/{people_status_id}/edit', [StatusController::class, 'editonboarding'])->name('onboarding.edit');
            Route::put('onboarding/{people_status_id}', [StatusController::class, 'updateonboarding'])->name('onboarding.update');
            Route::delete('onboarding/{id}', [StatusController::class, 'destroyonboarding'])->name('onboarding.destroy');
        });

        // Course
        Route::resource('course', CoursesController::class)->middleware('role:HR');

        // Route::get('course', [CoursesController::class, 'showessay'])
        //     ->middleware('role:HR')->name('course.showessay');

        // Question
        Route::get('/course/question/create/{course}', [QuestionController::class, 'create'])
            ->middleware('role:HR')->name('course.create.question');

        Route::post('/course/question/save/{course}', [QuestionController::class, 'store'])
            ->middleware('role:HR')->name('course.create.question.store');

        Route::get('/course/question/createessay/{course}', [QuestionEssayController::class, 'createessay'])
            ->middleware('role:HR')->name('course.create.questionessay');

        Route::post('/course/question/saveessay/{course}', [QuestionEssayController::class, 'storeessay'])
            ->middleware('role:HR')->name('course.create.question.storeessay'); 

        Route::resource('question', QuestionController::class)->middleware('role:HR');
        Route::resource('questionessay', QuestionEssayController::class)->middleware('role:HR');

        // People
        Route::get('/course/people/show/{course}', [PeopleController::class, 'index'])
            ->middleware('role:HR')->name('course.people.index');

        Route::post('/course/people/save/{course}', [PeopleController::class, 'store'])
            ->middleware('role:HR')->name('course.people.store');

        Route::get('/course/people/create/{course}', [PeopleController::class, 'create'])
            ->middleware('role:HR')->name('course.people.create');


        // Applied Job Crew
        Route::get('/statusapply', [ApplyController::class, 'index'])
            ->middleware('role:Crew')->name('statusapply.index');

        Route::get('/statusapply/edit/{apply}', [ApplyController::class, 'edit'])
            ->middleware('role:Crew')->name('statusapply.edit');

        Route::get('/statusapply/show/{apply}', [ApplyController::class, 'show'])
            ->middleware('role:Crew')->name('statusapply.show');

        // Learning
        Route::get('/learning/finished/{course}', [LearningController::class, 'learning_finished'])
            ->middleware('role:Crew')->name('learning.finished.course');

        Route::get('/learning/rapport/{course}', [LearningController::class, 'learning_rapport'])
            ->middleware('role:Crew')->name('learning.rapport.course');

        Route::get('/learning', [LearningController::class, 'index'])
            ->middleware('role:Crew')->name('learning.index');
            
        Route::get('/learning/{course}/{question}', [LearningController::class, 'learning'])
            ->middleware('role:Crew')->name('learning.course');

        Route::post('/learning/{course}/{question}', [PeopleAnswerController::class, 'store'])
            ->middleware('role:Crew')->name('learning.course.answer.store');

        Route::post('/learning/{course}/{question}', [PeopleAnswerController::class, 'storeessay'])
            ->middleware('role:Crew')->name('learning.course.answer.storeessay');
    });
});

require __DIR__ . '/auth.php';
