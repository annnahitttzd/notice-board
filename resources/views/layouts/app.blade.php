<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @vite('resources/js/app.js')
    <!-- Styles -->
    <style>
        .antialiased{
            width: 500px;
            margin: 100px;
        }
        .approved_stories{
            text-decoration: none;
            color:#2d3748;
        }
        .story{
            margin: 15px;
            padding: 15px;
            width: 50%;
            height: 90px;
            background-color: #dde7f5;
            display: flex;
            justify-content: space-around;
            align-items: center;
            border-radius: 10px;
        }
        .story-container{
            width:100%;
            margin: 10px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        a{
            color:#1a202c ;
            text-decoration: none;
        }
        .text-primary{
            display: flex;
            justify-content: center;
            padding: 10px;
        }

    </style>
</head>
</html>
