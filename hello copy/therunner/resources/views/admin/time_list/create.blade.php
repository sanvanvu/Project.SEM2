@extends('layouts.app')

@section('content')
<div class="container">
        <h1 class="text-center text-danger">Add time</h1>
        <form action="{{asset('time_list')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                
                <label for="time">Time</label>
                <input type="time" id="time" name="time" class="form-control">
                <br>
                <input type="submit" name="" value="Add" class="btn btn-primary">
                
            </div>
        </form>
    </div>
@endsection