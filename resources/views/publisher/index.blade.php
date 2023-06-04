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
                        <div class="row">
                            <a class="btn btn-primary btn-md m-1" href="{{ url('/addPublisher/'. $id) }}">إضافة مشارك</a>

                            <a class="modal-effect btn btn-success btn-md m-1" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">استيراد من اكسل</a>

                            <a class="btn btn-danger btn-md m-1" href="{{ url('/exportPublisher/'.$id) }}">تصدير الى اكسل</a>
                            <a class="btn btn-dark btn-md m-1" href="{{ url('/smsall/'.$id) }}">ارسال SMS جماعي</a>
                            <a class="btn btn-secondary btn-md m-1" href="{{ url('exporttopdfall/' . $id) }}">طباعة جميع بطاقات المشتركين</a>
                            <a class="btn btn-info   btn-md m-1" href="{{ url('/pdfCertificate/' . $id) }}">طباعة جميع شهادات المشاركين</a>
                            <a class="btn btn-info   btn-md m-1" href="{{ url('/sentSmsCertificateAll/' . $id) }}">ارسال جميع الشهادات sms</a>
                            <a class="btn btn-warning btn-md m-1" href="{{ url('/getMessage/' . $id) }}">اعدادات الرسائل</a>
                            <form onclick="return confirm('هل انت متاكد من حذف جميع المشتركين ؟؟')" action="{{ url('/deleteAllPublishers/' . $id) }}" method="get">
                                <button type="submit" class="btn btn-danger btn-md m-1" >حذف جميع المشتركين</button>
                            </form>
                        </div>

                </div>

                <div class="card-body">


                    <div>رابط السحب <a target="new" href="https://reg.carisma.tech/listEvent/{{$id}}">https://reg.carisma.tech/listEvent/{{$id}}</a></div>
                    @foreach($event as $e)
                        <div class="alert alert-info pt-4">
                            <h4>{{ $e->ename }}</h4>
                        </div>
                    @endforeach
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>

                                <th class="wd-15p border-bottom-0">الاسم</th>
                                <th class="wd-15p border-bottom-0">رقم الهاتف</th>
                                <th class="wd-20p border-bottom-0">الايميل</th>
                                <th class="wd-20p border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $p)
                                <tr id="tr_{{$p->pid}}">
                                    <td>{{ $p->pname }}</td>
                                    <td>{{ $p->pphone }}</td>
                                    <td>{{ $p->pemail }}</td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                العمليات
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item btn btn-dark btn-sm" href="{{ url('/' . 'exporttopdf/'. $p->pid) }}">طباعة البطاقة</a>
                                                <a class="dropdown-item btn btn-dark btn-sm" href="{{ url('/' . 'smssingle/'. $p->pid) }}">ارسال رسالة</a>
                                                <a class="dropdown-item btn btn-dark btn-sm" href="{{ url('/' . 'getPublisherid/' . $p->pid) }}">عرض التفاصيل</a>
                                                <a class="dropdown-item btn btn-dark btn-sm" href="{{ url('/' . 'pdfCertificateSingle/' . $p->pid) }}">طباعة شهادة</a>
                                                <a class="dropdown-item btn btn-dark btn-sm" href="{{ url('/' . 'sentSmsCertificateSingle/' . $p->pid) }}">ارسال الشهادة SMS</a>
                                                <a class="dropdown-item text-danger btn btn-dark btn-sm" href="{{ url('/deletePublisher/'.$p->pid) }}">حذف المشترك</a>
                                            </div>
                                            <input class="btn btn-danger btn-sm mr-2" onclick="deleterow({{$p->pid}})" type="button" value="X" name="{{ 'pname_'.$p->pid }}">
                                        </div>
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
                    <form action="{{ url('/importPublisher/'.$id) }}" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            @csrf
                            <input type="file" name="attatchment">
                            @error('attatchment')<div class="text-danger">{{$message}}</div>@enderror
                        </div>
                        <div class="pr-4 pb-2">
                            <button class="btn ripple btn-success"  type="submit">حفظ البيانات</button>
                        </div>
                    </form>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        function deleterow(id){
            $.get("/deleteCheck",
                {
                    id: id
                },
                function(data, status){
                    // alert("Data: " + data + "\nStatus: " + status);
                    document.getElementById('tr_'+id).innerHTML ="";
                });
        }

    </script>

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
