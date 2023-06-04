<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">

    <title>نتيجة البحث</title>
    <style>
        *{
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4 text-center mt-5">
            <h1>{{ $data[0]->pname }}</h1>
            <h1>{{ $data[0]->pphone }}</h1>
            <h1>{{ $data[0]->pcobon }}</h1>
        </div>
        <div class="col-md-4">

        </div>
    </div>
</body>
</html>
