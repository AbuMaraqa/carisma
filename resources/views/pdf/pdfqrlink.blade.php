<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>qr_link</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }

        body{
            font-family: 'XBRiyaz',SansSerif;
            text-align: center;
        }

    </style>
</head>
<body>
<div class="bashar text-center" >


    <div class="qr card-body text-center">
        {!! QrCode::size(500)->generate( $query->url_link ) !!}
    </div>

{{--    <div align="center">--}}
{{--        <barcode code="{{$id}}" size="1.8" type="QR" error="M" class="barcode" />--}}
{{--    </div>--}}

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
