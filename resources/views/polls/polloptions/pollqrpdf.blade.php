<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تصويت</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }

        body{
            font-family: 'XBRiyaz',SansSerif;
            color: white;
            font-size: 25px;
            background-image: url('assets/images/BFound/bg.png') !important;
            background-size: cover;
            background-attachment: fixed;
        }

    </style>
</head>
<body>
<br>
<h1 align="center" style="padding: 20px">
    {{ $query[0]->poll_title }}
</h1>
<br>
<div style="margin-top-top-top: 20px">
    <div  align="center">
        <barcode code="{{ $host.'/evaluation/index/'.$query[0]->id }}" size="5" type="QR" error="M" class="barcode"/>
    </div>
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
