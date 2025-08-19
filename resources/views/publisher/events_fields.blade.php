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
{{-- إدارة الحقول المخصصة للحدث --}}
<div class="card mt-3">
    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">حقول التسجيل لهذا الحدث</h4>

        <div>
            <a class="btn btn-primary btn-sm" data-effect="effect-scale" data-toggle="modal" href="#addFieldModal">
                + إضافة حقل
            </a>
            <button id="saveOrderBtn" class="btn btn-outline-secondary btn-sm ml-2" type="button">
                حفظ الترتيب
            </button>
        </div>
    </div>

    <div class="card-body">
        @if($event->fields->isEmpty())
            <p class="text-muted mb-0">لا توجد حقول مخصّصة بعد.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>الاسم (key)</th>
                        <th>التسمية (label)</th>
                        <th>النوع</th>
                        <th>مطلوب؟</th>
                        <th>الخيارات</th>
                        <th style="width: 120px;">الترتيب</th>
                        <th style="width: 120px;">إجراءات</th>
                    </tr>
                    </thead>
                    <tbody id="fieldsSortable">
                    @foreach($event->fields as $f)
                        <tr data-id="{{ $f->id }}" id="fieldRow_{{ $f->id }}">
                            <td class="text-center"><span class="mdi mdi-drag-vertical"></span></td>
                            <td>{{ $f->name }}</td>
                            <td>{{ $f->label }}</td>
                            <td>{{ $f->type }}</td>
                            <td>
                                @if($f->is_required) <span class="badge badge-success">نعم</span>
                                @else <span class="badge badge-secondary">لا</span> @endif
                            </td>
                            <td class="small">
                                @php $opts = $f->options ?? []; @endphp
                                @if(isset($opts['choices']) && is_array($opts['choices']) && count($opts['choices']))
                                    خيارات: {{ implode(' | ', $opts['choices']) }}
                                @endif
                                @if(isset($opts['placeholder']))<br>Placeholder: {{ $opts['placeholder'] }} @endif
                                @if(isset($opts['min']))<br>Min: {{ $opts['min'] }} @endif
                                @if(isset($opts['max']))<br>Max: {{ $opts['max'] }} @endif
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control form-control-sm order-input" value="{{ $f->order }}" data-id="{{ $f->id }}">
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('events.fields.destroy', $f->id) }}" onsubmit="return confirm('حذف هذا الحقل؟');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

{{-- Modal: إضافة حقل --}}
<div class="modal" id="addFieldModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة حقل جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('events.fields.store', $event->eid) }}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>الاسم (Key فريد داخل الحدث) <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="مثال: phone, company_name" required>
                    </div>

                    <div class="form-group">
                        <label>التسمية الظاهرة (Label) <span class="text-danger">*</span></label>
                        <input type="text" name="label" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>النوع <span class="text-danger">*</span></label>
                        <select name="type" id="fieldType" class="form-control" required>
                            <option value="">اختر النوع…</option>
                            <option value="text">Text</option>
                            <option value="textarea">Textarea</option>
                            <option value="email">Email</option>
                            <option value="number">Number</option>
                            <option value="date">Date</option>
                            <option value="select">Select</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="file">File</option>
                        </select>
                    </div>

                    <div id="choicesWrapper" class="form-group" style="display:none;">
                        <label>خيارات (للـ Select أو Checkbox)</label>
                        <div id="choicesList">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="options[choices][]" placeholder="خيار">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary addChoiceBtn" type="button">+</button>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">أضف خيارًا في كل سطر. سيُخزن داخل JSON.</small>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Placeholder</label>
                            <input type="text" name="options[placeholder]" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Min</label>
                            <input type="number" name="options[min]" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Max</label>
                            <input type="number" name="options[max]" class="form-control">
                        </div>
                    </div>

                    <div class="form-row align-items-center">
                        <div class="form-group col-md-4">
                            <label>مطلوب؟</label><br>
                            <label class="ckbox">
                                <input type="checkbox" name="is_required" value="1"><span> نعم</span>
                            </label>
                        </div>
                        <div class="form-group col-md-4">
                            <label>ترتيب العرض</label>
                            <input type="number" name="order" class="form-control" value="0">
                        </div>
                    </div>

                </div>
                <div class="pr-4 pb-2">
                    <button class="btn ripple btn-success" type="submit">حفظ</button>
                </div>
            </form>

            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // إظهار/إخفاء خيارات choices بحسب النوع
        const typeSelect = document.getElementById('fieldType');
        const choicesWrapper = document.getElementById('choicesWrapper');

        if (typeSelect) {
            const toggleChoices = () => {
                const t = typeSelect.value;
                choicesWrapper.style.display = (t === 'select' || t === 'checkbox') ? 'block' : 'none';
            };
            typeSelect.addEventListener('change', toggleChoices);
            toggleChoices();
        }

        // إضافة خيار جديد
        $(document).on('click', '.addChoiceBtn', function () {
            $('#choicesList').append(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="options[choices][]" placeholder="خيار">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger removeChoiceBtn" type="button">-</button>
                </div>
            </div>
        `);
        });

        // حذف خيار
        $(document).on('click', '.removeChoiceBtn', function () {
            $(this).closest('.input-group').remove();
        });

        // حفظ الترتيب بكبسة زر: يقرأ input.order-input ويرسلها للباك
        $('#saveOrderBtn').on('click', function () {
            const payload = [];
            $('.order-input').each(function () {
                payload.push({ id: $(this).data('id'), order: parseInt($(this).val() || 0, 10) });
            });

            $.post("{{ route('events.fields.sort', $event->eid) }}", {
                _token: "{{ csrf_token() }}",
                items: payload
            }).done(function () {
                alert('تم حفظ ترتيب الحقول.');
                location.reload();
            }).fail(function (xhr) {
                alert('تعذر حفظ الترتيب: ' + (xhr.responseJSON?.message || xhr.statusText));
            });
        });
    });
</script>
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

