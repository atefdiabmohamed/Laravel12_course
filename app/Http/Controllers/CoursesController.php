<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseValidationRequest;
use Illuminate\Http\Request;
use App\Models\Courses;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Events\CourseAddEvent;

class CoursesController extends Controller
{
    public function index()
    {



        $data = Courses::paginate(8);
        return view('courses.index', ['data' => $data]);
    }

    public function create()
    {
        return view('courses.create');
    }
    public function store(CreateCourseValidationRequest $request)
    {

        //Accessing the Request Example
        //   return $name = $request->input('name');

        /*if ($request->has('name')) {

  dd('yes');

}
 */
        /*
if ($request->has(['name', 'active'])) {

  dd('yes');

}
*/
        /*
if ($request->hasAny(['name', 'email'])) {

  dd('yes');

}
*/
        /*
if ($request->filled('name')) {

  dd('yes');

}
  */
        /*if ($request->isNotFilled('email')) {

  dd('yes');

} */

        /*$originalData=$request->all();
  //دمج بيانات اضافية لو مش موجوده او استبدالها اذا موجوده
    $request->merge(['votes' => 0]);
    $request->merge(['name' => 'atef']);
    //اضافة عنصر جديد بشرط انه مش موجود في الطلب
    $request->mergeIfMissing(['userid'=>'1']);

    return response()->json([
     'orignalData'=>$originalData,
     'AfterMerg'=>$request->all()

    ]);

    dd('done');
*/



        $counter = Courses::where('name', '=', $request->name)->count();
        if ($counter > 0) {
            return redirect()->back()->with(['error' => 'عفوا الاسم مسجل من قبل'])->withInput();
        }
        $course = new Courses();
        $course->name = $request->name;
        $course->active = $request->active;
        $course->save();
        //نعمل اطلاق الحدث event
        event(new CourseAddEvent($request->name));
        //send email

        $data = [
            'name' => 'atef',
            'email' => 'atefsoft@gmail.com',
            'level' => 'advanced',
            'courses' => ['laravel', 'php', 'mysql']

        ];
        Mail::to('asdfox50@gmail.com')->send(new WelcomeMail($data));
        return redirect()->route('courses.index')->with(['success' => 'تم اضافة البيانات بنجاح']);
    }

    public function edit($id)
    {
        $data = Courses::find($id);
        if (empty($data)) {
            return redirect()->route('courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        return view('courses.edit', ['data' => $data]);
    }

    public function update($id, CreateCourseValidationRequest $request)
    {
        $dataCourse = Courses::find($id);
        if (empty($dataCourse)) {
            return redirect()->route('courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $dataCourse['name'] = $request->name;
        $dataCourse['active'] = $request->active;
        $dataCourse->save();
        return redirect()->route('courses.index')->with(['success' => 'تم التحديث بنجاح']);
    }

    public function destroy($id)
    {
        $dataCourse = Courses::find($id);
        if (empty($dataCourse)) {
            return redirect()->route('courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $dataCourse->delete();
        return redirect()->route('courses.index')->with(['success' => 'تم الحذف بنجاح']);
    }
    public function testurl()
    {
        $id = 1;
        //echo url("/posts/{$id}");
        // echo url()->query('/post',['search'=>'laravel']);
        //echo url()->query('/post?sort=latest',['search'=>'laravel']);
        //echo url()->query('/post?sort=latest',['sort'=>'oldest']);
        //$url = url()->query('/posts', ['columns' => ['title', 'body']]);
        //echo urldecode($url);


        //echo url()->current();
        //echo  url()->full();
        //echo url()->previous();
        //echo url()->previousPath();
        //echo URL::current();

        return URL::signedRoute('unsubscribe', ['user' => 1]);
    }
}
