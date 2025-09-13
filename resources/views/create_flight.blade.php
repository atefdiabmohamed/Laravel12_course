<!DOCTYPE html>
<html>
<body style="direction: rtl; float: right; text-align: center">

<h2>HTML Forms</h2>
<!-- /resources/views/post/create.blade.php -->

<h1>Create Post</h1>
<!--
@if ($errors->any())
   <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
-->

<!-- Create Post Form -->

  <form action="{{ route('store_flight') }}" method="POST">
        @csrf

  <label for="fname"> اسم الرحلة:</label><br>
  <input type="text" id="name" name="name" value="{{old('name')}}"><br><br>
  @error('name')
<span style="color: red;">{{ $message  }}</span> <br>
  @enderror
   <label for="notes">  ملاحظات ان وجدت:</label><br>
  <input type="text" id="notes" name="notes" value="{{old('notes')}}"><br><br>

  <input type="submit" value="اضف">
</form>


</body>
</html>
