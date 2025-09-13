@extends('Main_layout')
@section('title')
    تعديل دورة
@endsection

@section('content')
    <div class="col-md-12">
     @if(Session::has('success'))
<div class="alert alert-success" role="alert">
   {{  Session::get('success') }}
</div>
@endif

     @if(Session::has('error'))
<div class="alert alert-error" role="alert">
   {{  Session::get('error') }}
</div>
@endif


            <div class="card-body" style="background-color: white !important">
   <table id="example2" class="table table-bordered table-hover">
  <tr>
    <td> اسم الكورس </td>
    <td> {{$data['course_name']}} </td>

</tr>



 <tr>
    <td>  السعر </td>
    <td> {{$data['price']*1}} </td>

</tr>
 <tr>
    <td>  تاريخ البداية </td>
    <td> {{$data['start_date']}} </td>

</tr>

<tr>
    <td>  تاريخ الانتهاء </td>
    <td> {{$data['end_date']}} </td>

</tr>
<tr>
    <td>  ملاحظات </td>
    <td> {{$data['notes']}} </td>

</tr>
<tr>
    <td>  عدد الطلاب المسجلين بالدورة </td>
    <td> {{$data['StudnetCounter']*1}} </td>

</tr>

<tr>

    <td colspan="2">


        <a href="{{ route('training_courses.AddStudentToTrainingCourses',$data['id']) }}" class="button" style="background-color: #04AA6D; color:white; padding:5px;font-weight: normal"> اضافة طالب للدورة</a>
</td>

</tr>
   </table>

      @if(@isset($training_courses_enrolments) and !@empty($training_courses_enrolments) and count($training_courses_enrolments)>0)


                  <table id="example2" class="table table-bordered table-hover" style="">
                  <thead>
                    <tr>
                      <th> اسم الطالب </th>
                    <th>  تاريخ التسجيل</th>
                      <th> الاضافة</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($training_courses_enrolments as $info )


                        <tr>
                      <td>{{$info->student_name}}</td>
                     <td> {{ $info->enrolments_date}} </td>


                      <td>{{$info->created_at}}</td>

                      <th style="width:15%">
    <a href="{{ route('training_courses.DeleteStudentFromTrainingCourses',$info->id) }}" class="button" style="background-color: #aa0704; color:white; padding:5px;font-weight: normal"> حذف </a><br> <br>
</th>
                       </tr>

                  @endforeach




                  </tbody>
                </table>
              @else
           <p style="text-align: center; color:brown; margin-top: 10px;">عفوا لاتوجد بيانات لعرضها</p>
              @endif


            </div>



    </div>
@endsection
