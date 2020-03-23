@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center text-danger">Add new room</h1>
        <form action="{{asset('room')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="0" checked>Logical</option>
                    <option value="1">Horror</option>
                </select>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                <!-- <input type="text" id="description" name="description" class="form-control"> -->
                <label for="level">Level</label>
                <input type="number" id="level" name="level" class="form-control">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control">
                <div>
                    <label for="popular">Hot</label>
                    <select name="hot" id="popular" class="form-control">
                        <option value="0" checked>Hot</option>
                        <option value="1">Normal</option>
                    </select>
                </div>
                
                <br>
                <input type="submit" name="" value="Add" class="btn btn-primary">
                
            </div>
        </form>
    </div>
@endsection