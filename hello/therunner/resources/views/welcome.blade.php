@extends('layouts.userapp')

@section('content')
<div class="site-section bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto text-center mb-5 section-heading">
            <h2 class="mb-5">Our Rooms</h2>
          </div>
        </div>
        <div class="row">

        <?php foreach ($lsLogical as $key => $logical): ?>

            <div class="col-md-6 col-lg-4 mb-5">
            <div class="hotel-room text-center">
              <a href="#" class="d-block mb-0 thumbnail"><img src="{{$logical->img}}" alt="Image" class="img-fluid"></a>
              <div class="hotel-room-body">
                <h3 class="heading mb-0"><a href="#">{{$logical->name}}</a></h3>
                <strong class="price">$350.00 / per night</strong>
              </div>
            </div>
          </div>
        <?php endforeach; ?>    

          
          
        </div>
      </div>
    </div>
@endsection
