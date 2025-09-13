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

<h1 style="text-align: center;">جدول بيانات الدول





</h1>
 <a href="{{ route('country.create') }}" class="button"> اضافة جديد </a>

<table dir="rtl" id="customers">
  <tr>
    <th style="text-align: center;">الاسم</th>
    <th style="text-align: center;">تاريخ الاضافة</th>
    <th></th>
  </tr>
@if(@isset($data) and !@empty($data))
@foreach ( $data as $info )
 <tr >
    <td style="text-align: center;">{{ $info->name }}</td>
  <td style="text-align: center;">{{ $info->created_at }}</td>
  <td>
    <a href="{{ route('country.edit',$info->id) }}" class="button" style="background-color: #04AA6D; padding:10px"> تعديل</a>
 <form method="POST" action="{{ route('country.destroy',$info->id) }}" >
    @csrf
    @method('DELETE')
    <button class="button" style="background-color: #aa0704; padding:10px"> حذف</button>

</form>
</td>

</tr>
@endforeach


@endif

</table>


</body>
</html>


