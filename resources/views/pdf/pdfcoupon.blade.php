<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>طباعة الكوبونات</title>
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
            {{--background-image: url('storage/images/BFound/{{ $query->ebackground }}') !important;--}}
            background-size:cover ;
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
<div class="bashar" >



    @foreach($query as $q)


            <div align="center" class="text-center">
                <h1 style="text-align: center">{{ $q->pcobon }}</h1>
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
