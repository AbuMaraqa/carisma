<table class="table">
    <thead>
        <tr>
            <th>رقم المشترك</th>
            <th>رقم المناسبة</th>
            <th>الاسم</th>
            <th>رقم الهاتف</th>
            <th>الايميل</th>
            <th>المهنة</th>
            <th>تاريخ الدخول</th>
            <th>تاريخ استلام الهدية</th>
            <th>تاريخ الغداء</th>
            <th>فعالية 1</th>
            <th>فعالية ٢</th>
        </tr>
    </thead>
    <tbody>

    @foreach($list as $p)
        <tr>
            <td>{{ $p->pid }}</td>
            <td>{{ $p->peventid }}</td>
            <td>{{ $p->pname }}</td>
            <td>{{ $p->pphone }}</td>
            <td>{{ $p->pemail }}</td>
            <td>{{ $p->pprofession }}</td>
            <td>{{ $p->pet }}</td>
            <td>{{ $p->pgift }}</td>
            <td>{{ $p->plunch }}</td>
            <td>{{ $p->peffict1 }}</td>
            <td>{{ $p->peffict2 }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
