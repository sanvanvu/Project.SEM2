@extends('layouts.allroomsapp')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="filer">
                    <b>Lọc theo độ khó:</b>
                    <form action="/action_page.php">
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1"> I have a bike</label><br>
                    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                    <label for="vehicle2"> I have a car</label><br>
                    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                    <label for="vehicle3"> I have a boat</label><br><br>
                    <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
            <div class="col-md-9"></div>
        </div>
    </div>

@endsection
