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
    <title>البحث عن كوبون</title>
    <style>
        *{
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>
<body>
    @if(\Illuminate\Support\Facades\Session::has('fail'))
        <span class="text-center alert alert-danger d-block">{{ \Illuminate\Support\Facades\Session::get('fail') }}</span>
    @endif
    <div class="text-center mt-5">
        <h3 for="">البحث عن كوبون</h3>
    </div>
    <form action="{{ route('royal.searchCobon') }}" method="post">
        @csrf
        <div class="text-center mt-2">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="pcobon" type="text" class="form-control text-center">
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <button class="btn btn-success m-4">البحث</button>
        </div>
    </form>

</body>
</html>
