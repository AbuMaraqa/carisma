<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <title>صفحة التقييم</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700&display=swap');

        *{
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>
<body>
<br><br><br><br><br>
<div class="text-center" style="font-size: 35px">موعد التصويت {{ $query[0]->start_date }} <span class="text-danger" id="time"></span></div>
<div class="text-center" style="font-size: 35px">الساعة {{ $query[0]->start_time }} <span class="text-danger" id="time"></span></div>
<br>
<h3 class="text-center">باقي على موعد بداية التصويت</h3>
<h1 class="text-center text-danger" id="demo"></h1>

<div class="text-center">
    <a href="/evaluation/index/{{$query[0]->id}}" class="btn btn-dark">الانتقال الى صفحة التصويت</a>
</div>


<div id="nav"></div>





<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


{{--<script>--}}
{{--    function routetopage(){--}}
{{--        event.preventDefault();--}}
{{--        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');--}}
{{--        $.ajax({--}}
{{--            url:'/evaluation/index/{{$query[0]->id}}',--}}
{{--            type:'get',--}}
{{--            data:{--}}
{{--                CSRF_TOKEN--}}
{{--            },--}}
{{--            success:function (data,status) {--}}
{{--                //console.log(data)--}}
{{--                $("#nav").html(data)--}}
{{--            }--}}
{{--        })--}}
{{--    }--}}
{{--</script>--}}

<script>
    // Set the date we're counting down to


    var countDownDate = new Date("{{ $query[0]->start_date }} {{ $query[0]->start_time }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + " يوم " + hours + "ساعة "
            + minutes + "دقيقة " + seconds + "ثانية ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "انتهى الوقت";
            window.location.href = '/evaluation/index/{{ $query[0]->id }}';
        }
    }, 1000);
</script>

</body>
</html>
