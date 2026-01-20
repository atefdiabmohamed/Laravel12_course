<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Models\Courses;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseValidationRequest;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {

        $data = Courses::paginate(8);
        /* اول مثال
          return response()->json([
            'status' => true,
            'data' =>  $data
        ], 200);
*/

        /* ثاني مثال

        return response()->json([
            'status' => true,
            'data' =>  CourseResource::collection($data)
        ], 200);
*/
        //هنا لو حنشغل علي توحيد شكل  الايبي اي
        //api schema ثالث مثال

        return  ApiResponse::send(200, true, '', CourseResource::collection($data));
    }

    public function store(CreateCourseValidationRequest $request)
    {


        $counter = Courses::where('name', '=', $request->name)->count();
        if ($counter > 0) {

            /*
            return response()->json([
                'status' => false,
                'message' => 'عفوا الاسم مسجل من قبل'

            ], 422);
  */

            //api schema ثالث مثال
            //حنرجع شكل موحد علي مستوي المشروع كامل
            return  ApiResponse::send(422, false, 'عفوا الاسم مسجل من قبل', '', 'عفوا الاسم مسجل من قبل');
        }
        $course = new Courses();
        $course->name = $request->name;
        $course->active = $request->active;
        $course->save();
        //اول مثال
        /*
        return response()->json([
            'status' => true,
            'message' => 'تم اضافة البيانات بنجاح',
            'data' => $course

        ], 201);

        */
        //api schema ثالث مثال
        //حنرجع شكل موحد علي مستوي المشروع كامل

        return  ApiResponse::send(201, true, 'تم اضافة البيانات بنجاح', $course);
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
            'data' => new CourseResource($data)

        ], 200);
    }


    public function update($id, CreateCourseValidationRequest $request)
    {
        $dataCourse = Courses::find($id);
        if (empty($dataCourse)) {
            return response()->json([
                'status' => false,
                'message' => 'عفوا غير قادر للوصول للبيانات المطلوبة   '

            ], 404);
        }
        $dataCourse['name'] = $request->name;
        $dataCourse['active'] = $request->active;
        $dataCourse->save();
        return response()->json([
            'status' => true,
            'message' => 'تم تحديث البيانات',
            'data' => $dataCourse

        ], 200);
    }

    public function destroy($id)
    {
        $dataCourse = Courses::find($id);

        if (empty($dataCourse)) {
            return response()->json([
                'status' => false,
                'message' => 'عفوا غير قادر للوصول للبيانات المطلوبة   '

            ], 404);
        }

        $dataCourse->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف البيانات'

        ], 200);
    }
}
