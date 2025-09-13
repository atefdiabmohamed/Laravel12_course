

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
    <div class="col-md-12" id="ajax_pagination_in_search">
    <br>
   {{ $data->links('pagination::bootstrap-4') }}
</div>
              @else
           <p style="text-align: center; color:brown; margin-top: 10px;">عفوا لاتوجد بيانات لعرضها</p>
              @endif
