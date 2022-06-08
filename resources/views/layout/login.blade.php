<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/vue-router@3"></script>
    <title>Login</title>
</head>
<body>
<div id="app">
    <div class="container">
        <HeaderLogin></HeaderLogin>
        <p>
            <!-- use the router-link component for navigation. -->
            <!-- specify the link by passing the `to` prop. -->
            <!-- `<router-link>` will render an `<a>` tag with the correct `href` attribute -->
            <router-link to="/blank">Go to Home</router-link>
            <router-link to="/home">Go to About</router-link>
          </p>
    </div>

</div>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>

