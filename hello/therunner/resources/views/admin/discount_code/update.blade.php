@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center text-danger">Add new discount-code</h1>
        <form action="{{asset('discount_code')}}/{{$code->id}}" method="post">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$code->name}}">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    @if($code->type==0)
                        <option value="0" checked>Fixed discount</option>
                        <option value="1">Percentage discount</option>
                    @endif
                    @if($code->type==1)
                        <option value="1" checked>Percentage discount</option>
                        <option value="0">Fixed discount</option>
                    @endif
                </select>
                <label for="value">Value</label>
                <input type="number" id="value" name="value" class="form-control" value="{{$code->value}}">
                <label for="status">Status</label>
                <select name="status" id="tystatuspe" class="form-control">
                    @if($code->status==0)
                        <option value="0" checked>On</option>
                        <option value="1">Off</option>
                    @endif
                    @if($code->status==1)
                        <option value="1">Off</option>
                        <option value="0" checked>On</option>
                    @endif
                </select>
                <br>
                <input type="submit" name="" value="Update" class="btn btn-primary">         
            </div>
        </form>
    </div>
@endsection