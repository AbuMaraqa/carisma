@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المشتركين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ارسال رسالة</span>
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
                    <h4 class="card-title mg-b-0">ارسال رسالة</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="row">

                </div>

            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">نص الرسالة</label>
                    <form action="{{ url('/sentSmsSingle/'.$id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <textarea required class="form-control" name="message" id="" cols="30" rows="10"></textarea>
                        </div>
                        <button class="btn btn-primary">ارسال</button>
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
@endsection
