<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Chat</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('css/chat/styles.css')}}">
</head>
<body>
<div id="app">
    <chat-window>

    </chat-window>
</div>

<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
