@extends('layouts.app')

@section('content')
<div class="container">
  <p>Discount code management</p>
  <form class="form-inline my-2 my-lg-0" method="get">
    @csrf
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_title" value="">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  <br>
  <a href="discount_code/create" class="btn btn-primary">Add</a>
  <br>
  <p></p>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Type</th>
      <th>Value</th>
      <th>Status</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    @foreach($lsCode as $code)
      <tr>
        <td><b class="text-danger">{{$code->id}}</b></td>
        <td class="text-primary">{{$code->name}}</td>
        <td>
            @if($code->type==0)
                <p>Fixed discount</p>
            @endif
            @if($code->type==1)
                <p>Percentage discount</p>
            @endif
        </td>
        <td>{{$code->value}}</td>
        <td>
            @if($code->status==0)
                <p>On</p>
            @endif
            @if($code->status==1)
                <p>Off</p>
            @endif
        </td>
        <td><a href="discount_code/{{$code->id}}/edit" class="btn btn-primary">Update</a></td>
        <td>
          <form method="post" action="discount_code/{{$code->id}}" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('delete')
            <input type="submit" name="" value="Delete" class="btn btn-danger">
          </form>
        </td>
      </tr>
    @endforeach

  </table>
  <div class="align-middle d-flex justify-content-center">
    {{$lsCode -> links()}}
  </div>
</div>

<script>
  const codeli = document.getElementById('codeli');
  codeli.classList.add('active');
</script>

@endsection