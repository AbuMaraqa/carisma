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
                <h4 class="content-title mb-0 my-auto">المناسبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المناسبات</span>
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
                        <h4 class="card-title mg-b-0">جدول المناسبات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="row p-4">
                        @foreach($events as $event)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
                                <div class="card overflow-hidden sales-card bg-primary-gradient">
                                    <div class="row">
                                        <div CLASS="col-md-2 bg-white p-1 m-1 mr-3" align="center">
                                            <img src="{{ asset('storage/images/Bfound/'.$event->eimage) }}" width="100" height="100" alt="">
                                        </div>
                                        <div CLASS="col-md-9">
                                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                                <div class="pb-0 mt-0">
                                                    <div class="d-flex">
                                                        <div class="">
                                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $event->ename }}</h4>
                                                            <p class="mb-0 tx-12 text-white op-7">{{ $event->edescription }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <a class="btn btn-dark btn-sm m-1" href="{{ url('/'. 'getEventId/'.$event->eid) }}">عرض</a>
                                                    <a class="btn btn-dark btn-sm m-1" href="{{ url('/'. 'getDataEvents/'.$event->eid) }}">تعديل</a>
                                                    <a class="btn btn-danger btn-sm m-1" href="{{ url('/'. 'deleteEvent/'.$event->eid) }}">حذف مناسبة</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table text-md-nowrap" id="example1">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="wd-15p border-bottom-0">اسم المناسبة</th>--}}
{{--                                <th class="wd-15p border-bottom-0">موعد بدء المناسبة</th>--}}
{{--                                <th class="wd-20p border-bottom-0">الوصف</th>--}}
{{--                                <th class="wd-20p border-bottom-0">الحالة</th>--}}
{{--                                <th class="wd-20p border-bottom-0">صورة</th>--}}
{{--                                <th class="wd-20p border-bottom-0">العمليات</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($events as $event)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $event->ename }}</td>--}}
{{--                                    <td>{{ $event->edate }}</td>--}}
{{--                                    <td>{{ $event->edescription }}</td>--}}
{{--                                    <td>{{ $event->estatus }}</td>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{ asset('/storage/images/Bfound/'.$event->eimage) }}" alt="">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{ asset('/storage/images/Bfound/'.$event->ebackground) }}" alt="">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="row">--}}
{{--                                                <a class="btn btn-primary btn-sm m-1" href="{{ url('/'. 'getEventId/'.$event->eid) }}">عرض</a>--}}
{{--                                                <a class="btn btn-primary btn-sm m-1" href="{{ url('/'. 'getDataEvents/'.$event->eid) }}">تعديل</a>--}}
{{--                                                <a class="btn btn-danger btn-sm m-1" href="{{ url('/'. 'deleteEvent/'.$event->eid) }}">حذف مناسبة</a>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
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
<script>
    import DisplayGrid from "../../../public/assets/plugins/jquery-ui/demos/sortable/display-grid.html";
    export default {
        components: {DisplayGrid}
    }
</script>
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
