@extends('Main_layout')
@section('title')
الدورات
@endsection

@section('content')

          <div class="col-12" style="background-color: white; padding:15px;">
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title " style="text-align: center; float: none">بيانات الدورات

     <a class="btn btn-sm btn-info " href="{{route('training_courses.create')}}">اضافة جديد</a>

                </h3>
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

              </div>

              <div class="card-body table-responsive p-0" style="height: auto; ">
                @if(@isset($data) and !@empty($data) and count($data)>0)


                  <table id="example2" class="table table-bordered table-hover" style="">
                  <thead>
                    <tr>
                      <th style="width: 25%">اسم الكورس</th>
                      <th> السعر </th>
                    <th>  البداية</th>
                      <th>  الانتهاء</th>
                      <th> ملاحظات</th>
                      <th> الاضافة</th>
                      <th> التحديث</th>
                      <th>التحكم</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $info )


                        <tr>
                      <td>{{$info->course_name}}</td>
                     <td> {{ $info->price*1}} </td>
                     <td> {{ $info->start_date}} </td>
                     <td> {{ $info->end_date}} </td>

                     <td> {{ $info->notes}} </td>


                      <td>{{$info->created_at}}</td>
                      <td>{{$info->updated_at}}</td>
                      <th style="width:15%">
    <a href="{{ route('training_courses.edit',$info->id) }}" class="button" style="background-color: #04AA6D; color:white; padding:5px;font-weight: normal"> تعديل</a>
    <a href="{{ route('training_courses.destroy',$info->id) }}" class="button" style="background-color: #aa0704; color:white; padding:5px;font-weight: normal"> حذف </a><br> <br>
    <a href="{{ route('training_courses.details',$info->id) }}" class="button" style="background-color: #2149e6; color:white; padding:5px;;"> الطلاب</a>
</th>
                       </tr>

                  @endforeach




                  </tbody>
                </table>
              @else
           <p style="text-align: center; color:brown; margin-top: 10px;">عفوا لاتوجد بيانات لعرضها</p>
              @endif

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


@endsection


