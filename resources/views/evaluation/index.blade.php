<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <title>صفحة التقييم</title>

    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Cache-Control" content="no-cache">



    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700&display=swap');

        *{
            font-family: 'Tajawal', sans-serif;
        }

        .bashar{
            {{--background-image: url('storage/images/BFound/{{ $polls->bg_image }}') !important;--}}
            background-size:cover ;
            background-image: url( {{asset('assets/images/BFound/'.$polls->bg_image)}} );
            width: 100%;
            height: 100%;
        }

        .custom {
            @primary-color: #22B58F;
            @input-border-color: #ddd;
            @control-size: 20px;
            @control-size-spacing: 12px;
            @control-border-width: 2px;

            margin-bottom: 16px;

        &.checkbox > label,
        &.radio > label {
             position: relative;
             cursor: pointer;
             padding-left: @control-size + @control-size-spacing;
         }

        input[type="checkbox"],
        input[type="radio"] {
            position: relative;
            margin-left: -1 * (@control-size + @control-size-spacing/2);
            margin-right: @control-size-spacing;
            cursor: pointer;

        &:after {
             content: "";
             position: absolute;
             top: -0.25 * @control-size;
             left: -0.5 * @control-size-spacing + @control-border-width;
             width: 1 * @control-size;
             height: 1 * @control-size;
             background: #fff;
             border: @control-border-width solid @input-border-color;
             cursor: pointer;
         }
        }

        input[type="checkbox"] {


        &:before {
             transition: transform 0.4s cubic-bezier(0.45, 1.8, 0.5, 0.75);
             transform: rotate(-45deg) scale(0, 0);

             content: "";
             position: absolute;
             left: -0.25 * @control-size-spacing + @control-border-width;
             z-index: 1;
             width: 0.65 * @control-size;
             height: 0.375 * @control-size;

             border: @control-border-width solid @primary-color;
             border-top-style: none;
             border-right-style: none;
         }

        &:checked {
        &:before {
             transform: rotate(-45deg) scale(1, 1);
         }
        }

        &:after {
             border-radius: @control-border-width;
         }
        }

        input[type="radio"] {
            top: -1 * @control-border-width;

        &:before {
             transition: transform 0.4s cubic-bezier(0.45, 1.8, 0.5, 0.75);
             transform: scale(0, 0);

             content: "";
             position: absolute;
             top: 0.5 * @control-border-width;
             left: 0; //-0.25 * @control-size-spacing;
             z-index: 1;
             width: 0.6 * @control-size;
             height: 0.6 * @control-size;
             background: @primary-color;
             border-radius: 50%;
         }

        &:checked {
        &:before {
             transform: scale(1, 1);
         }
        }

        &:after {
             border-radius: 50%;
             top: -0.25 * @control-size + @control-border-width;
         }
        }
        }



    </style>
</head>
<body>

<div class="container p-3">
    <div class="bashar card text-center">


        {{--        <h1>{{ $value }}</h1>--}}
        <div class="card-body">
{{--            <h5 class="card-title">اهلا وسهلا بكم جميعاً</h5>--}}
{{--            <p class="card-text">الرجاء تقييم ما يلي</p>--}}
            <div class="form-group align-items-center">
                <div class="mt-5 ">



                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
               <h1>    <label class="" for="">{{ $polls->poll_title }}</label></h1>
                    <br>


                </div>

                <form action="{{ route('pollresult.create') }}" method="post">
                    @csrf
                    <input name="id" value="{{ $polls->id }}" type="hidden">
                    <div class="text-center row ">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <?php $i = 1 ?>
                            @foreach($polloptions as $key)


                                <div class="form-group">
                                    <div class="radio custom" dir="rtl" align="right">
                                        <label>

                                            <input class="form-check-input p-2 ml-4 " type="radio" name="radio" id="exampleRadios<?php echo $i ?>" value="{{ $key->id }}" >

<b class="p-3" >
                                            {{ $key->option_text }}
