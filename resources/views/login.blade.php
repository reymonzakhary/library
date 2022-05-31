@extends('layout.master')
@section('title' , 'Login')
@section('body')
<div class="login-form">
    <form name="login-form" target="_self" action="/actions_forms.php" method="POST">
        <label for="title"><h2>Login Form</h2></label>
        <hr class="dashed">
     <label for="email-user"><h4>Email</h4></label>
     <input type="email" id="user-email" name = "uEmail" class="user-email" placeholder="Enter your email (example@example.com)">
     <label for="password-user"><h4>Password</h4></label>
     <input type="password" id="user-pass" name = "uPassword" class="user-pass" placeholder="Enter your password (*********)"><br>
     <br>
     <button type="submit-login">Login</button>
   </form>
</div>
@stop

