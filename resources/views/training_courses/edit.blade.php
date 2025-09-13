@extends('Main_layout')
@section('title')
    تعديل دورة
@endsection

@section('content')
    <div class="col-md-12">
        @if (Session::has('error'))
            <div class="alert alert-error" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif

        <form method="POST"  action="{{ route('training_courses.update',$data['id']) }}"
            style="width: 80%; margin: 0 auto;background-color: white">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label>  الكورس المخصص للدورة</label>
                    <select name="courseID" id="courseID" class="form-control ">
                        <option value="">اختر الكورس</option>
                       @if(!@empty($Courses))
                         @foreach ( $Courses as $info )
                          <option value="{{$info->id}}"@if(old('courseID',$data['courseID']==$info->id)) selected @endif > {{ $info->name }}</option>
                         @endforeach
                       @endif
                    </select>
                    @error('courseID')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>
                 <div class="form-group">
                    <label for="price">  سعر الدورة  </label>
                    <input  type="text" name="price" class="form-control" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" id="address" value="{{ old('price',$data['price']*1) }}">
                      @error('price')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>

     <div class="form-group">
                    <label for="start_date">تاريخ بداية الدورة  </label>
                    <input  type="date" name="start_date" class="form-control" id="address" value="{{ old('start_date',$data['start_date']) }}">
                      @error('start_date')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>

                 <div class="form-group">
                    <label for="end_date">تاريخ إنتهاء الدورة  </label>
                    <input  type="date" name="end_date" class="form-control" id="address" value="{{ old('end_date',$data['end_date']) }}">
                      @error('end_date')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>


                    <div class="form-group">
                    <label for="notes">ملاحظات  </label>
                    <input  type="notes" name="notes" class="form-control" id="notes" value="{{ old('notes',$data['notes']) }}">

                </div>


                <div class="form-group" style="text-align: center">
                    <button type="submit" style="" class="btn btn-primary">تعديل الدورة التدريبية</button>
                </div>
            </div>


        </form>
    </div>
@endsection
