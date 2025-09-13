@extends('Main_layout')
@section('title')
    تعديل كورس
@endsection

@section('content')
    <div class="col-md-12">
        @if(Session::has('error'))
<div class="alert alert-error" role="alert">
   {{  Session::get('error') }}
</div>
@endif

        <form method="POST" action="{{route('courses.update',$data['id'])}}" style="width: 80%; margin: 0 auto;background-color: white">
          @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">اسم الكورس </label>
                    <input autofocus type="text" name="name" class="form-control" id="name" value="{{ old('name',$data['name']) }}">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> حالة التفعيل</label>
                    <select name="active" id="active" class="form-control">
                        <option value="">اختر الحالة</option>
                        <option value="1" @if(old('active',$data['active'])==1) selected @endif  > مفعل</option>
                        <option value="0" @if(old('active',$data['active'])==0 ) selected @endif > معطل</option>
                    </select>
                    @error('active')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" style="" class="btn btn-primary">تحديث الكورس</button>
                </div>
            </div>


        </form>
    </div>
@endsection
