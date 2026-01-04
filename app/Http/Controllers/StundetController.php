<?php

namespace App\Http\Controllers;

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



class StundetController extends Controller
{
    use GeneralTraits;
    public function index()
    {



        $data = Students::paginate(4);
        if (!empty($data)) {
            foreach ($data as $info) {
                $info->country_name = countries::where('id', '=', $info->country_id)->value('name');
            }
        }
        return view('students.index', ['data' => $data]);
    }


    public function create()
    {

        $countries = countries::select("id", "name")->where("active", 1)->get();
        return view('students.create', ['countries' => $countries]);
    }

    public function store(CreateStudentRequest $request)
    {
        try {
            //كود ممكن يتنفذ
            //هنا بنقول ابدا معيا معاملة جديدة
            DB::beginTransaction();
            $counter = Students::where('name', '=', $request->name)->count();
            if ($counter > 0) {
                return redirect()->back()->with(['error' => 'عفوا الاسم مسجل من قبل'])->withInput();
            }
            $student = new Students();
            $student->name = $request->name;
            $student->country_id  = $request->country_id;
            $student->phones  = $request->phones;
            $student->nationalID  = $request->nationalID;
            $student->address  = $request->address;
            $student->notes  = $request->notes;
            $student->active = $request->active;
            /* هنا حنشرح شوية امثله علي دوال الملفات */
            //$request->photo;
            // $request->file('photo');

            /*if ($request->hasFile('photo')) {
dd("بالفعل تم رفع ملف");

}
*/
            /*
$file=$request->file('photo');
if ($request->hasFile('photo')) {
if ($request->file('photo')->isValid()) {
return response()->json(
[
'orignal_name'=>$file->getClientOriginalName(),
'extension'=>$file->getClientOriginalExtension(),
'size'=>$file->getSize(),
'path'=>$file->getRealPath()

]


);

}else{
return response()->json(
[
'error'=>'فشل رفع الملف ربما انقطاع الانترنت '

]);


}


    }

*/

            /*$path = $request->photo->store('images','public');
//$path = $request->photo->storeAs('images','testimage');
dd($path);
*/



            //upload image
            if ($request->has('photo')) {
                $image = $request->photo;
                $extension = strtolower($image->extension());
                $filenname = time() . rand(1, 1000) . "." . $extension;
                $image->move("uploads", $filenname);
                $student->image = $filenname;
            }

            $student->save();

            //ارسال اشعار لكل المستخدمين بالنظام
            $users = User::select("id")->get();
            $content = "تم اضافة طالب جديد باسم " . $request->name;
            Notification::send($users, new CreateStudent($request->name, $content));
            //هنا حنجرب مثلا ايرور مصطنع
            //  echo $x;
            //هنا اقول ابدا احفظ المعاملة طالما لايوجد اي مشكلة
            DB::commit();


            return redirect()->route('student.index')->with(['success' => 'تم اضافة البيانات بنجاح']);
        } catch (\Exception $ex) {
            //كود يتنفذ لما يحصل  خطأ او ايرور
            //تراجع عن كل العملية
            DB::rollBack();

            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما وهو' . $ex->getMessage()])->withInput();
        }
    }




    public function edit($id)
    {
        $data = Students::find($id);
        if (empty($data)) {
            return redirect()->route('student.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $countries = countries::select("id", "name")->where("active", 1)->get();

        return view('students.edit', ['data' => $data, 'countries' => $countries]);
    }
    public function update($id, CreateStudentRequest $request)
    {
        $dataStudents = Students::find($id);
        if (empty($dataStudents)) {
            return redirect()->route('student.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $dataStudents->name = $request->name;
        $dataStudents->country_id  = $request->country_id;
        $dataStudents->phones  = $request->phones;
        $dataStudents->nationalID  = $request->nationalID;
        $dataStudents->address  = $request->address;
        $dataStudents->notes  = $request->notes;
        $dataStudents->active = $request->active;

        if ($request->has('photo')) {
            $image = $request->photo;
            $extension = strtolower($image->extension());
            $filenname = time() . rand(1, 1000) . "." . $extension;
            $image->move("uploads", $filenname);
            $dataStudents->image = $filenname;
        }


        $dataStudents->save();
        return redirect()->route('student.index')->with(['success' => 'تم التحديث بنجاح']);
    }

    public function destroy($id)
    {
        $dataStudents = Students::find($id);
        if (empty($dataStudents)) {
            return redirect()->route('courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $dataStudents->delete();
        return redirect()->route('student.index')->with(['success' => 'تم الحذف بنجاح']);
    }

    public function ajax_search_student(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->name;
            $active = $request->active;
            if (empty($name)) {
                //اعمل شرط دائما يرجع قيمة  true
                $filed1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $filed1 = "name";
                $operator1 = "LIKE";
                $value1 = "%{$name}%";
            }
            if ($active == "all") {
                //اعمل شرط دائما يرجع قيمة  true
                $filed2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $filed2 = "active";
                $operator2 = "=";
                $value2 = $active;
            }

            $data = Students::where($filed1, $operator1, $value1)->where($filed2, $operator2, $value2)->paginate(1);
            if (!empty($data)) {
                foreach ($data as $info) {
                    $info->country_name = countries::where('id', '=', $info->country_id)->value('name');
                }
            }
            return view('students.ajax_search_student', ['data' => $data]);
        }
    }
}
