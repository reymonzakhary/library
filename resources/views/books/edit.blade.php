@extends('layout.master')
@section('title' , 'Edit')
@section('static_body')
@parent
<div class="main-blank">
    <div class=form-blank>
        <div class="form-infromation">
            {{-- list of fileds information  --}}
            <form action="{{route('books.update', ['book' => $book])}}" method="POST" enctype="multipart/form-data" class="form">
                @method('PATCH')
                @csrf
                <div class="header-input">

                    <div class="title-label">
                        <i>
                            <ion-icon name="search-circle-outline"></ion-icon>
                        </i>
                        <label>Title Book</label>
                    </div>

                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                <p>*requied</p>
                @if ( $book != null)
                <input type="text" id="b-title" name="title" value="{{$book->title}}"><br>
                <br>
                @else
                <input type="text" id="b-title" name="title" placeholder="Enter your book title" required><br>
                <br>
                @endif

                @if($errors->has('title'))
                <div class="error">{{ $errors->first('title') }}</div>
                @endif
                {{-- book author filed --}}
                <div class="header-input">

                    <div class="title-label">
                        <i>
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </i>
                        <label>Author Book</label>
                    </div>
                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                <p>*requied</p>
                <input type="text" id="b-author" name="author" value="{{ $book->author }}" required><br>
                <br>
                @if($errors->has('author'))
                <div class="error">{{ $errors->first('author') }}</div>
                @endif
                <div class="header-input">

                    <div class="title-label">
                        <i>
                            <ion-icon name="create-outline"></ion-icon>
                        </i>
                        <label>Description</label>
                    </div>
                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                <p>*requied</p>
                <textarea class="desc" type="text" id="b-content" name="content" placeholder="Enter your descpription book example (my book ..)" cols="40" rows="6" required>{{ $book->content }}</textarea><br>
                <br>
                @if($errors->has('content'))
                <div class="error">{{ $errors->first('content') }}</div>
                @endif
                <div class="header-input">
                    <div class="title-label">
                        <i>
                            <ion-icon name="copy-outline"></ion-icon>
                        </i>
                        <label>Categories</label>
                    </div>
                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                <p>*requied</p>
                <select id="books" name="category_id" size="1" class="categories-dropdown">
                    <option value="1">Drama</option>
                    <option value="2">Science Fiction</option>
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
                @if ($book->file == null)
                <input type="file" id="b-file" name="file" placeholder="upload file">
                @else
                <label>{{ $book->file }}</label>
                <input type="file" id="b-file" name="file">
                @endif
                <div class="header-input">
                    <div class="title-label">
                        <i>
                            <ion-icon name="copy-outline"></ion-icon>
                        </i>
                        <label>audio</label>
                    </div>
                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                </label>
                @if ($book->audio == null)
                <input type="file" id="b-audio" name="audio" placeholder="upload audio">
                @else
                <label>{{ $book->audio }}</label>
                <input type="file" id="b-audio" name="audio">
                @endif
                <div class="header-input">
                    <div class="title-label">
                        <i>
                            <ion-icon name="copy-outline"></ion-icon>
                        </i>
                        <label>Image</label>
                    </div>
                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                </label>
                @if ($book->img == null)
                <input type="file" id="b-img" name="img" placeholder="upload image">
                <img src="{{ storage_path().'/images/'.$book->img }}" alt="" title=""></a>
                @else
                <label>{{ $book->img }}</label>
                <input type="file" id="b-img" name="img">
                @endif
                <input type="submit" value="Save and Containue" class="submit-form" />

            </form>
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

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@stop