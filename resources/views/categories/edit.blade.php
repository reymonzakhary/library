@extends('layout.master')
@section('title' , 'Edit')
@section('static_body')
@parent
<div class="main-blank">
    <div class=form-blank>
        <div class="form-infromation">
            {{-- list of fileds information  --}}
            <form action="{{route('categories.update', ['category' => $category])}}" method="POST" class="form">
                @method('PATCH')
                @csrf
                <div class="header-input">

                    <div class="title-label">
                        <i>
                            <ion-icon name="search-circle-outline"></ion-icon>
                        </i>
                        <label>Title</label>
                    </div>

                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                <p>*requied</p>
                @if ( $category != null)
                <input type="text" id="b-title" name="title" value="{{$category->title}}"><br>
                <br>
                @else
                <input type="text" id="b-title" name="title" placeholder="Enter your book title" required><br>
                <br>
                @endif
                @if($errors->has('category'))
                <div class="error">{{ $errors->first('category') }}</div>
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