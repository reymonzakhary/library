<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="stylesheet" href={{URL::asset('assets/css/dashboard.css')}}>
    <link rel="stylesheet" href={{URL::asset('assets/css/inputs.css')}}>
    <link rel="stylesheet" href={{URL::asset('assets/css/login.css')}}>
    <link rel="stylesheet" href={{URL::asset('assets/css/styles.css')}}>
    <link rel="stylesheet" href={{URL::asset('assets/css/blank.css')}}>

    <script type="text/javascript" src={{URL::asset('assets/js/master.js')}}></script>

    <title>@yield('title' , 'master')</title>

</head>
<body>

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
           <div class="toggle">
            <ion-icon name="grid-outline"></ion-icon>
           </div>
           <div class="search">
               <label>
                   <input type="text" placeholder="Search here">
                   <ion-icon name="search-circle-outline"></ion-icon>
                </label>
           </div>
        </div>

        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">
                        510
                         </div>
                         <div class="cardName">
                          Books
                         </div>
                </div>
                <div class="iconCard">
                    <ion-icon name="book-outline"></ion-icon>
                </div>
            </div>

           <div class="card">
               <div>
                <div class="numbers">
                    4
                     </div>
                     <div class="cardName">
                      Admin
                     </div>
               </div>
               <div class="iconCard">
                <ion-icon name="people-circle-outline"></ion-icon>
               </div>
           </div>
           <div class="card">
               <div>
                <div class="numbers">
                    120
                     </div>
                     <div class="cardName">
                      Users
                     </div>
               </div>
               <div class="iconCard">
                  <ion-icon name="person-outline"></ion-icon>
               </div>
           </div>
      </div>
      <div class="list_books">
          <div class ="recent"></div>
      </div>

       </div>



    </div>

@show
@yield('body')
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
{{-- <script type="text/javascript">
    //navigator
   let toggle = document.querySelector('.toggle');
   let navigator = document.querySelector('.vertical-navigation');
   let main    = document.querySelector('.main');

   toggle.onclick= function (){
       navigator.classList.toggle('active');
   }
   //add hoverd calss in selected div list iteams
let list = document.querySelectorAll('.vertical-navigation li');
function activeLink(){
    list.forEach( (element) =>
     element.classList.remove('hovered'));
    this.classList.add('hovered');
 }
 list.forEach((iteam)=>iteam.addEventListener('mouseover' ,activeLink));
</script> --}}
</body>

</html>

{{-- <div class="navigator-header">
    <nav>
        <a href="/">welcome</a>
        <a href="/home">home</a>
        <a href="/login">login</a>
        <a href="/admin">dashboard</a>
    </nav>
</div>
</div>
</div> --}}
