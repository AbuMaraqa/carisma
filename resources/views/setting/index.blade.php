@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المناسبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاعدادات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ session::get('success') }}
                </div>
            @endif

            @if(Session::get('fail'))
                <div class="alert alert-danger">
                    {{ session::get('fail') }}
                </div>
            @endif
        </div>


        <div class="card col-md-6 col-sm-8">

            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
{{--                    <h4 class="card-title mg-b-0">الاعدادات</h4>--}}
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="row">

                </div>

            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="">يرجى اختيار المناسبة التي سوف تظهر في تطبيق QR <a href="https://carisma.tech/Apps/QR%20Events/QR.apk">(تحميل التطبيق)</a> </label>

                    <form action="/updateMainEvent" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <select class="form-control" name="dropdownlist" id="dropdownlist">
                                @foreach($query as $key)--}}
                                <option value="{{ $key->eid }}">{{ $key->ename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card col-md-6 col-sm-8">

            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
{{--                    <h4 class="card-title mg-b-0">الاعدادات</h4>--}}
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="row">

                </div>

            </div>

            <div class="card-body">
                <div class="form-group">
                    <form action="/setRegBackground" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="formFile">الرجاء ارفاق صورة خلفية سحب الفائزين</label>
                            <input type="file" class="form-control" name="image" id="formFile">
                        </div>
                        <button class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>



    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
{{--    <script>--}}
{{--       function check(){--}}
{{--            var check = document.getElementById('defaultCheck1');--}}
{{--            var input = document.getElementById('input1');--}}
{{--            if(check.checked == true){--}}
{{--                input.readOnly = false;--}}
{{--            }--}}
{{--            if(check.checked == false){--}}
{{--                input.readOnly = true;--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
@endsection
