<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
           body{
            background-image: url('{{ asset('img/boy.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 20px;
            color: white;
            flex: 1
           }
           img{
            position: absolute;
       
           }
           .container{
                justify-content: center;
                flex-direction: row;
                text-align: center
         
           }
           .container h1{
            font-weight: bold;
            color: rgb(255, 0, 0);
            font-style: italic;
            text-transform: uppercase;
            font-size: 5vh;
            line-height: 2vh;
            
            
            
           }
           .container strong{
            color: rgb(255, 255, 255);
            
           }

        </style>


    </head>
    <body class="antialiased" >
        <div class="container">
            <h1>tetap <strong> semangat </strong> guys</h1>
            <h1>insyaallah ada jalannya</h1>
        </div>
        
    </body>
</html>
