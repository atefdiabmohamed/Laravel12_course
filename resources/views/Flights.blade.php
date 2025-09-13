<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
.button {
  background-color: #ae3408;
  border: none;
  color: white;
  padding: 10px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  float: right;;
  cursor: pointer;
}
</style>
</head>
<body>

<h1 style="text-align: center;">جدول الرحلات





</h1>
 <a href="{{ route('create_flights') }}" class="button"> اضافة جديد </a>

<table dir="rtl" id="customers">
  <tr>
    <th style="text-align: center;">الاسم</th>
    <th style="text-align: center;">الوجهة الثابتة</th>
    <th style="text-align: center;">تاريخ الاضافة</th>
    <th style="text-align: center;">ملاحظات</th>
    <th style="text-align: center;"></th>
  </tr>
@if(@isset($data) and !@empty($data))
@foreach ( $data as $info )
 <tr >
    <td style="text-align: center;">{{ $info->name }}</td>
    <td style="text-align: center;">
@if(!@empty($info->destenation))
{{ $info->destenation->destination }}

@endif



    </td>
    <td style="text-align: center;">{{ $info->notes }}</td>

  <td style="text-align: center;">{{ $info->created_at }}</td>
  <td>
    <a href="{{ route('edit_flights',$info->id) }}" class="button" style="background-color: #04AA6D; padding:10px"> تعديل</a>
      @if($info->deleted_at!=null)
    <a href="{{ route('delete_flights',$info->id) }}" class="button" style="background-color: #aa0704; padding:10px"> حذف نهائي</a>
   @endif
   @if($info->deleted_at==null)
    <a href="{{ route('delete_soft',$info->id) }}" class="button" style="background-color:rgb(150, 118, 0); padding:10px"> حذف جزئي</a>
  @endif
 @if($info->deleted_at!=null)
    <a href="{{ route('restore',$info->id) }}" class="button" style="background-color:rgb(150, 0, 125); padding:10px"> الغاء الحذف</a>
 @endif

</td>

</tr>
@endforeach


@endif

</table>


</body>
</html>


