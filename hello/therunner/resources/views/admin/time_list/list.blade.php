@extends('layouts.app')

@section('content')
<div class="container">
  <p>Time management</p>
  <form class="form-inline my-2 my-lg-0" method="get">
    @csrf
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_title" value="">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  <br>
  <a href="time_list/create" class="btn btn-primary">Add</a>
  <br>
  <p></p>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Time</th>
      <th>Delete</th>
    </tr>
    @foreach($lsTime as $time)
      <tr>
        <td><b class="text-danger">{{$time->id}}</b></td>
        <td class="text-primary">{{$time->time}}</td>
        <td>
          <form method="post" action="time_list/{{$time->id}}" onsubmit="return confirm('Are you sure?')">
              @csrf
              @method('delete')
              <input type="submit" name="" value="Delete" class="btn btn-danger">
          </form>
        </td>
      </tr>
    @endforeach

  </table>
</div>

<script>
  const timeli = document.getElementById('timeli');
  timeli.classList.add('active');
</script>
@endsection