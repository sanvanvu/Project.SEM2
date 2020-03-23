@extends('layouts.roomapp')

@section('content')

<div class="my-container">
    <div class="container p-5">
        <h2 class="text-white">{{$room->name}}</h2>
        <p class="text-white"><b class="text-orange">Địa chỉ:</b> {{$room->address}}</p>
        <p class="text-white"><b class="text-orange">Ngày chơi:</b> {{date('D d/m/Y', strtotime($mydate))}}</p>
        <div class="row bg-dark rounded">
            <div class="col-md-7">
                <form class="p-3" method="post" action="{{asset('fe')}}">
                @csrf
                    <div class="form-group">
                        <label for="name" class="text-white">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-white">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="text-white">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                            <div class="form-group">
                                <label for="numbers" class="text-white">Số người chơi</label>
                                <select id="numbers" name="numbers" class="form-control" required>
                                    <option value="0" selected disabled>Chọn số người chơi</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                                <br>
                                <input type="submit" id="check-people" value="Xác nhận giá" class="form-control bg-info border-0 text-white">
                            </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="book_date" name="book_date" value="{{$mydate}}">
                        <input type="hidden" class="form-control" id="room_id" name="room_id" value="{{$id}}">
                    </div>
                    <div class="form-group">
                        <label for="book_time" class="text-white">Giờ chơi</label>
                        <?php
                            date_default_timezone_set("Asia/Ho_Chi_Minh");
                            $current = date("H:ia");
                            $today = date('D d/m/Y');
                            // echo $today;
                        ?>
                        <select id="book_time" name="book_time" class="form-control" required>
                            <option value="0" selected disabled>Chọn giờ chơi</option>
                            @if(date('D d/m/Y', strtotime($mydate)) == $today)
                                @foreach($lsTime as $time)
                                    @foreach($lsBook as $book)
                                        @if($book->book_time==$time->time && $book->book_date==$mydate && $book->room_id == $room->id)
                                            <?php
                                                $check = 1;
                                            ?>
                                        @elseif(date("H:ia", strtotime($time->time)) < $current)
                                            <?php
                                                $check = 2;
                                            ?>
                                        @endif
                                    @endforeach
                                    @if($check==1)
                                        <option value="{{$time->time}}" disabled>{{date("g:ia", strtotime($time->time))}} (hết chỗ)</option>
                                    @elseif($check==2)
                                        <option value="{{$time->time}}" disabled>{{date("g:ia", strtotime($time->time))}} (quá giờ)</option>
                                    @else
                                        <option value="{{$time->time}}">{{date("g:ia", strtotime($time->time))}}</option>
                                    @endif
                                            <?php
                                                $check = 0;
                                            ?>
                                @endforeach
                            @else
                                @foreach($lsTime as $time)
                                    @foreach($lsBook as $book)
                                        @if($book->book_time==$time->time && $book->book_date==$mydate && $book->room_id == $room->id)
                                            <?php
                                                $check = 1;
                                            ?>
                                        @endif
                                    @endforeach
                                    @if($check==1)
                                        <option value="{{$time->time}}" disabled>{{date("g:ia", strtotime($time->time))}} (hết chỗ)</option>
                                    @else
                                        <option value="{{$time->time}}">{{date("g:ia", strtotime($time->time))}}</option>
                                    @endif
                                            <?php
                                                $check = 0;
                                            ?>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code" class="text-white">Mã giảm giá (nếu có)</label>
                        <input type="text" class="form-control" id="code" name="code">
                    </div>
                    <div id="priceTag">

                    </div> <br>
                    <script>
                        var numberForm = document.getElementById('numbers');
                        var pt = document.getElementById('priceTag');
                        var price = "<?php echo $room->room_price; ?>";
                        var checkBtn = document.getElementById('check-people');

                        checkBtn.addEventListener('click', calculate);

                        function calculate(e){
                            e.preventDefault();
                            var a = numberForm.value;
                            var total = a*price;
                            pt.innerHTML = `<p class="text-white">Price: <span class="text-orange">${total}k</span> (${a} người, ${price}k/người)</p>`;
                        }

                        if(performance.navigation.type == 2){
                            location.reload(true);
                        }
                    </script>
                    <button type="submit" class="btn btn-warning">Xác nhận đặt phòng</button>

                </form>
            </div>
            <div class="col-md-5 pt-5">
                <p class="text-white text-justify">
                <b>Điều khoản:</b> <br><br>
                Cảm ơn quý khách,

                The Runner sẽ gọi điện để xác nhận lại việc đặt chỗ của quý khách từ 3-6 tiếng trước giờ chơi. Trong trường hợp không liên lạc được quá 2 lần, chúng tôi sẽ buộc phải hủy việc đặt trước của quý khách.
                Xin quý khách vui lòng đến trước giờ chơi 15 phút để được phổ biến luật chơi
                <br><br>
                <span class="text-orange">Chú ý: Giá vé có thể thay đổi trong ngày nghỉ lễ hoặc các dịp đặc biệt khác.</span>
                <br><br>
                Hẹn gặp lại quý khách tại The Runner!
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
