<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="stylesheet" href={{URL::asset('assets/css/styles.css')}}>
    <link rel="stylesheet" href={{URL::asset('assets/css/home.css')}}>
    <link rel="stylesheet" href={{URL::asset('assets/css/blank.css')}}>

    <script type="text/javascript" src={{URL::asset('assets/js/master.js')}}></script>

    <title>@yield('title' , 'master')</title>

</head>

<body onload="zoom()">

@section('static_body')
<div class="container">
     {{-- navigator vertical list of user options --}}
    <div class="vertical-navigation">
        <ul>
            <li>
                <a href="/home">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="title">Home</span>
                    </a>
            </li>
            <li>
                <a href="/blank">
                    <span class="icon"><ion-icon name="add-circle-outline"></ion-icon></span>
                    <span class="title">Blank</span>
                    </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon"><ion-icon name="document-text-outline"></ion-icon></span>
                    <span class="title">Execl</span>
                    </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                    <span class="title">Epub</span>
                    </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon"><ion-icon name="alert-circle-outline"></ion-icon></span>
                    <span class="title">About</span>
                    </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                    <span class="title">Setting</span>
                    </a>
            </li>
        </ul>
    </div>
    <div class="main">
        <div class="topbar">
           <div class="toggle" >
            <ion-icon name="grid-outline"></ion-icon>
           </div>
           <div class="search">
               <label>
                   <input type="text" placeholder="Search here">
                   <ion-icon name="search-circle-outline"></ion-icon>
                </label>
           </div>
        </div>
    </div>

@show
@yield('body')
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>


