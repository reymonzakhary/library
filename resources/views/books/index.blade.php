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
                        @if (count($books) > 0)
                            {{ count($books) }}
                        @else
                            0
                        @endif

                    </div>
                    <div class="cardName">
                        Books
                    </div>
                </div>
                <div class="iconCard">
                    <ion-icon name="book-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">
 
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
                    <h2>Book Table</h2>
                    <a href="/home" class="btn">View ALL</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Authors</td>
                            <td>Description</td>
                            <td>Rate</td>
                            <td>Cover</td>
                            <td>Audio</td>
                            <td>File</td>
                            <td>Category</td>
                            <td>Total pages</td>
                            <td>Published Date</td>

                            <td> </td><br>
                            <td> </td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($books as $book)
                            <tr>
                                <td><span class="title-book">{{ $book->title }}</span></td>

                                <td>{{ $book->author }}</td>

                                <td>{{ Str::substr($book->content, 0, 20) }}...</td>

                                @if ($book->rate == null)
                                    <td>0</td>
                                @else
                                    <td>{{ $book->rate }}</td>
                                @endif


                                @if ($book->img == null)
                                    <td>https://via.placeholder.com/50x80.png/0000cc?text=animals+est</td>
                                @else
                                    <td>{{ $book->img }}</td>
                                @endif


                                @if ($book->audio == null)
                                    <td>audio</td>
                                @else
                                    <td>{{ $book->audio }}</td>
                                @endif


                                @if ($book->file == null)
                                    <td>file</td>
                                @else
                                    <td>{{ $book->file }}</td>
                                @endif


                                @if ($book->category_id == null)
                                    <td>tags empty</td>
                                @else
                                    <td>{{ ($book->category['title']) }}</td>
                                @endif

                                @if ($book->totalpages == null)
                                    <td>0</td>
                                @else
                                    <td>{{ $book->totalpages }}</td>
                                @endif
                                <td>{{ $book->created_at }}</td>

                                <td class="Edit">
                                    <a href="{{ route('edit-book', ['book' => $book]) }}">
                                        <span>Edit</span>
                                    </a>
                                </td>
                                @method('delete')
                                <td class="Delete">
                                    <a href="{{ route('delete-bk', ['bookCloud' => $book]) }}">Delete</a>
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
