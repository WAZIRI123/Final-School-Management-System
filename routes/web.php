<?php

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
    Route::middleware(['auth','verified'])->group(function () {
        //? Route for dashboard page
        Route::prefix('/dashboard')->namespace('Dashboard')->name('dashboard.')->group(function () {
                // livewire crud-generator Tall
                Route::get('/tall-crud-generator', TallCrud::class)->name('tall-crud-generator')->middleware('role:Admin');
                //? Displays data statistics and to set up page about
                Route::get('/', Index::class)->name('index');

                // for  School
                Route::prefix('/school')->namespace('School')->name('schools.')->group(function () {
                    Route::get('/', Index::class)->name('index');
                });
                // for  Student
                Route::prefix('/student')->namespace('Student')->name('students.')->group(function () {
                    Route::get('/', Index::class)->name('index');
                });

                // for car reservation dashboard
                // Route::prefix('/car-reservation')->namespace('CarReservation')->name('car-reservations.')->group(function () {
                //     Route::get('/', Index::class)->name('index');
                // });
                // for package reservation dashboard
                // Route::prefix('/package-reservation')->namespace('PackageReservation')->name('package-reservations.')->group(function () {
                //     Route::get('/', Index::class)->name('index');
                // });
                // for transfer reservation dashboard
                // Route::prefix('/transfer-reservation')->namespace('TransferReservation')->name('transfer-reservations.')->group(function () {
                //     Route::get('/', Index::class)->name('index');
                // });
            });
            //? Route for user dashboard page
            // Route::prefix('/user')->namespace('User')->middleware('role:user')->name('user.')->group(function () {
            //     //? Displays data statistics
            //     Route::get('/', Index::class)->name('index');
            //     // for package activity dashboard
            //     Route::prefix('/reservation')->namespace('Reservation')->name('reservations.')->group(function () {
            //         Route::get('/', Index::class)->name('index');
            //     });
            //     // for car reservation dashboard
            //     Route::prefix('/car-reservation')->namespace('CarReservation')->name('car-reservations.')->group(function () {
            //         Route::get('/', Index::class)->name('index');
            //     });
            //     // for package reservation dashboard
            //     Route::prefix('/package-reservation')->namespace('PackageReservation')->name('package-reservations.')->group(function () {
            //         Route::get('/', Index::class)->name('index');
            //     });
            //     // for transfer reservation dashboard
            //     Route::prefix('/transfer-reservation')->namespace('TransferReservation')->name('transfer-reservations.')->group(function () {
            //         Route::get('/', Index::class)->name('index');
            //     });
            // });
        });
    });
    //? Routes that can be accessed by logging in or without logging in
    // Route::get('/', Index::class)->name('index');
    // Route::prefix('/activities')->namespace('Activity')->name('activities.')->group(function () {
    //     Route::get('/show', Show::class)->name('show');
    //     Route::get('/{activity:slug}', Index::class)->name('index');
    // });
    // // packages
    // Route::prefix('/packagies')->namespace('Package')->name('packagies.')->group(function () {
    //     Route::get('/show', Show::class)->name('show');
    //     Route::get('/{package:slug}', Index::class)->name('index');
    // });

    // // cars
    // Route::prefix('/cars')->namespace('Car')->name('cars.')->group(function () {
    //     Route::get('/show', Show::class)->name('show');
    //     Route::get('/{car:slug}', Index::class)->name('index');
    // });
    // // transfers
    // Route::prefix('/transfers')->namespace('Transfer')->name('transfers.')->group(function () {
    //     Route::get('/{transfer:slug}', Index::class)->name('index');
    // });


require __DIR__ . '/auth.php';
