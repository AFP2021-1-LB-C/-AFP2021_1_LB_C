@include('layout.header')
    <div class="container mt-3">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
            <form method="post" action="{{ url('/user-login') }}">
                    <div class="card shadow">
                        <div class="car-header bg-success pt-2">
                            <div class="card-title font-weight-bold text-white text-center"> Bejelentkezés </div>
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

                                @if(Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('error') }}
                                                @php
                                                    Session::forget('error');
                                                @endphp
                                            </div>
                                        @endif

                            <div class="form-group">
                                <label for="email"> E-mail </label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter E-mail" value="{{ old('email') }}"/>
                                    {!! $errors->first('email', '<small class="text-danger">A e-mail :message</small>') !!}
                            </div>

                            <div class="form-group">
                                <label for="password"> Jelszó </label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" value="{{ old('password') }}"/>
                                    {!! $errors->first('password', '<small class="text-danger">A jelszó :message</small>') !!}
                                    <!-- jelszó mutatása a bejelentkezés oldalon -->
                                    <input type="checkbox" onclick="showPassword()">Jelszó mutatása
                                    <script>
                                    function showPassword() {
                                    var x = document.getElementById("password");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                    }
                                    </script>
                            </div>
                        </div>

                        <div class="card-footer d-inline-block">
                            <button type="submit" class="btn btn-success"> Bejelentkezés </button>
                            <p class="float-right mt-2"> Még nincs fiókod?  <a href="{{ url('registration')}}" class="text-success"> Regisztráció </a> </p>
                        </div>
                        @csrf
                    </div>
                </form>
            </div>
        </div>
    </div>
@include('layout.footer')