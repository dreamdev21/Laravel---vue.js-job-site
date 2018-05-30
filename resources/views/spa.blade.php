<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <title>The Beta Plan</title>
    <link rel="icon" href="{{url('images/favicon.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{url('images/favicon-32x32.png')}}" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
        #preloader{
            position: fixed;
            top:0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: #eff9fe;
        }
        .spinner {
            margin: auto;
            width: 70px;
            height: 70px;
            position: relative;
            top: 45%;
            text-align: center;
            -webkit-animation: sk-rotate 2.0s infinite linear;
            animation: sk-rotate 2.0s infinite linear;
        }

        .dot1,
        .dot2 {
            width: 60%;
            height: 60%;
            display: inline-block;
            position: absolute;
            top: 0;
            background-color: rgba(0,0,0,0.2);
            border-radius: 100%;
            -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
            animation: sk-bounce 2.0s infinite ease-in-out;
        }

        .dot2 {
            top: auto;
            bottom: 0;
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        @-webkit-keyframes sk-rotate {
            100% {
                -webkit-transform: rotate(360deg)
            }
        }

        @keyframes sk-rotate {
            100% {
                transform: rotate(360deg);
                -webkit-transform: rotate(360deg)
            }
        }

        @-webkit-keyframes sk-bounce {
            0%,
            100% {
                -webkit-transform: scale(0.0)
            }
            50% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bounce {
            0%,
            100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
            }
            50% {
                transform: scale(1.0);
                -webkit-transform: scale(1.0);
            }
        }
    </style>
    <script>
    window.onload=function () {
        document.querySelector('#preloader').remove()
    }
    window.Laravel = {
        csrf: '{{  csrf_token() }}',
        client_id: '{{ config('auth.client_id') }}',
        client_secret: '{{config('auth.client_secret')}}'
    }
    </script>
</head>

<body>
<div id="preloader">
<div class="spinner">
    <div class="dot1"></div>
    <div class="dot2"></div>
</div>
</div>
<div id="app"></div>

<script type="text/javascript" src="{{ url(mix('manifest.js'))}}"></script>
<script type="text/javascript" src="{{ url(mix('vendor.js'))}}"></script>
<script type="text/javascript" src="{{ url(mix('main.js'))}}"></script>

</body>

</html>
