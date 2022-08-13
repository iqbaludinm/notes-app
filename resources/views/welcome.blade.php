<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Johan Nasendi">
        <meta name="description" content="Notes APP Documentation API">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="csrf-token" content="{{ csrf_token() }}">

       <!--GOOGLE FONTS-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700;800;900&family=Source+Sans+3:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!--FONT AWESOME-->
        <link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!--EXTERNAL STYLE SHEET-->
        <link  href="{{asset('/css/style.css')}}" rel="stylesheet">
    </head>
    <body>
        <div class="content">
            <img src="{{asset('/img/logosa.png')}}" class="logo" alt="LOGO" width="50" >
            <h1>NOTES<br> YOUR DAILY</h1>
            <h2>An awesome website is under construction, stay tuned.</h2>
            <div class="arrow bounce">
                <a class="fa fa-arrow-down" href="#"></a>
            </div>
            <section class="button">
                <div class="searchBox">
                        <input class="searchInput"type="text"  placeholder="Documentation API " readonly>
                       <a class="searchButton" href="https://notedapp-api.herokuapp.com/api/documentation" target="_blank">API BACKEND</a>
                </div>
            </section>
            <section class="social_icons">
                <a href="#" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="#" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>
                <a href="#" title="Twitter" target="_blank"><i class="fa fa-github"></i></a>
                <a href="#" title="Telegram" target="_blank"><i class="fa fa-telegram"></i></a>
            </section>
        </div>
    </body>
</html>
