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
                <h4 class="content-title mb-0 my-auto">المناسبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل مشترك</span>
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
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            @foreach($list as $p)
                            <h4 class="card-title mg-b-0"><span>{{ $p->pname }}</span></h4>
                            @endforeach
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
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
                        @foreach($list as $p)
                    <div class="table-responsive">
                        <div class="form-group">
                            <label for="">اسم المشارك</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->pname }}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">رقم الهاتف</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->pphone }}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">الايميل</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->pemail }}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">المهنة</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->pprofession }}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">موعد الدخول</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->pet }}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">موعد استلام الهدية</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->pgift }}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">موعد الغداء</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->plunch }}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">فعالية 1</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->peffict1 }}" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">فعالية 2</label>
                            <input readonly required class="form-control" name="pname" value="{{ $p->peffict2 }}" type="text">
                        </div>
                    </div>
                        @endforeach
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
