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
                    <h1 class="display-4">Upload Excel & CSV</h1>
                </div>
            </div>
            <form class="form" action="{{ route('import.excel') }}" method='post' enctype="multipart/form-data">
                @csrf
                <div class="header-input">
                    <div class="title-label">
                        <i>
                            <ion-icon name="copy-outline"></ion-icon>
                        </i>
                        <div class="tooltip">File
                            <span class="tooltiptext">Supported Format (xlsx, csv)</span>
                        </div>
                    </div>
                    <a href="/download/templateExample.xlsx" download="templateExample.xlsx">Download Template</a>

                    <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                </div>
                </label>
                <input type="file" id="file" name="file" placeholder="upload file">
                <input type="submit" value="Save and Containue" class="submit-form" />
                
            <a class="btn btn-success" href="{{ route('export.excel') }}">Export data</a>
            </form>
            <div class="container">

                <div class="panel panel-primary">
                    <div class="panel-body">
                        @if ($message = Session::get('success'))
                        <div style="z-index: 999" class="alert alert-success alert-block">
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



                        @stop