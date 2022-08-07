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
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <a style="float: right; font-size: 25px; margin-top: -8px;  text-decoration: none; font-weight: bold"
                        href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> &nbsp; {{ $message }}
                    {{-- <img src="images/{{ Session::get('image') }}"> --}}
                </div>
            @endif
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Books</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <span style="float: left; font-size: 40px; font-weight:bold">
                                        Books
                                    </span>
                                    <strong>
                                        @if (count($books) > 0)
                                            {{ count($books) }}
                                        @else
                                            0
                                        @endif
                                    </strong>

                                    <span style="float: right">
                                        <i class="fa fa-book fa-4x" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Books</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <span style="float: left; font-size: 40px; font-weight:bold">
                                        Categories
                                    </span>
                                    <strong>
                                        @if (count($books) > 0)
                                            {{ count($books) }}
                                        @else
                                            0
                                        @endif
                                    </strong>

                                    <span style="float: right">
                                        <i class="fa fa-list-alt fa-4x" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Categories</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <span style="float: left; font-size: 40px; font-weight:bold">
                                        Users
                                    </span>
                                    <strong>
                                        @if (count($books) > 0)
                                            {{ count($books) }}
                                        @else
                                            0
                                        @endif
                                    </strong>

                                    <span style="float: right">
                                        <i class="fa fa-users fa-4x" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Users</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <span style="float: left; font-size: 40px; font-weight:bold">
                                        Books
                                    </span>
                                    <strong>
                                        @if (count($books) > 0)
                                            {{ count($books) }}
                                        @else
                                            0
                                        @endif
                                    </strong>

                                    <span style="float: right">
                                        <i class="fa fa-book fa-4x" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <div style="float: left">
                                <i class="fas fa-table me-1"></i>
                                Books Table
                            </div>
                            <a href="{{ route('export.excel') }}" style="float: right">
                                <i class="fas fa-arrow-down me-1"></i>
                                Download List
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Authors</th>
                                        <th>Description</th>
                                        <th>Rate</th>
                                        <th>Cover</th>
                                        <th>Audio</th>
                                        <th>File</th>
                                        <th>Category</th>
                                        <th>Total Pages</th>
                                        <th>Published Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Authors</th>
                                        <th>Description</th>
                                        <th>Rate</th>
                                        <th>Cover</th>
                                        <th>Audio</th>
                                        <th>File</th>
                                        <th>Category</th>
                                        <th>Total Pages</th>
                                        <th>Published Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ Str::substr($book->title, 0, 10) }}...</td>

                                            <td>{{ Str::substr($book->author, 0, 10) }}...</td>

                                            <td>{{ Str::substr($book->content, 0, 10) }}...</td>

                                            @if ($book->rate == null)
                                                <td>0</td>
                                            @else
                                                <td>{{ $book->rate }}</td>
                                            @endif


                                            @if ($book->img == null)
                                                <td>{{ Str::substr($book->img, 0, 10) }}...</td>
                                            @else
                                                <td>{{ Str::substr($book->img, 0, 10) }}...</td>
                                            @endif


                                            @if ($book->audio == null)
                                                <td>{{ Str::substr($book->audio, 0, 10) }}...</td>
                                            @else
                                                <td>{{ Str::substr($book->audio, 0, 10) }}...</td>
                                            @endif


                                            @if ($book->file == null)
                                                <td>{{ Str::substr($book->file, 0, 10) }}...</td>
                                            @else
                                                <td>{{ Str::substr($book->file, 0, 10) }}...</td>
                                            @endif


                                            @if ($book->category_id == null)
                                                <td>tags empty</td>
                                            @else
                                                <td>{{ $book->category['title'] }}</td>
                                            @endif

                                            @if ($book->totalpages == null)
                                                <td>0</td>
                                            @else
                                                <td>{{ $book->totalpages }}</td>
                                            @endif
                                            <td>{{ $book->created_at }}</td>

                                            <td style="text-align: center">
                                                <a style="color: #FFC107"
                                                    href="{{ route('books.edit', ['book' => $book]) }}">
                                                    <span>
                                                        <i class="fa fa-edit fa-2x" aria-hidden="true"></i>

                                                    </span>
                                                </a>
                                            </td>
                                            <td style="text-align: center">
                                                <form method="post" class="delete_form"
                                                    action="{{ route('books.destroy', ['book' => $book]) }}">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit"
                                                        style="background: none; border: none; color: #DC3545">
                                                        <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>

                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
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


@stop
