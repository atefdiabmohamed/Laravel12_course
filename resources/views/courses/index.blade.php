@extends('Main_layout')
@section('title')
    الكورسات
@endsection

@section('content')

    <div class="col-12" style="background-color: white; padding:15px;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title " style="text-align: center; float: none">بيانات الكورسات
                    <!-- call anonymous components. -->

                    <x-button />


                    <a class="btn btn-sm btn-info " href="{{ route('courses.create') }}">اضافة جديد</a>

                </h3>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-error" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif

            </div>

            <div class="card-body table-responsive p-0" style="height: auto;">
                @if (@isset($data) and !@empty($data) and count($data) > 0)
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>اسم الكورس</th>
                                <th>حالة التفعيل</th>
                                <th>تاريخ الاضافة</th>
                                <th>تاريخ التحديث</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                                <tr>
                                    <td>{{ $info->name }}</td>
                                    <td>
                                        @if ($info->active == 1)
                                            مفعل
                                        @else
                                            معطل
                                        @endif
                                    </td>
                                    <td>{{ $info->created_at }}</td>
                                    <td>{{ $info->updated_at }}</td>
                                    <th>
                                        <a href="{{ route('courses.edit', $info->id) }}" class="button"
                                            style="background-color: #04AA6D; color:white; padding:7px;font-weight: normal">
                                            تعديل</a>
                                        <a href="{{ route('courses.destroy', $info->id) }}" class="button"
                                            style="background-color: #aa0704; color:white; padding:7px;font-weight: normal">
                                            حذف </a>
                                    </th>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                    <div class="col-md-12">
                        <br>
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <p style="text-align: center; color:brown; margin-top: 10px;">عفوا لاتوجد بيانات لعرضها</p>
                @endif

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>


@endsection
