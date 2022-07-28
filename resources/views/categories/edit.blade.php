@extends('layout.master')
@section('title', 'home')
@section('static_body')
    @parent()

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('books.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a href="{{ route('books.create') }}" class="nav-link"
                                    href="layout-sidenav-light.html">Create</a>
                                <a href="{{ route('upload.excel.file') }}" class="nav-link"
                                    href="layout-sidenav-light.html">Excel</a>

                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a href="{{ route('books.index') }}" class="nav-link" href="layout-static.html">Home</a>
                                <a href="{{ route('categories.index') }}" class="nav-link"
                                    href="layout-sidenav-light.html">Categories</a>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

            <div class="container my-5 py-5">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a style="float: right; font-size: 25px; margin-top: -8px" href="#" class="close"
                            data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> &nbsp; {{ $message }}
                        {{-- <img src="images/{{ Session::get('image') }}"> --}}
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible">
                        <a style="float: right; font-size: 30px; margin-top: 20px; text-decoration: none; font-weight: bold"
                            href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Whoops!</strong> &nbsp; There were some problems with your input.
                        {{-- <img src="images/{{ Session::get('image') }}"> --}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!--Section: Design Block-->
                <section>

                    <div class="row">

                        <div class="col-md-12 mb-4">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="mb-0 text-font text-uppercase">Edit Categories</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('categories.update', ['category' => $category]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf

                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form11Example1">Category Title </label>
                                                    <strong style="color: red; float:right">* Requied</strong>
                                                    @if ($category != null)
                                                        <input type="text" id="b-title" name="title"
                                                            value="{{ $category->title }}" class="form-control" />
                                                    @else
                                                    @endif

                                                </div>
                                                @if ($errors->has('category'))
                                                    <small style="color: red;">
                                                        {{ $errors->first('category') }}</small>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="text-center">
                                            <button style="color: #fff" type="submit"
                                                class="btn btn btn-warning col-md-12">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!--Section: Design Block-->

            </div>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Charisma Design</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        $(".alert").alert('close')
    </script>

@stop
