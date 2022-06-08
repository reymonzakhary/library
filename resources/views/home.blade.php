@extends('layout.master')
@section('title','home')
@section('static_body')
@parent()
<div class ="home-main">
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers">
                    {{count($books)}}
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
                 {{count( json_decode($books[0]['categories'])) }}
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
         <a href="#" class="btn">View ALL</a>
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
                    <td>Categories</td>
                    <td>Total pages</td>
                    <td>Published Date</td>
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


                     @if ( $book->img ==null)
                     <td>https://via.placeholder.com/50x80.png/0000cc?text=animals+est</td>
                      @else
                    <td>{{ $book->img}}</td>

                     @endif


                    @if ($book->audio==null)
                     <td>audio</td>
                     @else
                      <td>{{ $book->audio }}</td>

                     @endif


                    @if ($book->file==null)
                    <td>file</td>
                    @else
                    <td>{{ $book->file }}</td>

                    @endif


                   @if ($book->tags==null)
                   <td>tags empty</td>
                   @else
                   <td>{{ json_decode($book->tags)[0] }}</td>
                   @endif

                  @if ($book->totalpages ==null)
                  <td>0</td>
                  @else
                    <td>{{ $book->totalpages }}</td>

                  @endif


                    <td>{{ $book->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>
@stop

