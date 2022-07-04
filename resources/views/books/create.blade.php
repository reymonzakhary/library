@extends('layout.master')
@section('title', 'blank')
@section('static_body')
    @parent
    <div class="main-blank">
        <div class=form-blank>
            <div class="form-infromation">
                {{-- list of fileds information --}}
                @if ($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif
                <form class="form" action="{{route('books.store')}}" method='post'>
                    {{-- {{ csrf_field() }} --}}
                    @csrf
                    {{-- title book filed --}}
                    <div class="header-input">
                        <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                        <p>*requied</p>
                    </div>

                    <div class="input-box">
                        <input type="text" id="b-title" name="title" required="required">
                        <span>Title Book</span>
                    </div><br>
                    <br>

                    @if ($errors->has('title'))
                        <div class="error">{{ $errors->first('title') }}</div>
                    @endif
                    {{-- book author filed --}}
                    <div class="header-input">
                        <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                        <p>*requied</p>
                    </div>

                    <div class="input-box">
                        <input type="text" id="b-author" name="author" required="required">
                        <span>Author Book</span>
                    </div><br>
                    <br>
                    @if ($errors->has('author'))
                        <div class="error">{{ $errors->first('author') }}</div>
                    @endif
                    {{-- book description filed --}}
                    <div class="header-input">
                        <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                        <p>*requied</p>
                    </div>

                    <div class="input-box">
                        <textarea class="desc" type="text" id="b-content" name="content" cols="40" rows="6" required="required"></textarea>
                        <span>Description book</span>
                    </div><br>
                    <br>
                    @if ($errors->has('content'))
                        <div class="error">{{ $errors->first('content') }}</div>
                    @endif

                    {{-- book Categories section --}}
                    <div class="header-input">
                        <div class="title-label">
                            <i>
                                <ion-icon name="copy-outline"></ion-icon>
                            </i>
                            <label>Categories</label>
                        </div>
                        <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                    </div><br>

                    <select id="books" name="category_id" size="1" class="categories-dropdown">
                        <option value="1">Drama</option>
                        <option value="2">Science Fiction</option>
                        <!-- <option value="family">family</option>
                        <option value="action">action</option>
                        <option value="drama">drama</option>
                        <option value="fantacy">fantacy</option> -->
                    </select><br><br>
                    <div class="header-input">
                        <div class="title-label">
                            <i>
                                <ion-icon name="copy-outline"></ion-icon>
                            </i>
                            <label>File</label>
                        </div>
                        <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                    </div>
                    </label>
                    <input type="file" id="b-file" name="file" placeholder="upload file">
                    <input type="submit" value="Save and Containue" class="submit-form" />
                </form>
            </div>
            <div class="form-files">


                <div class="header-input">
                    <div class="title-label">
                        <i>
                            <ion-icon name="copy-outline"></ion-icon>
                        </i>
                        <label>audio</label>
                    </div>
                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                <p>*requied</p>
                </label>
                <input type="file" id="b-audio" name="baudio" placeholder="upload audio">

                <div class="header-input">
                    <div class="title-label">
                        <i>
                            <ion-icon name="copy-outline"></ion-icon>
                        </i>
                        <label>Image</label>
                    </div>
                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                <p>*requied</p>
                </label>
                <input type="file" id="b-img" name="img" placeholder="upload image">
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
                            <div class="image-book">
                                <img src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&amp;dl=pexels-anjana-c-674010.jpg&amp;fm=jpg"
                                    {{-- alt="106,603+ Best Free Color Stock Photos &amp; Images · 100% Royalty-Free HD  Downloads" --}}
                                    {{-- data-noaft="1" style="width: 435px; height: 580px; margin: 0px;" --}}>
                            </div>

                            {{-- <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </div>
            </form> --}}

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@stop
