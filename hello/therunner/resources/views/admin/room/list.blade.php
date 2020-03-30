@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <p>Room management</p>
  <form class="form-inline my-2 my-lg-0" method="get">
    @csrf
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_title" value="">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  <br>
  <a href="room/create" class="btn btn-primary">Add</a>
  <br>
  <p></p>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Type</th>
      <th>Name</th>
      <th>Image</th>
      <th>Description</th>
      <th>Level</th>
      <th>Room price</th>
      <th>Address</th>
      <th>Hot</th>
      <th>Delete</th>
      <th>Update</th>

    </tr>
    @foreach($lsRoom as $room)
      <tr>
        <td><b class="text-danger">{{$room->id}}</b></td>
        <td>
            @if($room->type==0)
                <p>Logical</p>
            @endif
            @if($room->type==1)
                <p>Horror</p>
            @endif
        </td>
        <td class="text-primary">{{$room->name}}</td>
        <td><img src="{{$room->img}}" alt="" width="100px"></td>
        <td width="20%">{{$room->description}}</td>
        <td>
            @for ($i = 1 ; $i <=  $room->level ; $i++)
                <i class="fas fa-star text-warning"></i>
            @endfor  
        </td>
        <td>{{$room->room_price}}k/person</td>
        <td>{{$room->address}}</td>
        <td>
            @if($room->hot==0)
                <p>Hot</p>
            @else   
                <p>Normal</p>
            @endif
            <!-- {{$room->hot}} -->
        </td>
        <td><a href="room/{{$room->id}}/edit" class="btn btn-primary">Update</a></td>
        <td>
          <form method="post" action="room/{{$room->id}}" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('delete')
            <input type="submit" name="" value="Delete" class="btn btn-danger">
          </form>
        </td>
      </tr>
    @endforeach

  </table>
  <div class="align-middle d-flex justify-content-center">
    {{$lsRoom -> links()}}
  </div>
</div>

<script>
  const roomli = document.getElementById('roomli');
  roomli.classList.add('active');
</script>

@endsection