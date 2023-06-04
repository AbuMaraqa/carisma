<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/umd/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <title>صفحة النتائج</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700&display=swap');
        *{
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>
<body>
    <div class="">

        <br>
        <br>
        <br>
        <br>

        <h1 class="text-center w-100">{{ $polls->poll_title }}</h1>

        <hr>
    </div>
    <div class="container" align="center">

        <table class="table w-50 "  dir="rtl">
            @foreach($count as $key)

            <tr>
                <td>
                    <h3 style="font-size: 35px "  class="d-inline">{{ $key->text }}</h3>
                </td>
                <td>
                    <b style="font-size: 35px ; color:red ">{{ $key->count }}</b>
                </td>
            </tr>
            @endforeach


        </table>


    </div>

{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="panel panel-default">--}}
{{--                    <div class="panel-heading my-2">Chart Demo</div>--}}
{{--                    <div class="col-lg-8">--}}
{{--                        <canvas id="userChart" class="rounded shadow"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div id="highchart"></div>--}}
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <canvas class="" id="myChart" style="width:100%;max-width:600px"></canvas>
        </div>
        <div class="col-4"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


    <script>
        var xValues = [ @foreach($count as $key) "{{ $key->text }}", @endforeach ] ;


        {{--var xValues = [{{json_encode($arrayText[0]->option_text) }}]--}}
        var yValues = [ @foreach($count as $key) "{{ $key->count }}", @endforeach ] ;
        var barColors = ["#007bff","#ffc107", "#22c03c","#17a2b8","#737f9e","#fbbc0b","#00b9ff"];

        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {display: true},
                title: {
                    display: true,
                    text: "نتائج التصويت"
                }
            }
        });
    </script>

{{--    <script>--}}
{{--        $(function () {--}}
{{--            var count = {{ ($json) }}--}}
{{--            $("highchart").highcharts({--}}
{{--                chart:{--}}
{{--                    type:'column'--}}
{{--                },--}}
{{--                title:{--}}
{{--                    text:'Test'--}}
{{--                },--}}
{{--                xAxis:{--}}
{{--                    categories:['a','b','c']--}}
{{--                },--}}
{{--                yAxis:{--}}
{{--                    text:'Rate'--}}
{{--                },--}}
{{--                series:{--}}
{{--                    name:'Mohamad',--}}
{{--                    data: count--}}
{{--                }--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}

    <script>
{{--        var ctx = document.getElementById('userChart').getContext('2d');--}}
{{--        const data = {--}}
{{--            labels: [--}}
{{--                'Red',--}}
{{--                'Blue',--}}
{{--                'Yellow'--}}
{{--            ],--}}
{{--            datasets: [{--}}
{{--                label: 'My First Dataset',--}}
{{--                data: [300, 50, 100],--}}
{{--                backgroundColor: [--}}
{{--                    'rgb(255, 99, 132)',--}}
{{--                    'rgb(54, 162, 235)',--}}
{{--                    'rgb(255, 205, 86)'--}}
{{--                ],--}}
{{--                hoverOffset: 4--}}
{{--            }]--}}
{{--        };--}}

{{--        var chart = new Chart(ctx, {--}}
{{--            // The type of chart we want to create--}}
{{--            type: 'bar',--}}
{{--// The data for our dataset--}}
{{--            data: {--}}
{{--                labels:  {!!json_encode($count[0]->text)!!} ,--}}
{{--                datasets: [--}}
{{--                    {--}}
{{--                        label: 'Count of ages',--}}
{{--                        --}}{{--backgroundColor: {!! json_encode("red")!!} ,--}}
{{--                        backgroundColor: 'red' ,--}}
{{--                        data: data  ,--}}
{{--                    },--}}
{{--                ]--}}
{{--            },--}}
{{--// Configuration options go here--}}
{{--            options: {--}}
{{--                scales: {--}}
{{--                    yAxes: [{--}}
{{--                        ticks: {--}}
{{--                            beginAtZero: true,--}}
{{--                            callback: function(value) {if (value % 1 === 0) {return value;}}--}}
{{--                        },--}}
{{--                        scaleLabel: {--}}
{{--                            display: false--}}
{{--                        }--}}
{{--                    }]--}}
{{--                },--}}
{{--                legend: {--}}
{{--                    labels: {--}}
{{--                        // This more specific font property overrides the global property--}}
{{--                        fontColor: '#122C4B',--}}
{{--                        fontFamily: "'Muli', sans-serif",--}}
{{--                        padding: 25,--}}
{{--                        boxWidth: 25,--}}
{{--                        fontSize: 14,--}}
{{--                    }--}}
{{--                },--}}
{{--                layout: {--}}
{{--                    padding: {--}}
{{--                        left: 10,--}}
{{--                        right: 10,--}}
{{--                        top: 0,--}}
{{--                        bottom: 10--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
    </script>


</body>
</html>
