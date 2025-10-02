<?php

use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StundetController;
use App\Http\Controllers\Training_coursesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomController;
use App\Models\Flight;
use App\Models\Training_courses;
use Illuminate\Support\Facades\Route;


Route::get('dashboard',function(){
    return "welcome Atef From Wep route file";
})->middleware(['throttle:lmit5']);

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('ar',function(){
session()->put('locale','ar');
return redirect()->back();
})->name('ar');

Route::get('en',function(){
session()->put('locale','en');
return redirect()->back();
})->name('en');

Route::get('yourname/{name}',function($name){
    return "welcome"." ".$name;
});

Route::get('yourname/{name?}',function($name="atef"){
    return "welcome"." ".$name;
})->middleware('PoliceMan');

Route::get('login',function(){
    return view('login',['name'=>'atef']);
});
Route::get('getlogin',[LoginController::class,'getlogin']);

Route::get('page1',function(){
    return view('page1');
});

Route::get('article',function(){
    return view('article');
});
Route::get('flights',[FlightsController::class,'index'])->name('flights');
Route::get('create_flights',[FlightsController::class,'create'])->name('create_flights');
Route::post('store_flight',[FlightsController::class,'store'])->name('store_flight');
Route::get('edit_flights/{id}',[FlightsController::class,'edit'])->name('edit_flights');
Route::post('update_flights/{id}',[FlightsController::class,'update_flights'])->name('update_flights');
Route::get('delete_flights/{id}',[FlightsController::class,'delete_flights'])->name('delete_flights');
Route::get('delete_soft/{id}',[FlightsController::class,'delete_soft'])->name('delete_soft');
Route::get('restore/{id}',[FlightsController::class,'restore'])->name('restore');
//start courses
Route::get('courses',[CoursesController::class,'index'])->name('courses.index');
Route::get('create_courses',[CoursesController::class,'create'])->name('courses.create');
Route::post('store_courses',[CoursesController::class,'store'])->name('courses.store');
Route::get('edit_courses/{id}',[CoursesController::class,'edit'])->name('courses.edit');
Route::post('update_courses/{id}',[CoursesController::class,'update'])->name('courses.update');
Route::get('destroy_courses/{id}',[CoursesController::class,'destroy'])->name('courses.destroy');

//start Students
Route::get('student',[StundetController::class,'index'])->name('student.index');
Route::get('create_student',[StundetController::class,'create'])->name('student.create');
Route::post('store_student',[StundetController::class,'store'])->name('student.store');
Route::get('edit_student/{id}',[StundetController::class,'edit'])->name('student.edit');
Route::post('update_student/{id}',[StundetController::class,'update'])->name('student.update');
Route::get('destroy_student/{id}',[StundetController::class,'destroy'])->name('student.destroy');
Route::post('ajax_search_student',[StundetController::class,'ajax_search_student'])->name('student.ajax_search_student');
//start training_courses
Route::get('training_courses',[Training_coursesController::class,'index'])->name('training_courses.index');
Route::get('create_training_courses',[Training_coursesController::class,'create'])->name('training_courses.create');
Route::post('store_training_courses',[Training_coursesController::class,'store'])->name('training_courses.store');
Route::get('edit_training_courses/{id}',[Training_coursesController::class,'edit'])->name('training_courses.edit');
Route::post('update_training_courses/{id}',[Training_coursesController::class,'update'])->name('training_courses.update');
Route::get('destroy_training_courses/{id}',[Training_coursesController::class,'destroy'])->name('training_courses.destroy');
Route::get('details_training_courses/{id}',[Training_coursesController::class,'details'])->name('training_courses.details');
Route::get('AddStudentToTrainingCourses/{id}',[Training_coursesController::class,'AddStudentToTrainingCourses'])->name('training_courses.AddStudentToTrainingCourses');
Route::post('DOAddStudentToTrainingCourses/{id}',[Training_coursesController::class,'DOAddStudentToTrainingCourses'])->name('training_courses.DOAddStudentToTrainingCourses');
Route::get('DeleteStudentFromTrainingCourses/{id}',[Training_coursesController::class,'DeleteStudentFromTrainingCourses'])->name('training_courses.DeleteStudentFromTrainingCourses');

Route::resource('country', CountriesController::class);
Route::get('welcome',[WelcomController::class,'index']);
Route::get('myfacade',[WelcomController::class,'myfacade']);
Route::fallback(function(){
    return " not found";
});
