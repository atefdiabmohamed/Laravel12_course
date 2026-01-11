<?php

use App\Http\Controllers\Api\CourseController;
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
// API Manual (للتوضيح والفهم فقط)
// هذا الأسلوب تعليمي وغير احترافي
// لاحقًا سنستخدم Route::apiResource() الاحترافي
// ================================
Route::get('courses', [CourseController::class, 'index']);
Route::post('courses_store', [CourseController::class, 'store']);
Route::get('courses_show/{id}', [CourseController::class, 'show']);






//ثانيا التلقائي
