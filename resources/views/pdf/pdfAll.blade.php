<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>بيانات الموظف</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }

        body{
            font-family: 'XBRiyaz',SansSerif;
        }

        .bashar{
            padding-top: 450px;
            background-image: url('storage/images/BFound/{{ $query->ebackground }}') !important;
            background-size:cover ;
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
<div class="bashar" >



    @foreach($list as $p)
        <h1 align="center">{{ $p->pname }}</h1>
        <div class="visible-print text-center">


            <div align="center">
                <barcode code="{{$p->pid}}" size="1.8" type="QR" error="M" class="barcode" />
            </div>


        </div>
        <div style="padding-top: 450px">

        </div>



    @endforeach

</div>
{{--<img style="width: 100%;height: 100%" src="assets/img/bcard2.png" alt="">--}}

</body>
</html>
<script>
    import DisplayGrid from "../../../public/assets/plugins/jquery-ui/demos/sortable/display-grid.html";
    export default {
        components: {DisplayGrid}
    }
</script>
