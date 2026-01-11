<?php

namespace App\Http\Controllers\Api;

use App\Models\Courses;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseValidationRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {

        $data = Courses::paginate(8);
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function store(CreateCourseValidationRequest $request)
    {


        $counter = Courses::where('name', '=', $request->name)->count();
        if ($counter > 0) {
            return response()->json([
                'status' => false,
                'message' => 'عفوا الاسم مسجل من قبل'

            ], 422);
        }
        $course = new Courses();
        $course->name = $request->name;
        $course->active = $request->active;
        $course->save();
        return response()->json([
            'status' => true,
            'message' => 'تم اضافة البيانات بنجاح',
            'data' => $course

        ], 201);
    }

    public function show($id)
    {
        $data = Courses::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'عفوا غير قادر للوصول للبيانات المطلوبة   '

            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $data

        ], 200);
    }
}
