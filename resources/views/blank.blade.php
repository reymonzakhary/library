@extends('layout.master')
@section('title' , 'blank')
@section('static_body')
@parent
<div class="main-blank">
    <div class= form-blank>
      <div class="form-infromation">
                 {{-- list of fileds information  --}}
         @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
             @endif
                 <form class="form" action="{{ route('create-book') }}" method='post'>
                      {{-- {{ csrf_field() }} --}}
                    @csrf
                             <div class="header-input">

                                 <div class="title-label">
                                    <i><ion-icon name="search-circle-outline"></ion-icon></i>
                                    <label>Title Book</label>
                                 </div>

                                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                                </div>
                               <p>*requied</p>
                            <input type="text" id="b-title" name = "title" placeholder="Enter your name book example (my book ..)" required><br>
                            <br>
                            @if($errors->has('title'))
                                <div class="error">{{ $errors->first('title') }}</div>
                            @endif
                               {{-- book author filed --}}
                               <div class="header-input">

                                <div class="title-label">
                                   <i><ion-icon name="person-circle-outline"></ion-icon></i>
                                   <label>Author Book</label>
                                </div>
                                   <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                               </div>
                              <p>*requied</p>
                            <input type="text" id="b-author" name = "author" placeholder="Enter your author book example (my book ..)" required><br>
                            <br>
                            @if($errors->has('author'))
                            <div class="error">{{ $errors->first('author') }}</div>
                        @endif
                        <div class="header-input">

                            <div class="title-label">
                               <i><ion-icon name="create-outline"></ion-icon></i>
                               <label>Description</label>
                            </div>
                               <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                           </div>
                          <p>*requied</p>
                        <textarea class="desc" type="text" id="b-content" name = "content" placeholder="Enter your descpription book example (my book ..)" cols="40" rows="6" required ></textarea><br>
                        <br>
                        @if($errors->has('content'))
                        <div class="error">{{ $errors->first('content') }}</div>
                        @endif
                      <div class="header-input">
                            <div class="title-label">
                               <i><ion-icon name="copy-outline"></ion-icon> </i>
                               <label>Categories</label>
                            </div>
                               <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                           </div>
                          <p>*requied</p>
                        <select id="books" name="books" size="1" class="categories-dropdown">
                            <option value="comedy">comedy</option>
                            <option value="funny">funny</option>
                            <option value="family">family</option>
                            <option value="action">action</option>
                            <option value="drama">drama</option>
                            <option value="fantacy">fantacy</option>
                          </select><br><br>
                          <div class="header-input">
                            <div class="title-label">
                               <i><ion-icon name="copy-outline"></ion-icon> </i>
                               <label>File</label>
                            </div>
                                <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                           </div>
                          <p>*requied</p>
                         </label>
                    <input type="file" id="b-file" name = "file" placeholder="upload file" >
                        <input type="submit" value="Save and Containue" class="submit-form"/>
                    </form>
                             </div>
      <div class="form-files">


    <div class="header-input">
        <div class="title-label">
           <i><ion-icon name="copy-outline"></ion-icon> </i>
           <label>audio</label>
        </div>
           <ion-icon name="checkmark-done-circle-outline"></ion-icon>
       </div>
      <p>*requied</p>
         </label>
    <input type="file" id="b-audio" name = "baudio" placeholder="upload audio">

    <div class="header-input">
        <div class="title-label">
           <i><ion-icon name="copy-outline"></ion-icon> </i>
           <label>Image</label>
        </div>
           <ion-icon name="checkmark-done-circle-outline"></ion-icon>
       </div>
      <p>*requied</p>
         </label>
    <input type="file" id="b-img" name = "img" placeholder="upload image">
    <img src="img">

    <div class="container">

        <div class="panel panel-primary">
          <div class="panel-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            <img src="images/{{ Session::get('image') }}">
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </div>
            </form>

          </div>
        </div>
    </div>

</div>

    </div>
</div>
@stop
