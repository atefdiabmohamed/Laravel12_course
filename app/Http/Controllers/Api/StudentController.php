<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateStudentRequest;
use App\Models\countries;
use App\Models\Students;
use App\Models\User;
use App\Notifications\CreateStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneralTraits;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use  Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index()
    {

        $data = Students::paginate(4);
        if (!empty($data)) {
            foreach ($data as $info) {
                $info->country_name = countries::where('id', '=', $info->country_id)->value('name');
            }
        }
        return response()->json([
            'status' => true,
            'data' => $data

        ], 200);
    }


    public function store(CreateStudentRequest $request)
    {
        try {
            //كود ممكن يتنفذ
            //هنا بنقول ابدا معيا معاملة جديدة
            DB::beginTransaction();
            $counter = Students::where('name', '=', $request->name)->count();
            if ($counter > 0) {

                return response()->json([
                    'status' => false,
                    'message' => 'الاسم مسجل من قبل'

                ], 422);
            }
            $student = new Students();
            $student->name = $request->name;
            $student->country_id  = $request->country_id;
            $student->phones  = $request->phones;
            $student->nationalID  = $request->nationalID;
            $student->address  = $request->address;
            $student->notes  = $request->notes;
            $student->active = $request->active;
            $student->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => '  تم تسجيل البيانات بنجاح ',
                'data' => $student

            ], 201);
        } catch (\Exception $ex) {
            //كود يتنفذ لما يحصل  خطأ او ايرور
            //تراجع عن كل العملية
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => '   عفوا حديث خطأ ما ',
                'error' => $ex->getMessage()

            ], 500);
        }
    }

    public function update($id, CreateStudentRequest $request)
    {
        $dataStudents = Students::find($id);
        if (empty($dataStudents)) {

            return response()->json([
                'status' => false,
                'message' => 'عفوا غير قادر للوصول لبيانات الطالب '

            ], 404);
        }
        $dataStudents->name = $request->name;
        $dataStudents->country_id  = $request->country_id;
        $dataStudents->phones  = $request->phones;
        $dataStudents->nationalID  = $request->nationalID;
        $dataStudents->address  = $request->address;
        $dataStudents->notes  = $request->notes;
        $dataStudents->active = $request->active;

        $dataStudents->save();

        return response()->json([
            'status' => true,
            'message' => '   تم تحديث البيانات ',
            'data' => $dataStudents

        ], 200);
    }

    public function destroy($id)
    {
        $dataStudents = Students::find($id);
        if (empty($dataStudents)) {

            return response()->json([
                'status' => false,
                'message' => 'عفوا غير قادر للوصول لبيانات الطالب '

            ], 404);
        }
        $dataStudents->delete();
        return response()->json([
            'status' => true,
            'message' => '   تم حذف البيانات ',
            'data' => $dataStudents

        ], 200);
    }
}
