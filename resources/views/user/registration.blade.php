<!-- registration.blade.php -->

@include('layout.header')

<div class="container mt-3">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
            <form method="post" action=" {{ url('user-store') }} ">
                <div class="card shadow mb-4">
                    <div class="car-header bg-success pt-2">
                        <div class="card-title font-weight-bold text-white text-center"> Felhasználó létrehozása </div>
                    </div>

                    <div class="card-body">

                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif


                        <div class="form-group">
                            <label for="first_name"> Vezetéknév </label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Vezetéknév" value="{{ old('first_name') }}"/>
                            {!! $errors->first('first_name', '<small class="text-danger">A vezetéknév :message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="last_name"> Keresztnév </label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Keresztnév" value="{{ old('last_name') }}"/>
                            {!! $errors->first('last_name', '<small class="text-danger">A keresztnév :message </small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="username"> Felhasználónév </label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Felhasználónév" value="{{ old('username') }}"/>
                            {!! $errors->first('username', '<small class="text-danger">A felhasználónév :message </small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="email"> E-mail </label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}"/>
                            {!! $errors->first('email', '<small class="text-danger">Az email :message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="password"> Jelszó </label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Jelszó" value="{{ old('password') }}"/>
                            {!! $errors->first('password', '<small class="text-danger">A jelszó :message</small>') !!}

                            <input type="checkbox" onclick="myFunction()">Jelszó mutatása
                            <script>
                                    function myFunction() {
                                    var x = document.getElementById("password");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                    }
                            </script>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password"> Jelszó újra </label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Jelszó Újra" value="{{ old('confirm_password') }}">
                            {!! $errors->first('confirm_password', '<small class="text-danger">A jelszó újra :message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="age"> Kor </label>
                            <input type="number" name="age" id="age" class="form-control" placeholder="Életkor" value="{{ old('age') }}">
                            {!! $errors->first('age', '<small class="text-danger">A kor :message</small>') !!}
                        </div>

                    </div>
                    <div class="card-footer d-inline-block">
                        <button type="submit" class="btn btn-success"> Regisztráció </button>
                    <p class="float-right mt-2"> Már van fiókja?  <a href="{{ url('login')}}" class="text-success"> Bejelentkezés </a> </p>
                    </div>
                    @csrf
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.footer')