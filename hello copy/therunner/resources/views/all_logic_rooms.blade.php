@extends('layouts.allroomsapp')

@section('content')
    <div class="my-container">
        <div class="count">
            <b class="text-white float-right mr-5">Có tất cả <span class="text-info">{{$lsLogical->count()}}</span> thử thách</b>
        </div>
        <br>
        <hr color="#1c1c1c" size="0">
        <div class="row">
            <div class="col-md-3 pl-5">
                <div class="filer">
                    <b class="text-orange">Lọc theo độ khó</b>
                    <form action="" method="get">
                    @csrf
                        <div class="form-group">
                            <input type="radio" id="3sao" name="filter" value="3">
                            <label for="3sao">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </label><br>
                            <input type="radio" id="4sao" name="filter" value="4">
                            <label for="4sao">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </label><br>
                            <input type="radio" id="5sao" name="filter" value="5">
                            <label for="5sao">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </label><br>
                            <input type="radio" id="6sao" name="filter" value="6">
                            <label for="6sao">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </label><br>
                            <input type="radio" id="off" name="filter" value="0">
                            <label for="off" class="text-white">
                                Bỏ bộ lọc
                            </label><br>
                            <input type="submit" value="Chọn" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <hr color="white" size="10">
                <div class="address">
                    <b class="text-orange">Địa chỉ</b>
                    <p class="text-white">
                    The Runner: Số 16, đường Nguyễn Khánh Toàn, Cầu Giấy, Hà Nội
                    </p>
                    <hr color="white" size="10">
                    <p class="text-white">
                    Số 8 Tôn Thất Thuyết, toà nhà Detech
                    </p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php foreach ($lsLogical as $key => $logical): ?>
                        <div class="col-md-6 col-lg-4 mb-4 p-0">
                            <div class="hotel-room text-center rounded">
                            @if($logical->hot==0)
                                <span class="tag rounded">
                                    <b>HOT</b>
                                </span>
                            @endif
                            <a href="room.html?id={{$logical->id}}" class="d-block mb-0 thumbnail"><img src="{{$logical->img}}" alt="Image" class="img-fluid"></a>
                            <div class="hotel-room-body">
                                <h3 class="heading mb-0"><a href="room.html?id={{$logical->id}}">{{$logical->name}}</a></h3>
                                @for($i = 0; $i < $logical->level; $i++)
                                <i class="fas fa-star text-warning"></i>
                                @endfor
                            </div>
                            </div>
                        </div>
                    <?php endforeach; ?>    
                </div>
            </div>
        </div>
    </div>

@endsection
