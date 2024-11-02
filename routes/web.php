<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ActivityController; // Assuming you have an ActivityController




// Dashboard route
Route::get('/', function () {
    return view('dashboard'); // Assuming you have a dashboard view
})->name('dashboard');

// Resource routes for various entities
Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('attendance', AttendanceController::class);
Route::resource('exams', ExamController::class);
Route::resource('fees', FeeController::class);
Route::resource('SchoolClasses', SchoolClassController::class);

// Recent Activities route (if you have a dedicated view)
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

// Additional routes can be defined as needed
