@extends('layouts.roomapp')

@section('style')
<style>
    @media (max-width: 768px){
        .btn-media{
            margin-bottom: 20px;
        }

        .pl-none{
            padding: 15px !important;
        }

        #modal-content{
            width: 80%;
            margin-left: 10%;
            top: 50%;
        }
    }
</style>
@endsection

@section('content')
<div class="my-container">
     <div class="row">
        <div class="col-md-6 pl-5 pl-none">
            <article>
                <h1 class="text-white">{{$room->name}}</h1>
                <span class="text-warning">
                    @if($room->type==0)
                        Logic thinking
                    @endif
                    @if($room->type==1)
                        Courage and team work
                    @endif
                </span>
                <p class="text-white text-justify">{{$room->description}}</p>
            </article>
            <div class="col-md-6 btn-media">
                    <button class="btn btn-warning form-control text-secondary" id="book-button">Đặt phòng</button>
            </div>          
        </div>
        <div class="col-md-6">
            <table class="table table-dark text-left" id="my-table">
            
            <tbody>
                <tr>
                    <th><i class="fas fa-users text-orange"></i> Số người</th>
                    <td class="text-right">2-8 người</td>
                </tr>
                <tr>
                    <th><i class="fas fa-map-marker-alt text-orange"></i> Địa chỉ</th>
                    <td class="text-right">{{$room->address}}</td>
                </tr>
                <tr>
                    <th><i class="fas fa-unlock-alt text-orange"></i> Độ khó</th>
                    <td class="text-right">
                        @for($i = 0; $i < $room->level; $i++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor
                        @for($i = $room->level; $i < 6; $i++)
                            <i class="fas fa-star text-secondary"></i>
                        @endfor
                    </td>
                </tr>
                <tr>
                    <th><i class="fas fa-dollar-sign text-orange"></i></i> Bảng giá</th>
                    <td class="text-right">{{$room->room_price}}000VND/người</td>
                </tr>
            </tbody>
            </table>
        </div>
     </div>   
    
</div>

<div id="modal" class="">
    <div id="modal-content" class="p-5 rounded bg-warning">
        <form action="" method="">
        @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="date" class="form-control" id="book_date" name="book_date" required value="{{$today}}" min="{{$today}}">
                        <input type="hidden" id="id" name="id" value="{{$id}}">
                        <small class="text-muted">Vui lòng chọn ngày chơi</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="submit" value="Xác nhận" class="form-control bg-danger text-white" id="disable-bnt">

                </div>
            </div>
            <div class="" id="submit-div">

            <!-- <button type="submit" class="btn btn-warning"><a href="book.html?id={{$room->id}}?book_date={{$choose_date}}">Chọn ngày chơi</a></button> -->
            </div>


            <script>
                var dateForm = document.getElementById('book_date');
                var subDiv = document.getElementById('submit-div');
                var db = document.getElementById('disable-bnt');
                var a; 

                // db.addEventListener('click', getDate);
                // function getDate(e){
                //     e.preventDefault;
                //     a = dateForm.value;
                //     console.log(a);
                // }
                var getId = "<?php echo $id; ?>";
                db.addEventListener("click", function(event){
                    event.preventDefault();
                    a = dateForm.value;
                    console.log(a);
                    subDiv.innerHTML = `
                    <button class="btn btn-dark"><a href="book.html?id=${getId}&book_date=${a}" class="text-white">Đặt phòng</a></button>
                    `;
                });     

                dateForm.addEventListener("click", closeBtn);
                function closeBtn(){
                    subDiv.innerHTML = '';
                }
            </script>
        </form>         
    </div>
</div>

@endsection