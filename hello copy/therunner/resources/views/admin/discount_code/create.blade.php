@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center text-danger">Add new discount-code</h1>
        <form action="{{asset('discount_code')}}" method="post">
        @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="0" checked>Fixed discount</option>
                    <option value="1">Percentage discount</option>
                </select>
                <label for="value">Value</label>
                <input type="number" id="value" name="value" class="form-control">
                <label for="status">Status</label>
                <select name="status" id="tystatuspe" class="form-control">
                    <option value="0" checked>On</option>
                    <option value="1">Off</option>
                </select>
                <br>
                <input type="submit" name="" value="Add" class="btn btn-primary">         
            </div>
        </form>
    </div>
@endsection