</b>

                                        </label>
                                </div>
                                    <?php $i++ ?>
                            @endforeach
                        </div>

                        <div class="col-md-4"></div>



                    </div>

                    <button type="submit" class="btn btn-dark text-white btn-lg mt-3">تسويط </button>
                </form>
            </div>

            </div>

        <div>
            {{ $polls->start_time ."/". $polls->duration }}
        </div>


        </div>

        <h3 align="center" class="m-5" ><div>باقي على انتهاء الوقت <span class="text-danger" id="time"></span> دقائق!</div></h3>
{{--        <h1 class="text-center text-danger" id="demo"></h1>--}}
    </div>


    <div id="result">

    </div>

{{--    <form ACTION="" METHOD="GET">--}}
{{--        <INPUT type="text" id="n1">--}}
{{--        <button type="button" onclick="getResult(n1.value)">Click Me</button>--}}

{{--    </form>--}}


{{--    <p id="demo"></p>--}}



</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


<script>
    // Set the date we're counting down to
    // var countDownDate = new Date("Dec 21, 2022 14:56:00 ").getTime();
    // var x = setInterval(function() {
    //
    //     // Get today's date and time
    //     var now = new Date().getTime();
    //
    //     // Find the distance between now and the count down date
    //     var distance = countDownDate - now;
    //
    //     // Time calculations for days, hours, minutes and seconds
    //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    //
    //     // Output the result in an element with id="demo"
    //     document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    //         + minutes + "m " + seconds + "s ";
    //
    //     // If the count down is over, write some text
    //     if (distance < 0) {
    //         clearInterval(x);
    //         document.getElementById("demo").innerHTML = "EXPIRED";
    //     }
    // }, 1000);

    var tt;
    var durationtime;

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            tt = display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                //timer = duration;
                //alert('انتهى الوقت');
                display.textContent = 'انتهى الوقت';
                //window.location = "/thanks";
            }

        }, 1000);
    }

    window.onload = function () {
        {{--durationtime = {{ $polls->start_date + (60 * (  $polls->duration  )) }}--}}
        var fiveMinutes = (60 * ( {{ $polls->duration }} )),
         tt = (( {{ $polls->duration }} )),
            display = document.querySelector('#time');
        startTimer(tt, display);
    };

        function getResult(){
        $.get("/evaluation/getAllPolls", function(data, status){
           // alert(status);
            document.getElementById('result').innerHTML = parseFloat(data[0]['start_time']) - parseFloat(tt);
            });
    }

    if (!tt){
        $("body").on('click','.ajax',function(){
            var url = 'www.google.com';
            $.get(url, function(data){
                $("#page-main").html(data);

                //history manipulation here
            });
            return false;
        });
    }



    jQuery( document ).ready(function( $ ) {

        //Use this inside your document ready jQuery
        $(window).on('popstate', function() {
            location.reload(true);
        });

    });




</script>

{{--<script>--}}
{{--    // Set the date we're counting down to--}}


{{--    var countDownDate = new Date("{{ $polls->duration }}").getTime();--}}

{{--    // Update the count down every 1 second--}}
{{--    var x = setInterval(function() {--}}

{{--        // Get today's date and time--}}
{{--        var now = new Date().getTime();--}}

{{--        // Find the distance between now and the count down date--}}
{{--        var distance = countDownDate - now;--}}

{{--        // Time calculations for days, hours, minutes and seconds--}}
{{--        var days = Math.floor(distance / (1000 * 60 * 60 * 24));--}}
{{--        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));--}}
{{--        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));--}}
{{--        var seconds = Math.floor((distance % (1000 * 60)) / 1000);--}}

{{--        // Output the result in an element with id="demo"--}}
{{--        document.getElementById("demo").innerHTML = days + " يوم " + hours + "ساعة "--}}
{{--            + minutes + "دقيقة " + seconds + "ثانية ";--}}

{{--        // If the count down is over, write some text--}}
{{--        if (distance < 0) {--}}
{{--            clearInterval(x);--}}
{{--            document.getElementById("demo").innerHTML = "EXPIRED";--}}
{{--            window.location.href--}}

{{--        }--}}
{{--    }, 1000);--}}
{{--</script>--}}

</body>
</html>
