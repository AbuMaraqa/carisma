<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        *{
            font-family: 'Tajawal', sans-serif;
        }
        html, body {
            background-image: url("{{ asset('image/royal_car.png') }}");
            background-attachment: fixed;
            background-size: cover;
            height: 100%;
            margin: 0;
        }
        canvas{
            background:#000;
        }
        .centered-div {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 700px;
            height: 300px;
        }


        .lds-hourglass {
            display: inline-block;
            position: relative;
            width: 200px;
            height: 200px;
        }
        .lds-hourglass:after {
            content: " ";
            display: block;
            border-radius: 50%;
            width: 200px;
            height: 200px;
            margin: 8px;
            box-sizing: border-box;
            border: 40px solid #fff;
            border-color: #fff transparent #fff transparent;
            animation: lds-hourglass 1.2s infinite;
        }
        @keyframes lds-hourglass {
            0% {
                transform: rotate(0);
                animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
            }
            50% {
                transform: rotate(900deg);
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }
            100% {
                transform: rotate(1800deg);
            }
        }

        .progress{
            position: relative;
            height: 10px;
            width: 1110%;
            border: 10px solid #f4a261;
            border-radius: 15px;
        }
        .progress .color{
            position: absolute;
            background-color: #ffffff;
            width: 0px;
            /*height: 10px;*/
            border-radius: 15px;
            animation: progres 4s infinite linear;
        }
        @keyframes progres{
            0%{
                width: 0%;
            }
            25%{
                width: 50%;
            }
            50%{
                width: 75%;
            }
            75%{
                width: 85%;
            }
            100%{
                width: 100%;
            }
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body style="background-color: black">
<div>
{{--    <canvas style="display: none" id="canvas" ></canvas>--}}
</div>
<div align="center" class="centered-div">
{{--    <div style="color: white;font-size:80px;display: none" id="timer">5</div>--}}

    <div class="row">

        <div class="col-md-4">

        </div>
        <div class="w3-light-grey">
            <div id="myBar" class="w3-container w3-red p-4" style="border-radius: 10px;display: none;width:1%">
                <div class="" style="font-size: 30px" id="counter"></div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>
    <div>
        <div class="text-dark" style="display: none;font-size: 60px" id="pcobon"></div>
        <div class="text-dark" style="font-weight: bold;display: none;font-size: 60px" id="winner"></div>
{{--        <div style="display: none;color: white;font-size: 80px" id="pphone"></div>--}}
    </div>
    <div align="center">
        <button class="btn btn-danger pr-4 pl-4 form-control" style="font-size: 30px;width: 150px" id="button1" onclick="winner()">سحب</button>
    </div>

</div>


{{--<button class="w3-button w3-light-grey" onclick="move()">Click Me</button>--}}


</body>

<script>
    window.addEventListener("resize", resizeCanvas, false);
    window.addEventListener("DOMContentLoaded", onLoad, false);

    window.requestAnimationFrame =
        window.requestAnimationFrame       ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame    ||
        window.oRequestAnimationFrame      ||
        window.msRequestAnimationFrame     ||
        function (callback) {
            window.setTimeout(callback, 1000/60);
        };

    var canvas, ctx, w, h, particles = [], probability = 0.04,
        xPoint, yPoint;





    function onLoad() {
        canvas = document.getElementById("canvas");
        // ctx = canvas.getContext("2d");
        resizeCanvas();

        window.requestAnimationFrame(updateWorld);
    }

    function resizeCanvas() {
        if (!!canvas) {
            w = canvas.width = window.innerWidth;
            h = canvas.height = window.innerHeight;
        }
    }

    function updateWorld() {
        update();
        // paint();
        window.requestAnimationFrame(updateWorld);
    }

    function update() {
        if (particles.length < 500 && Math.random() < probability) {
            createFirework();
        }
        var alive = [];
        for (var i=0; i<particles.length; i++) {
            if (particles[i].move()) {
                alive.push(particles[i]);
            }
        }
        particles = alive;
    }

    // function paint() {
    //     ctx.globalCompositeOperation = 'source-over';
    //     ctx.fillStyle = "rgba(0,0,0,0.2)";
    //     ctx.fillRect(0, 0, w, h);
    //     ctx.globalCompositeOperation = 'lighter';
    //     for (var i=0; i<particles.length; i++) {
    //         particles[i].draw(ctx);
    //     }
    // }

    function createFirework() {
        xPoint = Math.random()*(w-200)+100;
        yPoint = Math.random()*(h-200)+100;
        var nFire = Math.random()*50+100;
        var c = "rgb("+(~~(Math.random()*200+55))+","
            +(~~(Math.random()*200+55))+","+(~~(Math.random()*200+55))+")";
        for (var i=0; i<nFire; i++) {
            var particle = new Particle();
            particle.color = c;
            var vy = Math.sqrt(25-particle.vx*particle.vx);
            if (Math.abs(particle.vy) > vy) {
                particle.vy = particle.vy>0 ? vy: -vy;
            }
            particles.push(particle);
        }
    }

    function Particle() {
        this.w = this.h = Math.random()*4+1;

        this.x = xPoint-this.w/2;
        this.y = yPoint-this.h/2;

        this.vx = (Math.random()-0.5)*10;
        this.vy = (Math.random()-0.5)*10;

        this.alpha = Math.random()*.5+.5;

        this.color;
    }

    Particle.prototype = {
        gravity: 0.05,
        move: function () {
            this.x += this.vx;
            this.vy += this.gravity;
            this.y += this.vy;
            this.alpha -= 0.01;
            if (this.x <= -this.w || this.x >= screen.width ||
                this.y >= screen.height ||
                this.alpha <= 0) {
                return false;
            }
            return true;
        },
        draw: function (c) {
            c.save();
            c.beginPath();

            c.translate(this.x+this.w/2, this.y+this.h/2);
            c.arc(0, 0, this.w, 0, Math.PI*2);
            c.fillStyle = this.color;
            c.globalAlpha = this.alpha;

            c.closePath();
            c.fill();
            c.restore();
        }
    }
</script>

<script>



    // document.getElementById('loader').style.display = 'none';
    function winner() {
        var countdown = 4;
        var timerElement = document.getElementById("timer");
        function updateTimer() {
            // timerElement.textContent = countdown;
            countdown--; // Decrease the countdown value

            if (countdown < 0) {
                clearInterval(timer); // Stop the interval when countdown reaches 0
                // timerElement.textContent = "Timer finished!";
            }
        }

        function move() {
            var elem = document.getElementById("myBar");
            var width = 1;
            var id = setInterval(frame, 40);
            function frame() {
                if (width >= 101) {
                    clearInterval(id);
                } else {
                    document.getElementById('counter').innerHTML = width;
                    width++;
                    elem.style.width = width + '%';
                }
            }
        }

        var timer = setInterval(updateTimer, 1000);
        // var counterLoader = setInterval(move, 1000);
        // document.getElementById('canvas').style.display = 'none';
        document.getElementById('myBar').style.display = 'block';
        document.getElementById('winner').style.display = 'none';
        // document.getElementById('timer').style.display = 'block';
        // document.getElementById('timer').innerHTML = '5';
        document.getElementById('pcobon').style.display = 'none';
        // document.getElementById('pphone').style.display = 'none';
        // document.getElementById('loader').style.display = 'block';
        document.getElementById('button1').style.display = 'none';
        move();
        setTimeout(function() {
            // clearInterval(counterLoader);
            clearInterval(timer);
            document.getElementById('myBar').style.display = 'none';

            // document.getElementById('canvas').style.display = 'block';
            document.getElementById('winner').style.display = 'none';
            // document.getElementById('timer').style.display = 'none';
            // document.getElementById('loader').style.display = 'none';
             $.ajax({
                 url: "{{ route('royal.getWinner') }}",
                 method: "GET",
                 success: function(response) {
                     // Process the response
                     var winner = document.getElementById('winner')
                     winner.style.display = 'block';
                     document.getElementById('pcobon').style.display = 'block';
                     // document.getElementById('pphone').style.display = 'block';
                     document.getElementById('pcobon').innerHTML = response['data']['pcobon'];
                     // document.getElementById('pphone').innerHTML = response['data']['pphone'];
                     winner.innerHTML = response['data']['pname'];
                     document.getElementById('button1').style.display = 'block';

                 },
                 error: function(xhr, status, error) {
                     console.log("An error occurred: " + error);
                 }
             });
        }, 5000);

    }

</script>
</html>
