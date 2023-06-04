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
                <h4 class="content-title mb-0 my-auto">المناسبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل مناسبة</span>
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
                        <h4 class="card-title mg-b-0">تعديل مناسبة</h4>
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

                        @foreach($query as $key)
                    <div class="table-responsive">
                        <form action="{{ url('/updateEvent/' . $key->eid) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">اسم المناسبة</label>
                                <input value="{{ $key->ename }}" required class="form-control" name="ename" placeholder="ادخل اسم المناسبة" type="text">
                            </div>
                            <div class="form-group">
                                <label for="">تاريخ المناسبة</label>
                                <input value="{{ $key->edate }}" required class="form-control" name="edate" placeholder="تاريخ المناسبة" type="date">
                            </div>
                            <div class="form-group">
                                <label for="">الوصف</label>
                                <textarea required class="form-control" name="edescription" id="" cols="30" rows="10" placeholder="اكتب الوصف هنا">{{ $key->edescription }}</textarea>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label for="formFile">لإرفاق صورة اضغط هنا</label>
                                    <input type="file" class="form-control" name="eimage" id="formFile">
                                </div>
                                @if(!is_null($key->eimage))
                                <img class="img-thumbnail" style="width: 300px;height: 300px" src="{{ asset('/storage/images/Bfound/'.$key->eimage) }}" alt="">
                                @endif

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">لإرفاق صورة الخلفية اضغط هنا</label>
                                    <input value="{{ $key->ebackground }}" class="form-control" name="ebackground" type="file" id="formFile">
                                </div>
                                @if(!is_null($key->ebackground))
                                <img class="img-thumbnail" style="width: 300px;height: 300px" src="{{ asset('/storage/images/Bfound/'.$key->ebackground) }}" alt="">
                                @endif

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">لارفاق صورة الشهادة اضغط هنا</label>
                                    <input value="{{ $key->certificateimage }}" class="form-control" name="certificateimage" type="file" id="formFile">
                                </div>
                                @if(!is_null($key->certificateimage))
                                    <img class="img-thumbnail" style="width: 300px;height: 300px" src="{{ asset('/storage/images/Bfound/'.$key->certificateimage) }}" alt="">
                                @endif
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="">يرجى اختيار مستخدم للفعالية الحالية</label>
                                <div class="form-group">
                                    <select class="form-control" name="dropdownlist" id="dropdownlist">
                                        @foreach($user as $key)--}}
                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3 pt-4">
                                <button class="btn btn-primary btn-block">تعديل البيانات</button>
                            </div>
                        </form>
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
