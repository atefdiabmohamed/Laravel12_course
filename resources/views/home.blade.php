
@extends('Main_layout')
@section('title')

الرئيسية
@endsection

@section('breadcrumb')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">الرئيسية</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
              <li class="breadcrumb-item active">عرض </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

@endsection

@section('content')

<div style= " background-size: cover;height:500px; width:95%; margin:0 auto; background-image: url('{{asset("admin/imgs/layout.jpg")}}'); "></div>
@endsection

