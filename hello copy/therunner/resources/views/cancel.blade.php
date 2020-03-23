@extends('layouts.userapp')

@section('content')
    <div class="my-container">
        <div class="width50">
            <form method="get" action="">
                @csrf
                <div class="form-group">
                    <label for="phone" class="text-white">Mã đặt phòng</label>
                    <input type="text" class="form-control" id="id-form" name="id" required> 
                </div>
                <div class="form-group">
                    <label for="phone" class="text-white">Tên người đặt</label>
                    <input type="text" class="form-control" id="name-form" name="name" required> 
                </div>
                <div class="form-group">
                    <label for="phone" class="text-white">Email</label>
                    <input type="text" class="form-control" id="email-form" name="email" required> 
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="submit" name="" value="Xác nhận" class="btn btn-warning text-secondary" id="cf">
                        </div>
                    </div>
                    <div class="col-md-6">
                            <button id="btn" class="btn btn-warning"></button>
                    </div>
                    <script>
                        var cf = document.getElementById('cf');
                        var btn = document.getElementById('btn');
                        var idForm = document.getElementById('id-form');
                        var nameForm = document.getElementById('name-form');
                        var emailForm = document.getElementById('email-form');
                        cf.addEventListener('click', cancel);
                        btn.style.display = 'none';

                        function cancel(e){
                            e.preventDefault();
                            var id = idForm.value;
                            var name = nameForm.value;
                            var email = emailForm.value;
                            btn.innerHTML = `<a href="cancel_form.html?id=${id}&name=${name}&email=${email}" class="text-secondary">Huỷ phòng</a>`;
                            btn.style.display = 'block';
                        }
                    </script>
                </div>  
            </form>
        </div>
    </div>
@endsection