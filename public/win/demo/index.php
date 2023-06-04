<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>carisma</title>

    <title>jQuery flipster: Image Cover Flow Plugin Examples</title>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.2/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('win/dist/jquery.flipster.min.css') }}">
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700&display=swap');

        *{
            padding: 0;
            margin: 0;
            font-family: 'Tajawal', sans-serif;
        }

        .container { margin: 150px auto; max-width: 960px; }
        h2 { margin: 2rem auto; }


        .card {
            background: rgb(217,10,227);
            background: linear-gradient(328deg, rgba(217,10,227,0.20258525773590685) 0%, rgba(181,12,185,1) 98%);


        }



        .image-body{
            /*background-image: url('assets/img/bcard2.png') !important;*/
            background-image: url('https://events.carisma.tech/public/assets/images/BFound/{{ $query2->regbackground }}') !important;
            background-size:cover ;
            width: 100%;
            height: 100%;
        }


    </style>
</head>

<body class="image-body">

<div class="container">
    <!--<h1 align="center" >سحب الفائزين </h1>-->
    <div id="coverflow">
        <ul class="flip-items">


            <?php $i = 0;?>
            @foreach($query as $key)
            <li  data-flip-title="Razzmatazz" data-flip-category="Purples">

                <a id="<?php echo $i ; ?>"  style="height:250px; width:200px;  "  align="center" class="btn card  form-control mt-5  pt-5 pb-5 " > {{ $key->pname }} </a>

            </li>
            <?php $i++; ?>
            @endforeach

        </ul>


        <div id="result" style="color:#FFFFFF " ></div>

        <div class="re">

        </div>

        <center>
            <!--<b href="" class="btn btn-success  p-5 "  onClick="startp()" > سحب   </b>-->
            <img width="150" onClick="startp()" src="https://carisma.tech/Apps/images/button.png" alt="button">
        </center>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('win/dist/jquery.flipster.min.js') }}"></script>
    <script>


        var removeid = -1 ;

        function getIndex(el) {
            return Array.from(el.parentNode.children).indexOf(el)
        }



        var coverflow = $("#coverflow");
        var x = coverflow.flipster({
            loop: true,
            spacing: -0.25,
            onItemSwitch: function(currentItem, previousItem){
                //document.getElementById('result').innerHTML = getIndex(currentItem);
                removeid  = getIndex(currentItem) ;

            }

        });


        var counter = 1000 ;
        function startp(){

            if (removeid != -1 ) {
                var element = document.getElementById(removeid);
                //  element.remove() ;
                element.style.backgroundColor = "orange" ;


            }

            //   x.flipster('start') ;
            x.flipster('play' , 50 ) ;



            var r =  Math.random() * (7000 - 5000) + 5000;



            setTimeout(function() {
                x.flipster('pause');}, r);

        }






        const userListElement = document.querySelector("#coverflow");

        const observer = new MutationObserver(callback);
        observer.observe(userListElement, {
            attributeFilter: [ "status", "username" ],
            attributeOldValue: true,
            subtree: true
        });

    </script>
</div>

</body>
</html>
