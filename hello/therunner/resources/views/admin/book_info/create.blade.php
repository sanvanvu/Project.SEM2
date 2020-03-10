@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center text-danger">Book a room</h1>
        <form action="{{asset('book')}}" method="post">
        @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control">
                <label for="phone">Phone number</label>
                <input type="text" id="phone" name="phone" class="form-control">
                <label for="numbers">Number of customers</label>
                <input type="number" id="numbers" name="numbers" class="form-control">
                <label for="roomId">Room ID</label>
                <input type="number" id="roomId" name="roomId" class="form-control">
                <label for="book_date">Date</label>
                <input type="date" id="book_date" name="book_date" class="form-control">
                <label for="book_time">Time</label>
                <select name="book_time" id="book_time" class="form-control">
                    <option value="0" checked disabled>Choose time</option>
                    <option value="9h00">9h00</option>
                    <option value="10h15">10h15</option>
                    <option value="11h30">11h30</option>
                    <option value="12h45">12h45</option>
                    <option value="14h00">14h00</option>
                    <option value="15h15">15h15</option>
                    <option value="16h30">16h30</option>
                    <option value="17h45">17h45</option>
                    <option value="19h00">19h00</option>
                    <option value="20h15">20h15</option>
                </select>
                <label for="code_name">Discount code</label>
                <input type="text" id="code_name" name="code_name" class="form-control">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control">
                <label for="status">Status</label>
                <input type="number" id="status" name="status" class="form-control">

                <br>
                <input type="submit" name="" value="Add" class="btn btn-primary">         
            </div>
        </form>
    </div>
@endsection