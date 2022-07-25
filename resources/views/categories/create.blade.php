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

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Add Category</h1>
                </div>
            </div>
            <form class="form" action="{{ route('categories.store') }}" method='post'>
                {{-- {{ csrf_field() }} --}}
                @csrf
                {{-- title book filed --}}
                <div class="header-input">
                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                    <p>*requied</p>
                </div>

                <div class="input-box">
                    <input type="text" id="b-title" name="title" required="required">
                    <span>Title</span>
                </div><br>
                <br>

                @if ($errors->has('title'))
                <div class="error">{{ $errors->first('title') }}</div>
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
                        <div class="image-book">
                            <img src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&amp;dl=pexels-anjana-c-674010.jpg&amp;fm=jpg" {{-- alt="106,603+ Best Free Color Stock Photos &amp; Images · 100% Royalty-Free HD  Downloads" --}} {{-- data-noaft="1" style="width: 435px; height: 580px; margin: 0px;" --}}>
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