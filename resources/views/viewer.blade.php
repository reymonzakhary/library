<form class="form" action="{{route('update.html')}}" method='post' enctype="multipart/form-data">
  {{-- {{ csrf_field() }} --}}
  @csrf
  @foreach ($allPages as $page => $value)
  <div>
    <input type="checkbox" id="chapter" name="chapters[]" value="{{$page}}">
    <label for="page">Beginning of the chapter</label><br>
  </div>

  {!! $value !!}
  @endforeach
  <input type="submit" value="Save" class="submit-form" />
  <br></br>

</form>