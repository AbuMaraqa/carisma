@extends('layouts.master')
@section('css')
@endsection
@section('title')

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


        <div class="card col-md-12 col-sm-8">

            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">اعدادات الرسائل</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="row">

                </div>

            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">يرجى تحديد الرسائل التي سوق يتم ارسالها للتطبيق</label>
                    <form action="{{ url('/createMessageStatus/'.$events[0]->eid) }}" method="get" enctype="multipart/form-data">
                        <input type="hidden" name="id">
                        <div class="form-check form-group">
                            <input class="form-check-input" @if($events[0]->petstatus == 1) checked @endif type="checkbox" name="petcheck" value="true" id="defaultCheck1">
                            <label class="form-check-label pr-4" for="defaultCheck1">
                                الدخول
                            </label>
                            <input class="form-control" value="{{ $events[0]->petmessage }}" name="petinput" id="input1" type="text">
                        </div>
                        <div class="form-check form-group">
                            <input class="form-check-input" @if($events[0]->plunchstatus == 1) checked @endif name="plunchcheck" type="checkbox" value="true" id="defaultCheck2">
                            <label class="form-check-label pr-4" for="defaultCheck2">
                                الغداء
                            </label>
                            <input class="form-control" value="{{ $events[0]->plunchmessage }}" name="plunchinput" type="text">

                        </div>
                        <div class="form-check form-group">
                            <input class="form-check-input" @if($events[0]->pgiftstatus == 1) checked @endif name="pgiftcheck" type="checkbox" value="true" id="defaultCheck3">
                            <label class="form-check-label pr-4" for="defaultCheck3">
                                الهدية
                            </label>
                            <input class="form-control" value="{{ $events[0]->pgiftmessage }}" name="pgiftinput" type="text">

                        </div>
                        <div class="form-check form-group">
                            <input class="form-check-input" @if($events[0]->peffict1status == 1) checked @endif name="peffict1check" type="checkbox" value="true" id="defaultCheck4">
                            <label class="form-check-label pr-4" for="defaultCheck4">
                                فعالية 1
                            </label>
                            <input class="form-control" value="{{ $events[0]->peffict1message }}" name="peffict1input" type="text">

                        </div>
                        <div class="form-check form-group">
                            <input class="form-check-input" @if($events[0]->peffict2status == 1) checked @endif name="peffict2check" type="checkbox" value="true" id="defaultCheck5">
                            <label class="form-check-label pr-4" for="defaultCheck5">
                                فعالية 2
                            </label>
                            <input class="form-control" value="{{ $events[0]->peffict2message }}" name="peffict2input" type="text">

                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">اضافة نص شهادة الرسالة</label>
                            <textarea class="form-control" name="message" id="" cols="30" rows="10">{{ $events[0]->certificatemessage }}</textarea>
                        </div>
                        <button class="btn btn-primary">حفظ</button>
                    </form>
                    {{--                    <form action="/updateMainEvent" method="post" enctype="multipart/form-data">--}}
                    {{--                        @csrf--}}
                    {{--                        @method('POST')--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <select class="form-control" name="dropdownlist" id="dropdownlist">--}}
                    {{--                                @foreach($query as $key)--}}
                    {{--                                <option value="{{ $key->eid }}">{{ $key->ename }}</option>--}}
                    {{--                                @endforeach--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                        <button class="btn btn-primary">حفظ</button>--}}
                    {{--                    </form>--}}
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
