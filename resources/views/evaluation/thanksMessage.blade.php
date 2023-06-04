<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <title>Thanks</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700&display=swap');

        *{
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>
<body>

<div class="row p-4 ">

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
<div class="align-middle p-5 " align="center">
    <h1 class="align-middle mt-5" align="center" >{{ $query[0]->thanks_message }}</h1>
</div>

</div>
</body>
</html>
<script>
    import DisplayGrid from "../../../public/assets/plugins/jquery-ui/demos/sortable/display-grid.html";
    export default {
        components: {DisplayGrid}
    }
</script>
