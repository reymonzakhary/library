@extends('layout.master')
@section('title', 'home')
@section('static_body')
    @parent()
    <div class="home-main">
        <div class="Alert-box hide hidden">
            {{ session()->get('success') }}
            <div class="close-alret">
                <ion-icon name="home-outline"></ion-icon>
            </div>
        </div>
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">
                        @if (count($categories) > 0)
                            {{ count($categories) }}
                        @else
                            0
                        @endif

                    </div>
                    <div class="cardName">
                    categories
                    </div>
                </div>
                <div class="iconCard">
                    <ion-icon name="book-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">
                        {{-- @if ($catiegories[0] == null) --}}
                        0
                        {{-- @else
                   {{count ($categories) }}
                  @endif --}}
                    </div>
                    <div class="cardName">
                        Categories
                    </div>
                </div>
                <div class="iconCard">
                    <ion-icon name="people-circle-outline"></ion-icon>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">
                        120
                    </div>
                    <div class="cardName">
                        Users
                    </div>
                </div>
                <div class="iconCard">
                    <ion-icon name="person-outline"></ion-icon>
                </div>
            </div>
        </div>
        <hr>
        <div class="box-table">
            <div class="card-table">
                <div class="cardHeader">
                    <h2>Category Table</h2>
                    <a href="{{route('categories.create')}}" class="btn">Add Category</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Title</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            <tr>
                                <td><span class="title-category">{{ $category->title }}</span></td>

                                <td>{{ $category->created_at}}</td>

                                <td class="Edit">
                                    <a href="{{ route('categories.edit', ['category' => $category]) }}">
                                        <span>Edit</span>
                                    </a>
                                    <td class="Delete">
                                <form method="post" class="delete_form" action="{{ route('categories.destroy', ['category' => $category])}}" >
                                {{ method_field('DELETE') }}
                                {{  csrf_field() }}
                                <button type="submit" class="btn btn-danger">{{ trans('Delete') }}</button>
                             </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-edit">
                <table>
                    <thead>
                        <td></td>
                    </thead>
                    <tbody>
                        {{-- {{count( json_decode($books[0]['category_id'])) }} --}}
                        {{-- @foreach (json_decode($books[0]['category_id']) as $catiegory)
                <tr>
                    <td>{{ $catiegory }}</td>

                </tr>
                @endforeach --}}

                    </tbody>
                </table>

            </div>

        </div>
    </div>
    </div>
    <script>
        const btn = document.querySelector('.btn_alret');
        const alertBox = document.querySelector('.Alert-box');
        const closeAlertBox = document.querySelector('.close-alret');
        let timer;

        @if (session()->has('success'))
            showAlretBox();
        @endif


        function showAlretBox() {
            alertBox.classList.remove("hide");
            alertBox.classList.add("show");
            if (alertBox.classList.contains("hidden")) {
                alertBox.classList.remove("hidden");
            }

            timer = setTimeout(() => {
                hideAlretBox();
            }, 5000);

        }

        function hideAlretBox() {
            alertBox.classList.remove("show");
            alertBox.classList.add("hide");
        }
    </script>

@stop
