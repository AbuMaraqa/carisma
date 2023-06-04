@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التصويت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل التصويت</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">تعديل التصويت</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
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

                            <div class="table-responsive">
                                <form action="{{ route('polls.update',['id'=>$polls->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">اسم التصويت</label>
                                        <input required class="form-control" name="poll_name" value="{{ $polls->poll_title }}" placeholder="ادخل اسم التصويت" type="text">
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label for="formFile">لإرفاق صورة التصويت اضغط هنا</label>
                                            <input type="file" class="form-control" name="poll_image" id="formFile">
                                        </div>
                                        @if(!is_null($polls->bg_image))
                                            <img class="img-thumbnail" style="width: 300px;height: 300px" src="{{ asset('/assets/images/Bfound/'.$polls->bg_image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">تاريخ التصويت</label>
                                        <input required class="form-control" name="poll_date" value="{{ $polls->start_date }}" placeholder="تاريخ التصويت" type="date">
                                    </div>
                                    <div class="form-group">
                                        <label for="">وقت التصويت</label>
                                        <input required class="form-control" name="poll_time"value="{{ $polls->start_time }}" placeholder="وقت التصويت" type="time">
                                    </div>
                                    <div class="form-group">
                                        <label for="">مدة التصويت</label>
                                        <input required class="form-control" name="poll_duration"value="{{ $polls->duration }}" placeholder="مدة التصويت" type="number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">رسالة الشكر</label>
                                        <textarea class="form-control" name="poll_thanks_message" id="" cols="30" rows="10" placeholder="اكتب رسالة الشكر هنا">value="{{ $polls->thanks_message }}"</textarea>
                                    </div>

                                    <hr>
                                    <div class="col-sm-6 col-md-3">
                                        <button class="btn btn-primary btn-block">تعديل البيانات البيانات</button>
                                    </div>
                                </form>
                            </div>
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
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
