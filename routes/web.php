<?php

use App\Models\ExamSlot;
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

Route::get('/', function () {

    return view('welcome');
});
Route::namespace('App\Http\Livewire')->group(function () {

    //? Routes that can be accessed only when logging in
    Route::middleware(['auth', 'verified'])->group(function () {

        //? Route for dashboard page
        Route::prefix('/dashboard')->namespace('Dashboard')->name('dashboard.')->group(function () {

            // livewire crud-generator Tall
            Route::get('/tall-crud-generator', TallCrud::class)->name('tall-crud-generator')->middleware('role:Admin');
            Route::get('/profile', Profile::class)->name('profile');

            // for  School
            Route::prefix('/school')->namespace('School')->name('schools.')->group(function () {
                Route::get('/', Index::class)->name('index');
            });

            //super admin must have school id set
            Route::middleware(['App\Http\Middleware\EnsureSuperAdminHasSchoolId'])->group(function () {
                //? Displays data statistics and to set up page about
                Route::get('/', Index::class)->name('index');

                // for  School
                Route::prefix('/school')->namespace('School')->name('schools.')->group(function () {
                    //manage school settings
                    Route::get('/setting-school', SettingSchool::class)->name('settings-school');
                });

                // for  students group
                Route::prefix('/students')->group(function () {

                    // for  Student
                    Route::prefix('/student')->namespace('Student')->name('students.')->group(function () {

                        Route::get('/', Index::class)->name('index');
                    });
                    // for  promote student
                    Route::prefix('/promote')->namespace('PromoteStudent')->name('promote-students.')->group(function () {

                        Route::get('/', Index::class)->name('index');

                        Route::get('/promotions', Promotion::class)->name('promotion');
                    });

                    // for  graduate student
                    Route::prefix('/graduate')->namespace('StudentGraduate')->name('graduate-students.')->group(function () {

                        Route::get('/', Index::class)->name('index');

                        Route::get('/Manage graduations', ManageGraduation::class)->name('graduations');
                    });
                });


                // for  Parent
                Route::prefix('/parent')->namespace('Parent')->name('parents.')->group(function () {

                    Route::get('/', Index::class)->name('index');
                });

                // for  Teacher
                Route::prefix('/teacher')->namespace('Teacher')->name('teachers.')->group(function () {

                    Route::get('/', Index::class)->name('index');
                });
                // for  Classes
                Route::prefix('/class')->namespace('Classes')->name('classes.')->group(function () {

                    Route::get('/', Index::class)->name('index');
                });

                // for  Academics group
                Route::prefix('/academic')->group(function () {

                    // for  subject
                    Route::prefix('/subject')->namespace('Subject')->name('subjects.')->group(function () {

                        Route::get('/', Index::class)->name('index');
                    });

                    // for  Academic
                    Route::prefix('/academic-year')->namespace('AcademicYear')->name('academic-years.')->group(function () {

                        Route::get('/', Index::class)->name('index');
                    });

                    // for  Semester
                    Route::prefix('/semester')->namespace('Semester')->name('semesters.')->group(function () {

                        Route::get('/', Index::class)->name('index');
                    });
                });

                // for  Semester
                Route::prefix('/time-table')->namespace('TimeTable')->name('time-tables.')->group(function () {

                    Route::get('/create-timetable', Index::class)->name('index');

                    Route::get('/timetable-slot-record',ManageTimeTableRecordSlot::class)->name('timetable-record-slot');

                    Route::get('/manage-timetable-record', ManageTimeTableRecord::class)->name('manage-timetable-record');
                });

                // for  Semester
                Route::prefix('/exam')->namespace('Exam')->name('exams.')->group(function () {

                    Route::get('/exam-crud', Index::class)->name('index');
                   


                     Route::namespace('Marking')->name('marking.')->group(function () {
                     Route::get('/mark-exam', MarkExam::class)->name('mark-exam');
                     Route::get('/manage-exam-mark', ManageExamMark::class)->name('manage-exam-mark');
                     Route::get('/manage-exam-mark-child', ManageExamMarkChild::class)->name('manage-exam-mark-child');
                     });

                     
                     Route::namespace('Result')->name('result.')->group(function () {
                        Route::get('/results', Index::class)->name('index');
                        Route::get('/result-pdf', ResultPdf::class)->name('result-pdf');
                        });

                });

            });
        });
    });
});



require __DIR__ . '/auth.php';
