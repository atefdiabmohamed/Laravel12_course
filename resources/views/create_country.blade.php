<!DOCTYPE html>
<html>
<body style="direction: rtl; float: right; text-align: center">

<h2>HTML Forms</h2>
<!-- /resources/views/post/create.blade.php -->

<h1>Create Post</h1>


  <form action="{{ route('country.store') }}" method="POST">
        @csrf

  <label for="fname"> اسم الدولة:</label><br>
  <input type="text" id="name" name="name" value=""><br><br>
  @error('name')
<span style="color: red;">{{ $message  }}</span> <br>
  @enderror
  <input type="submit" value="اضف">
</form>


</body>
</html>
