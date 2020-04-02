@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h1 style="font-size: 2rem;" class="text-primary text-center">Thông tin đơn đặt hàng ({{$count}} đơn)</h1>
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

      <input class="form-control mr-sm-2 w-50 mb-2" type="search" placeholder="Tên khách hàng" aria-label="Search" name="search_title">
      <input type="date" class="form-control w-50 mb-2" name="date">
      <input class="form-control btn btn-success my-sm-0 w-25" type="submit" value="Lọc">
    </div>
  </form>

  <!-- <form class="form-inline my-2 my-lg-0" method="get">
    @csrf
    <input class="form-control mr-sm-2" type="search" placeholder="Tìm tên khách hàng" aria-label="Search" name="search_title" value="{{$search}}">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
  </form> -->
  <br>
  <p></p>

  <div class="row">
    <?php
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $current = date("H:ia");
    $today = date('Y/m/d');
    ?>
    @foreach($lsBook as $book)
    <?php
    $thisRoom = "";
    foreach ($lsRoom as $room) {
      if ($book->room_id == $room->id) {
        $thisRoom = $room;
        // dd($room);
        break;
      }
    }
    ?>
    <div class="col-md-4 col-sm-4">
      <div class="jumbotron">
        @if(date('Y/m/d', strtotime($book->book_date)) < $today && !$book->deleted_at)
        <h1 class="display-4 text-secondary" style="font-size: 2rem;">Đơn đặt phòng <span class="text-danger">{{$book->id}}</span></h1>
        @elseif($book->deleted_at)
        <h1 class="display-4 text-danger" style="font-size: 2rem;">Đơn đặt phòng <span class="text-danger">{{$book->id}}</span></h1>
        @else
        <h1 class="display-4 text-primary" style="font-size: 2rem;">Đơn đặt phòng <span class="text-danger">{{$book->id}}</span></h1>
        @endif

        <p>Khách hàng: {{$book->customer_name}}</p>
        <p>Email: {{$book->customer_email}}</p>
        <p>Số điện thoại: {{$book->phone_number}}</p>
        <p>Ngày chơi: {{date('D d/m/Y', strtotime($book->book_date))}} lúc {{date('H:ia', strtotime($book->book_time))}}</p>
        <p>
          Phòng chơi: {{$thisRoom->name}}
        </p>
        <img src="{{$thisRoom->img}}" alt="" width="25%">
        @if($book->deleted_at)
        <small>Đơn đã huỷ ngày {{date('d/m/Y', strtotime($book-> deleted_at))}}</small>
        @endif
      </div>
    </div>
    @endforeach
  </div>



  <div class="d-flex justify-content-center">
    <div>
      {{$lsBook -> links()}}
    </div>
  </div>
</div>

<script>
  const bookli = document.getElementById('bookli');
  bookli.classList.add('active');
</script>
@endsection