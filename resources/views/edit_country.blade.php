<!DOCTYPE html>
<html>
<body style="direction: rtl; float: right; text-align: center">

<h2>HTML Forms</h2>

  <form action="{{ route('country.update',$data['id']) }}" method="POST">
        @csrf
    @method('PUT')
  <label for="fname"> اسم الدولة:</label><br>
  <input type="text" id="name" name="name" value="{{$data['name']}}"><br><br>
  <input type="submit" value="تحديث">
</form>


</body>
</html>
