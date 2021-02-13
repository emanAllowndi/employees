<!DOCTYPE html>
<html>
<head>
    <style>

        @import url('https://fonts.googleapis.com/css?family=Exo:400,700');

        *{
            margin: 0px;
            padding: 0px;
        }

        body{
            font-family: 'Exo', sans-serif;
        }


        .context {
            width: 100%;
            position: absolute;
            top:20vh;

        }
        .zoom:hover {
            transform: scale(1.2);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }

        .context h1{
            text-align: center;
            color: #fff;
            font-size: 50px;
        }


        .area{

            background-image: url("{{asset('background.png')}}");
            background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);
            width: 100%;
            height:100vh;
            z-index: -1;
            position: relative;



        }

        .circles{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .circles li{
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            animation: animate 25s linear infinite;
            bottom: -150px;

        }

        .circles li:nth-child(1){
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }


        .circles li:nth-child(2){
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .circles li:nth-child(3){
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }
        .left{
            width:50%;


        }
        .all{
            width:60%;

        }
        .right{
            width:50%;


        }

        .circles li:nth-child(4){
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .circles li:nth-child(5){
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }

        .circles li:nth-child(6){
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }

        .circles li:nth-child(7){
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }

        .circles li:nth-child(8){
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }

        .circles li:nth-child(9){
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }

        .circles li:nth-child(10){
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }
        .fly-in-left{
            -webkit-animation: flyinleftanim 1s ease;
        }
        @-webkit-keyframes flyinleftanim
        {
            0% {-webkit-transform: translateX(-1000px);}
            100% {-webkit-transform: translateX(0px);}
        }




        @keyframes animate {

            0%{
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }

            100%{
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }



        }

    </style>
    <meta charset="UTF-8">
    <title> انظمة الوزارة </title>
</head>
<body>

<div class="context">

    <div class="all" style="margin-top: 50px; align:left; float:left">


        <a href="{{ url('admin') }}"><img src="{{asset('ev.png')}}" alt="وزارة النقل" style="width:400px; height:195px; margin-left:100px;" class="zoom fly-in-left"></a> <br>


        <a href="{{ url('../../../../comp/public') }}" style="text-decoration: none;"><img src="{{asset('sh.png')}}" alt="وزارة النقل" style="width:400px; height:195px ; margin-left:200px;" class="zoom" ></a>

    </div>

</div>


<div class="area" >
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div >



</body>

</html>








