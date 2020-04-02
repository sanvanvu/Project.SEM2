@extends('layouts.roomapp')

@section('content')
<div class="my-container">
    <div class="container p-5">
        <table class="table table-dark text-left" id="my-table">
            
            <tbody>
                <tr>
                    <th class="text-orange">Mã đặt phòng</th>
                    <td class="text-justify">{{$book->id}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Tên phòng chơi</th>
                    <td class="text-justify">{{$room->name}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Họ và tên</th>
                    <td class="text-justify">{{$book->customer_name}}</td>
                </tr>        
                <tr>
                    <th class="text-orange">Email</th>
                    <td class="text-justify">{{$book->customer_email}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Số điện thoại</th>
                    <td class="text-justify">{{$book->phone_number}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Số người chơi</th>
                    <td class="text-justify">{{$book->number_of_customers}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Thời gian chơi</th>
                    <td class="text-justify">{{date('d/m/Y', strtotime($book->book_date))}} lúc {{date('H:ia', strtotime($book->book_time))}}</td>
                </tr>
                @if($book->code_name != null)
                    <tr>
                        <th class="text-orange">Mã giảm giá</th>
                        <td class="text-justify">{{$book->code_name}}
                            @if($thiscode->status==1)
                                (mã không còn hiệu lực)
                            @endif
                        </td>
                    </tr>
                @endif
                <tr>
                    <th class="text-orange">Tổng giá</th>
                    <td class="text-justify">{{$book->price}}VND</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('room.cancel', ['id' => $book->id]) }}"><input type="submit" name="" value="Xác nhận huỷ phòng" class="btn btn-danger"></a>
    </div> 
</div>

@endsection