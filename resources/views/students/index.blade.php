@extends('Main_layout')
@section('title')
الطلاب
@endsection

@section('content')

          <div class="col-12" style="background-color: white; padding:15px;">
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title " style="text-align: center; float: none">بيانات الطلاب
<a href="{{route('ar')}}">ar</a>
<a href="{{route('en')}}">en</a>
<!-- call component -->
<!--  <x-alert> </x-alert> -->
<x-alert/>
<x-info-lable type="success" message="Call success Components "  />
<x-info-lable type="error" message=" Call error Components "  />
<x-infolabelslot type="info" >
Call  Components with Slot
</x-infolabelslot>



     <a class="btn btn-sm btn-info " href="{{route('student.create')}}"> {{__('mycustom.add_new') }} </a>

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
<div class="row">
  <div class="col-md-3">
           <label>    بحث بالاسم</label>
                    <input  type="text" name="searchByName" id="searchByName"  placeholder="بحث باسم الطالب " class="form-control" >
                </div>
  <div class="col-md-3">
                 <div class="form-group">
                    <label>  البحث بحالة التفعيل</label>
                    <select name="active_search" id="active_search" class="form-control ">
                        <option value="all">بحث بالكل</option>
                        <option value="1">مفعل</option>
                        <option value="0">معطل</option>
                    </select>

  </div>
                </div>
                  </div>
              </div>

              <div class="card-body table-responsive p-0" style="height: auto;" id="ajax_responce_div">





                @if(@isset($data) and !@empty($data) and count($data)>0)

                  <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>اسم الطالب</th>
                      <th> الدولة</th>
                      <th> العنوان</th>
                      <th> الهاتف</th>
                      <th> الصورة</th>
                      <th> ملاحظات</th>
                      <th> التفعيل</th>
                      <th> الاضافة</th>
                      <th> التحديث</th>
                      <th>التحكم</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $info )


                        <tr>
                      <td>{{$info->name}}</td>
                     <td> {{ $info->country_name}} </td>
                     <td> {{ $info->address}} </td>
                     <td> {{ $info->phones}} </td>
                     <td><img style="width: 70px;
  height: 70px;" src="{{asset('uploads/'.$info->image)}}"  > </td>
                     <td> {{ $info->notes}} </td>


                      <td>@if($info->active==1) مفعل @else معطل @endif</td>
                      <td>{{$info->created_at}}</td>
                      <td>{{$info->updated_at}}</td>
                      <th style="width:15%">
    <a href="{{ route('student.edit',$info->id) }}" class="button" style="background-color: #04AA6D; color:white; padding:5px;font-weight: normal"> تعديل</a>
    <a href="{{ route('student.destroy',$info->id) }}" class="button" style="background-color: #aa0704; color:white; padding:5px;font-weight: normal"> حذف </a>
                      </th>
                       </tr>

                  @endforeach




                  </tbody>
                </table>
<div class="col-md-12">
    <br>
   {{ $data->links('pagination::bootstrap-4') }}
</div>

              @else
           <p style="text-align: center; color:brown; margin-top: 10px;">عفوا لاتوجد بيانات لعرضها</p>
              @endif

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


@endsection

@section('scripts')
<script>
$(document).ready(function(){


function make_search(){
var name=$("#searchByName").val();
var active_search=$("#active_search").val();
jQuery.ajax({
url:'{{ route('student.ajax_search_student') }}',
type:'post',
'dataType':'html',
cache:false,
data:{"_token":'{{csrf_token()}}',name:name,active:active_search},
success:function(data){
$("#ajax_responce_div").html(data);
},
error:function(){

}


});


}

$(document).on('change',"#searchByName",function(e){
make_search();

});

$(document).on('change',"#active_search",function(e){

make_search();

});


 $(document).on('click', '#ajax_pagination_in_search a ', function(e) {
        e.preventDefault();
var name=$("#searchByName").val();
var active_search=$("#active_search").val();
 var url = $(this).attr("href");
jQuery.ajax({
url:url,
type:'post',
'dataType':'html',
cache:false,
data:{"_token":'{{csrf_token()}}',name:name,active:active_search},
success:function(data){
$("#ajax_responce_div").html(data);
},
error:function(){

}


});



});

});


</script>


@endsection


