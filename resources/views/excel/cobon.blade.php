<table class="table">
    <thead>
    <tr>
        <th>الكوبون</th>
        <th>الاسم</th>
        <th>الهاتف</th>
        <th>تاريخ الاستخدام</th>
        <th>تم الاضافة بواسطة</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $p)
    <tr>
        <td>{{ $p->pcobon }}</td>
        <td>{{ $p->pname }}</td>
        <td>{{ $p->pphone }}</td>
        <td>{{ $p->insertat }}</td>
        <td>{{ $p->insertby }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
