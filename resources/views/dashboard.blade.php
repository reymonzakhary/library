@extends('layout.master')
@section('title' , 'ADMIN')
@section('body')
<div class = 'filed-section'>
<div class= 'list-fileds'>
           {{-- list of fileds files  --}}
        @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
        <form class="form-files" action="{{ route('create-book') }}" method='post'>
            @csrf
                  {{-- {{ csrf_field() }} --}}
            <label for="book-title">
                <h4>Book's title</h4>
                 </label>
            <input type="text" id="b-title" name = "title" placeholder="your name book example (my book ..)" required>
            @if($errors->has('title'))
                <div class="error">{{ $errors->first('title') }}</div>
            @endif
               {{-- book author filed --}}
            <label for="book-author">
                <h4>Book's author</h4>
                 </label>
            <input type="text" id="b-author" name = "author" placeholder="your author book example (my book ..)" required><br>
            <br>
            @if($errors->has('author'))
            <div class="error">{{ $errors->first('author') }}</div>
        @endif
            <label for="book-content">
                <h4>Book's content</h4>
                 </label>
            <input type="text" id="b-content" name = "content" placeholder="your author book example (my book ..)" required  minlength="50" maxlength="500"><br>
            <br>
            @if($errors->has('content'))
            <div class="error">{{ $errors->first('content') }}</div>
            @endif

            <label for="categories"><h4>Choose a Catigories:</h4></label>

            <select id="books" name="books" size="1" class="categories-dropdown">
                <option value="comedy">comedy</option>
                <option value="funny">funny</option>
                <option value="family">family</option>
                <option value="action">action</option>
                <option value="drama">drama</option>
                <option value="fantacy">fantacy</option>
              </select><br><br>
            <input type="submit" value="Save and Containue" />

           {{-- <label for="book-file">
               <h4>Book's File</h4>
                </label>
           <input type="file" id="b-file" name = "bfile" placeholder="upload file"> --}}

           {{-- <label for="book-audio">
               <h4>Book's audio</h4>
                </label>
           <input type="audio" id="b-audio" name = "baudio" placeholder="upload audio">

           <label for="book-img">
               <h4>Book's Image</h4>
                </label>
           <input type="image" id="b-img" name = "bimg" placeholder="upload image"> --}}
         </form>
   </div>

   @stop
