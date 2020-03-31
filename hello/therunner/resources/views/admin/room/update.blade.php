@extends('layouts.app')

@section('content')
<div class="container">
        <h1 class="text-center text-danger">Update room</h1>
        <form action="{{asset('room')}}/{{$room->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    @if($room->type==0)
                    <option value="0" checked>Logical</option>
                    <option value="1">Horror</option>
                    @endif
                    @if($room->type==1)
                    <option value="1" checked>Horror</option>
                    <option value="0">Logical</option>
                    @endif
                </select>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$room->name}}">
                <label for="image">Image</label>
                <!-- <input type="file" id="image" name="image" class="form-control" value="{{$room->img}}"> -->
                <input type="text" id="image" name="image" class="form-control" value="{{$room->img}}">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$room->description}}</textarea>
                <!-- <input type="text" id="description" name="description" class="form-control"> -->
                <label for="level">Level</label>
                <input type="number" id="level" name="level" class="form-control" value="{{$room->level}}">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="{{$room->room_price}}">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" value="{{$room->address}}">
                <div>
                    <label for="popular">Hot</label>
                    @if($room->hot==0)
                    <select name="hot" id="popular" class="form-control">
                        <option value="0" checked>Hot</option>
                        <option value="1">Normal</option>
                    </select>
                    @endif
                    @if($room->hot==1)
                    <select name="hot" id="popular" class="form-control">
                        <option value="1" checked>Normal</option>
                        <option value="0" >Hot</option>
                    </select>
                    @endif
                </div>
                
                <br>
                <input type="submit" name="" value="Update" class="btn btn-primary">             
            </div>
        </form>
    </div>
@endsection