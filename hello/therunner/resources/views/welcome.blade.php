@extends('layouts.userapp')

@section('style')
<style>
    @media (max-width: 1000px) and (min-width: 768px) {
        .text-media {
            font-size: 0.7rem !important;
        }

        .hmedia {
            font-size: 0.7rem !important;
        }
    }

    @media (max-width: 768px){
        .content-media{
            padding: 10px !important;
        }
    }
</style>

@endsection

@section('content')
<div class="site-section bg-dark">
    <div class="container pt-5">
        <div class="d-flex text-white mb-4">
            <p>
                <b class="mr-3 ">LOGIC CHALLENGE</b>
                <a href="logicalchallenges.html" class="text-white view-all">Xem tất cả</a> >
            </p>
        </div>
        <div class="row mb-5">
            <?php foreach ($lsLogical as $key => $logical) : ?>

                <div class="col-md-4 col-lg-4 mb-2 less-margin">
                    <div class="hotel-room text-center rounded mb-4">
                        @if($logical->hot==0)
                        <span class="tag rounded">
                            <b>HOT</b>
                        </span>
                        @endif
                        <a href="room.html?id={{$logical->id}}" class="d-block mb-0 thumbnail"><img src="{{ asset($logical->img) }}" alt="Image" class="img-fluid"></a>
                        <div class="hotel-room-body">
                            <h4 class="heading mb-0 hmedia"><a href="room.html?id={{$logical->id}}">{{$logical->name}}</a></h4>
                            @for($i = 0; $i < $logical->level; $i++)
                                <i class="fas fa-star text-warning"></i>
                                @endfor
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

    <div id="intro">
        <div class="content-wrap p-5 d-flex align-items-center content-media">
            <div class="text-center">
                <h4 class="text-warning">The Runner</h4>
                <p class="content-text">
                    Nếu bạn đang tìm kiếm các hoạt động xây dựng đội nhóm như một cách để tăng cường và cải thiện khả năng sáng tạo, giao tiếp và ủy thác giữa các nhân viên của mình, các trò chơi xây dựng đội ngũ The Runner của chúng tôi sẽ thúc đẩy việc sử dụng các chiến lược trong thế giới thực. Mỗi trò chơi trình bày một môi trường độc đáo và tương tác, trong đó mọi người đóng góp cho ý tưởng xây dựng đội nhóm. Tất cả những người tham gia đóng góp vào việc học tập chung và tăng tính kết nối trong một môi trường thú vị và hấp dẫn có thể được thiết kế cho các loại tính cách khác nhau. Những trò chơi này châm ngòi cuộc trò chuyện xung quanh các kỹ năng được phát triển và chiến lược nhóm được sử dụng để hoàn thành các mục tiêu cuối cùng. Họ cũng khuyến khích sự phản ánh về những gì việc có thể được thực hiện tốt hơn. Chúng tôi cung cấp các tùy chọn cho các đội thuộc mọi quy mô! Liên hệ với chúng tôi hôm nay và để chúng tôi tổ chức xây dựng đội ngũ của bạn ở bất kỳ địa điểm nào của chúng tôi trên toàn quốc.
                </p>
            </div>
        </div>
    </div>

    <div class="container pt-5 mb-4">
        <div class="d-flex text-white">
            <p>
                <b class="mr-3 ">HORROR CHALLENGE</b>
                <a href="horrorchallenges.html" class="text-white view-all">Xem tất cả</a> >
            </p>
        </div>

        <!-- <div class="row pb-5"> 
 
        </div> -->

    </div>
    <div id="horror">
        <div class="content-wrap">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-5 d-flex align-items-center content-media">
                        <div class="text-center">
                            <h4 class="text-warning">Horror challenge</h4>
                            <p class="content-text text-media">
                                The Runner - Horror challenge là một trò chơi trải nghiệm không gian, được tái hiện từ những câu chuyện bí ẩn vẫn hiện hữu xung quanh chúng ta. Đó là các vụ trọng án kì bí chưa có lời giải hay những hiện tượng lạ xảy ra hàng đêm.
                                <br><br>
                                Không chỉ có bối cảnh thực tế, Horror challenge còn gây “ám ảnh” bởi sự xuất hiện của nhân vật phụ là người thật xuyên suốt trò chơi. Chính sự kết hợp khéo léo giữa 2 yếu tố này, Horror challenge mang đến những trải nghiệm hơn cả điện ảnh.
                                <br><br>
                                Nếu là một fan của những hiện tượng siêu nhiên, của những điều bí ẩn và đam mê sự hồi hộp kịch tích của nhưng phi vụ điều tra trong bóng tối thì We-X chính là trải nghiệm dành riêng cho bạn.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="row">
                        <?php foreach ($lsHorror as $key => $logical) : ?>
                            <div class="col-md-6 pt-4">
                                <div class="hotel-room text-center rounded">
                                    @if($logical->hot==0)
                                    <span class="tag rounded">
                                        <b>HOT</b>
                                    </span>
                                    @endif
                                    <a href="room.html?id={{$logical->id}}" class="d-block mb-0 thumbnail"><img src="{{$logical->img}}" alt="Image" class="img-fluid"></a>
                                    <div class="hotel-room-body">
                                        <h4 class="heading mb-0 hmedia"><a href="room.html?id={{$logical->id}}">{{$logical->name}}</a></h4>
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
    </div>

</div>

@endsection