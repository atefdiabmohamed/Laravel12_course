<?php

namespace App\Http\Controllers;

use App\Http\Requests\createtraingcourse;
use App\Http\Requests\DoAddStudentToCourse;
use App\Models\Courses;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Models\Training_courses;
use App\Models\training_courses_enrolments;

class Training_coursesController extends Controller
{

    public function index()
    {

        $data = Training_courses::all();
        if (!empty($data)) {
            foreach ($data as $info) {
                $info->course_name = Courses::where('id', '=', $info->courseID)->value('name');
            }
        }
        return view('training_courses.index', ['data' => $data]);
    }
    public function create()
    {

        $Courses = Courses::select("id", "name")->where("active", 1)->get();
        return view('training_courses.create', ['Courses' => $Courses]);
    }

    public function store(createtraingcourse $request)
    {

        $student = new Training_courses();
        $student->courseID = $request->courseID;
        $student->start_date  = $request->start_date;
        $student->end_date  = $request->end_date;
        $student->price  = $request->price;
        $student->notes  = $request->notes;
        $student->save();
        return redirect()->route('training_courses.index')->with(['success' => 'تم اضافة البيانات بنجاح']);
    }

    public function edit($id)
    {
        $data = Training_courses::find($id);
        if (empty($data)) {
            return redirect()->route('training_courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $Courses = Courses::select("id", "name")->where("active", 1)->get();

        return view('training_courses.edit', ['data' => $data, 'Courses' => $Courses]);
    }


    public function update($id, createtraingcourse $request)
    {
        $dataTraining = Training_courses::find($id);
        if (empty($dataTraining)) {
            return redirect()->route('training_courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $dataTraining->courseID = $request->courseID;
        $dataTraining->start_date  = $request->start_date;
        $dataTraining->end_date  = $request->end_date;
        $dataTraining->price  = $request->price;
        $dataTraining->notes  = $request->notes;
        $dataTraining->save();
        return redirect()->route('training_courses.index')->with(['success' => 'تم التحديث بنجاح']);
    }
    public function destroy($id)
    {
        $dataTraining = Training_courses::find($id);
        if (empty($dataTraining)) {
            return redirect()->route('training_courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $dataTraining->delete();
        return redirect()->route('training_courses.index')->with(['success' => 'تم الحذف بنجاح']);
    }
      public function details($id)
    {
        $dataTraining = Training_courses::find($id);
        if (empty($dataTraining)) {
            return redirect()->route('training_courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
     $dataTraining['course_name'] = Courses::where('id', '=', $dataTraining['courseID'])->value('name');
    $dataTraining['StudnetCounter']=training_courses_enrolments::where('training_courses_id','=',$id)->count();
    $training_courses_enrolments=training_courses_enrolments::select("*")->where('training_courses_id','=',$id)->get();
    if(!empty($training_courses_enrolments)){
foreach($training_courses_enrolments as $info){
                $info->student_name = Students::where('id', '=', $info->StudentID)->value('name');
}
    }
        return view('training_courses.details', ['data' => $dataTraining,'training_courses_enrolments'=>$training_courses_enrolments]);
    }

      public function AddStudentToTrainingCourses($id)
    {
          $dataTraining = Training_courses::find($id);
        if (empty($dataTraining)) {
            return redirect()->route('training_courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }

        $students = Students::select("id", "name")->where("active", 1)->get();
        return view('training_courses.AddStudentToTrainingCourses', ['students' => $students,'data'=>$dataTraining]);
    }

         public function DOAddStudentToTrainingCourses($id,DoAddStudentToCourse $request)
    {
          $dataTraining = Training_courses::find($id);
        if (empty($dataTraining)) {
            return redirect()->route('training_courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
    $StudnetCounter=training_courses_enrolments::where('training_courses_id','=',$id)->where('StudentID','=',$request->StudentID)->count();
   if($StudnetCounter >0){
      return redirect()->route('training_courses.details',$id)->with(['error' => 'عفوا هذا الطالب مسجل من قبل']);
   }
$dataToInsert['training_courses_id']=$id;
$dataToInsert['StudentID']=$request->StudentID;
$dataToInsert['enrolments_date']=$request->enrolments_date;
training_courses_enrolments::create($dataToInsert);


 return redirect()->route('training_courses.details',$id)->with(['success' => 'تم اضافة الطالب بنجاح']);

    }

      public function DeleteStudentFromTrainingCourses($id)
    {
          $data_training_courses_enrolments = training_courses_enrolments::find($id);
        if (empty($data_training_courses_enrolments)) {
            return redirect()->route('training_courses.index')->with(['error' => 'عفوا غير قادر للوصول للبيانات المطلوبة']);
        }
        $data_training_courses_enrolments->delete();

    return redirect()->route('training_courses.details',$data_training_courses_enrolments['training_courses_id'])->with(['success' => 'تم جذف الطالب بنجاح']);

    }
}
