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
            /*background-image: url('assets/img/bcard2.png') !important;*/
            background-image: url('assets/images/BFound/{{ $query->certificateimage }}') !important;
            background-size:cover ;
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
<div class="bashar" >

        <h1 align="center">{{ $query->pname }}</h1>

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
