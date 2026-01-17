<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentController;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//test
Route::get('/students_from_api', function () {

    return response()->json([
        'students' => Students::all()
    ]);
});
// ================================
//نتدرج بالشرح والامثلة وصولا الي الافضل
// API Manual (للتوضيح والفهم فقط)
// هذا الأسلوب تعليمي وغير احترافي
// لاحقًا سنستخدم Route::apiResource() الاحترافي
//سنشرح لاحقا  best practice laravel API
// ================================
Route::get('courses', [CourseController::class, 'index']);
Route::post('courses_store', [CourseController::class, 'store']);
Route::get('courses_show/{id}', [CourseController::class, 'show']);
Route::post('courses_update/{id}', [CourseController::class, 'update']);
Route::get('courses_destroy/{id}', [CourseController::class, 'destroy']);

//ثانيا التلقائي Route::apiResource() الاحترافي
//سنشرح هنا  best practice laravel API

Route::apiResource('students', StudentController::class);
