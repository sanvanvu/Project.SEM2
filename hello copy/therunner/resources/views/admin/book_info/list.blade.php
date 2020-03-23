@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <p>Book information</p>
  <form action="" method="get">
    @csrf
    <label for="">Lọc đơn đặt phòng</label>
    <div class="form-group">
      <input type="radio" id="active" name="filter" value="0">
      <label for="active">
        Active
      </label>
      <input type="radio" id="off" name="filter" value="1">
      <label for="off">
        Canceled
      </label>
      <input type="radio" id="alltrash" name="filter" value="2">
      <label for="alltrash">
        Bỏ bộ lọc
      </label>
      <button class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit">Lọc</button>
    </div>
  </form>

  <form class="form-inline my-2 my-lg-0" method="get">
    @csrf
      <input class="form-control mr-sm-2" type="search" placeholder="Tìm tên khách hàng" aria-label="Search" name="search_title" value="{{$search}}">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
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
      <th>Discount code</th>
      <th>Price</th>
      <th>Canceled at</th>

    </tr>
    @foreach($lsBook as $book)
      <?php
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $current = date("H:ia");
        $today = date('d/m/Y');
        //echo $today;
        $thisroom = "";
      ?>
      @foreach($lsRoom as $room)
        @if($book->room_id==$room->id)
          <?php
            $thisroom = $room->name;
          ?>
          @break
        @endif
      @endforeach
      @if($today > date('d/m/Y', strtotime($book->book_date)) )
        <tr>
          <td><b class="text-secondary">{{$book->id}}</b></td>
          <td class="text-secondary">{{$book->customer_name}}</td>
          <td class="text-secondary">{{$book->customer_email}}</td>
          <td class="text-secondary">{{$book->phone_number}}</td>
          <td class="text-secondary">{{$book->number_of_customers}}</td>
          <td class="text-secondary">{{date('D d/m/Y', strtotime($book->book_date))}}</td>
          <td class="text-secondary">{{date('H:ia', strtotime($book->book_time))}}</td>
          <td class="text-secondary">{{$thisroom}}</td>
          <td class="text-secondary">{{$book->code_name}}</td>
          <td class="text-secondary">{{$book->price}}</td>
          <td class="text-secondary">{{$book->deleted_at}}</td>
        </tr>
      @elseif($book->deleted_at!=null)
        <tr>
          <td><b class="text-danger">{{$book->id}}</b></td>
          <td class="text-danger">{{$book->customer_name}}</td>
          <td class="text-danger">{{$book->customer_email}}</td>
          <td class="text-danger">{{$book->phone_number}}</td>
          <td class="text-danger">{{$book->number_of_customers}}</td>
          <td class="text-danger">{{date('D d/m/Y', strtotime($book->book_date))}}</td>
          <td class="text-danger">{{date('H:ia', strtotime($book->book_time))}}</td>
          <td class="text-danger">{{$thisroom}}</td>
          <td class="text-danger">{{$book->code_name}}</td>
          <td class="text-danger">{{$book->price}}</td>
          <td class="text-danger">{{$book->deleted_at}}</td>
        </tr>
      @else
        <tr>

          <td><b class="text-primary">{{$book->id}}</b></td>
          <td class="text-primary">{{$book->customer_name}}</td>
          <td class="text-primary">{{$book->customer_email}}</td>
          <td class="text-primary">{{$book->phone_number}}</td>
          <td class="text-primary">{{$book->number_of_customers}}</td>
          <td class="text-primary">{{date('D d/m/Y', strtotime($book->book_date))}}</td>
          <td class="text-primary">{{date('H:ia', strtotime($book->book_time))}}</td>
          <td class="text-primary">{{$thisroom}}</td>
          <td class="text-primary">{{$book->code_name}}</td>
          <td class="text-primary">{{$book->price}}</td>
          <td class="text-primary">{{$book->deleted_at}}</td>
        </tr>
      @endif
      
    @endforeach

  </table>
  <div class="align-middle">
    {{$lsBook -> links()}}
  </div>
</div>
@endsection
