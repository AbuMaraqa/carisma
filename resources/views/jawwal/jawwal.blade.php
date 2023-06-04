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
                <h4 class="content-title mb-0 my-auto">رويال</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الكوبونات المسجلة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
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
            @error('attatchment')<div class="text-danger">{{$message}}</div>@enderror
            @if($errors->any())
                <ol>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            @endif
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">جدول المشتركين</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <a class="btn btn-danger btn-md m-1" href="{{ url('/ExportCouponeActive') }}">تصدير الى اكسل</a>
                    <a class="btn btn-dark btn-md m-1" href="{{ url('/getSmsCoupone') }}">ارسال SMS جماعي</a>
{{--                    <div class="row">--}}
{{--                        <a class="btn btn-primary btn-md m-1" href="{{ url('/addPublisher/'. $id) }}">إضافة مشارك</a>--}}

{{--                        <a class="modal-effect btn btn-success btn-md m-1" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">استيراد من اكسل</a>--}}

{{--                        <a class="btn btn-danger btn-md m-1" href="{{ url('/exportPublisher/'.$id) }}">تصدير الى اكسل</a>--}}
{{--                        <a class="btn btn-dark btn-md m-1" href="{{ url('/smsall/'.$id) }}">ارسال SMS جماعي</a>--}}
{{--                        <a class="btn btn-secondary btn-md m-1" href="{{ url('exporttopdfall/' . $id) }}">طباعة جميع بطاقات المشتركين</a>--}}
{{--                        <a class="btn btn-warning btn-md m-1" href="{{ url('/getMessage/' . $id) }}">اعدادات الرسائل</a>--}}
{{--                    </div>--}}

                </div>
                <div class="card-body">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">رقم الكوبون</th>
                            <th class="wd-15p border-bottom-0">الاسم</th>
                            <th class="wd-20p border-bottom-0">رقم الهاتف</th>
                            <th class="wd-20p border-bottom-0">وقت التسجيل</th>
                            <th class="wd-20p border-bottom-0">بواسطة</th>
                            <th class="wd-20p border-bottom-0">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jawwal as $p)
                            <tr>
                                <td>{{ $p->cobon }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->phone }}</td>
                                <td>{{ $p->insert_at }}</td>
                                <td>{{ $p->insert_by }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('/unactiveCoupone/'.$p->id) }}">الغاء تفعيل الكوبون</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">استيراد من اكسيل</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
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
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
