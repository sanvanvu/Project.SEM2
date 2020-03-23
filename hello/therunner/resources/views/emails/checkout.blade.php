@component('mail::message')
# Kính gửi {{$book->customer_name}}

Cảm ơn quý khách đã sử dụng dịch vụ của The Runner.

<div class="my-container">
    <div class="text-center">
        <h2 class="text-center text-white">Thông tin đặt phòng</h2>

        <small class="text-center text-info">Vui lòng ghi nhớ mã đặt phòng trong trường hợp cần thiết</small>
    </div>
    <div class="container p-5">
        <table class="table table-dark text-left" id="my-table">

            <tbody>
                <tr>
                    <th class="text-orange">Mã đặt phòng</th>
                    <td class="text-justify text-danger">{{$thisBook->id}}</td>
                </tr>

                <tr>
                    <th class="text-orange">Họ và tên</th>
                    <td class="text-justify">{{$thisBook->customer_name}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Email</th>
                    <td class="text-justify">{{$thisBook->customer_email}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Số điện thoại</th>
                    <td class="text-justify">{{$thisBook->phone_number}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Tên phòng chơi</th>
                    <?php
                        $room = \App\Room::find($thisBook->room_id);
                    ?>
                    <td class="text-justify">{{$room->name}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Số người chơi</th>
                    <td class="text-justify">{{$thisBook->number_of_customers}}</td>
                </tr>
                <tr>
                    <th class="text-orange">Thời gian chơi</th>
                    <td class="text-justify">{{date('d/m/Y', strtotime($thisBook->book_date))}} lúc {{date('H:ia', strtotime($thisBook->book_time))}}</td>
                </tr>
                    <?php
                                $codes = \App\discount_code::all();
                                $thiscode = null;
                                foreach($codes as $code){
                                    if($thisBook->code_name == $code->name){
                                        $thiscode = $code;
                                        break;
                                    }
                                }
                    ?>
                @if($thisBook->code_name != null)
                    <tr>
                        <th class="text-orange">Mã giảm giá</th>
                        <td class="text-justify">{{$thisBook->code_name}}

                            @if($thiscode->status==1)
                                (mã không còn hiệu lực)
                            @endif
                        </td>
                    </tr>
                @endif
                <tr>
                    <th class="text-orange">Tổng giá</th>
                    <td class="text-justify">{{$thisBook->price}}VND</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@component('mail::button', ['url' => '#'])
Huỷ đặt phòng
@endcomponent
Hẹn gặp lại quý khách tại The Runner. Quý khách vui lòn đến sớm hơn giờ chơi 15 phút để check-in phòng chơi.
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
