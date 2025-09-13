@extends('Main_layout')
@section('title')
    اضافة طالب للدورة
@endsection

@section('content')
    <div class="col-md-12">
        @if (Session::has('error'))
            <div class="alert alert-error" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif

        <form method="POST"  action="{{ route('training_courses.DOAddStudentToTrainingCourses',$data['id']) }}"
            style="width: 80%; margin: 0 auto;background-color: white">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label>  بيانات الطلاب</label>
                    <select name="StudentID" id="StudentID" class="form-control " style="color: black;">
                        <option value="">اختر الطالب</option>
                       @if(!@empty($students))
                         @foreach ( $students as $info )
                          <option style="color: black;" value="{{$info->id}}" @if(old('StudentID'==$info->id)) selected @endif > {{ $info->name }}</option>
                         @endforeach
                       @endif
                    </select>
                    @error('StudentID')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>

     <div class="form-group">
                    <label for="start_date">تاريخ  تسجيله بالدورة  </label>
                    <input  type="date" name="enrolments_date" value="@php echo date("Y-m-d"); @endphp" class="form-control" id="enrolments_date" value="{{ old('enrolments_date') }}">
                      @error('enrolments_date')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>






                <div class="form-group" style="text-align: center">
                    <button type="submit" style="" class="btn btn-primary">اضف الطالب للدورة</button>
        <a href="{{ route('training_courses.details',$data['id']) }}" class="button" style="background-color: #dc1d1a; color:white; padding:5px;font-weight: normal"> الغاء</a>
                </div>
            </div>


        </form>
    </div>
@endsection
