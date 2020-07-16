<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To Do App</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}} ">
</head>

<body>
    <v-app id="app">
        <app-home></app-home>
    </v-app>
    <script src="{{asset('js/app.js')}} "></script>
</body>

</html>