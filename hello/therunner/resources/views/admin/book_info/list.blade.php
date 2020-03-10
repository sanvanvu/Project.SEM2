@extends('layouts.app')

@section('content')
<div class="container">
  <p>Book information</p>
  <form class="form-inline my-2 my-lg-0" method="get">
    @csrf
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_title" value="">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  <br>
  <a href="book/create" class="btn btn-primary">Add</a>
  <br>
  <p></p>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone number</th>
      <th>Number of customers</th>
      <th>Date</th>
      <th>Time</th>
      <th>Room</th>
      <th>Status</th>
      <th>Discount code</th>
      <th>Price</th>
      <th></th>
      <th></th>
    </tr>
    @foreach($lsBook as $book)
      <tr>
        <td><b class="text-danger">{{$book->id}}</b></td>
        <td class="text-primary">{{$book->customer_name}}</td>
        <td class="text-primary">{{$book->customer_email}}</td>
        <td class="text-primary">{{$book->phone_number}}</td>
        <td class="text-primary">{{$book->number_of_customers}}</td>
        <td class="text-primary">{{$book->book_date}}</td>
        <td class="text-primary">{{$book->book_time}}</td>
        <td class="text-primary">{{$book->room_id}}</td>
        <td class="text-primary">{{$book->status}}</td>
        <td class="text-primary">{{$book->code_name}}</td>
        <td class="text-primary">{{$book->price}}</td>
      </tr>
    @endforeach

  </table>
  
</div>
@endsection
