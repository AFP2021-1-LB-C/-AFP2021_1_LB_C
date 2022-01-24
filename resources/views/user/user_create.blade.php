@include('layout.header')

{{-- LÉTREHOZÁS --}}
<form action="/admin/user/create" method="post">
    @csrf
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Név</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="Név" value="{{ old('name') }}">
        </div>
        {!! $errors->first('name', '<small class="text-danger">A név :message</small>') !!}
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kor</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="age" placeholder="Kor" value="{{ old('age') }}">
        </div>
        {!! $errors->first('age', '<small class="text-danger">A kor :message</small>') !!}
    </div>
    
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Szerepkör</label>
        <div class="col-sm-10">
            <select name="role_id" class="form-select">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Felhasználónév</label>
        <div class="col-sm-10">
            <input type="text" name="username" class="form-control" placeholder="Felhasználónév" value="{{ old('username') }}">
        </div>
        {!! $errors->first('username', '<small class="text-danger">A felhasználónév :message</small>') !!}
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail cím</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" placeholder="E-mail cím" value="{{ old('email') }}">
        </div>
        {!! $errors->first('email', '<small class="text-danger">A e-mail cím :message</small>') !!}
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Jelszó</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" placeholder="Jelszó" value="{{ old('password') }}">
        </div>
        {!! $errors->first('password', '<small class="text-danger">A jelszó :message</small>') !!}
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Regisztrálás dátuma</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="registration_date" class="form-control" placeholder="Regisztrálás dátuma" value="{{ old('registration_date') }}">
        </div>
        {!! $errors->first('registration_date', '<small class="text-danger">A regisztrálás dátuma :message</small>') !!}
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Utolsó bejelentkezés dátuma</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="last_login_date" class="form-control" placeholder="Utolsó bejelentkezés dátuma" value="{{ old('last_login_date') }}">
        </div>
        {!! $errors->first('last_login_date', '<small class="text-danger">A utolsó bejelentkezés dátuma :message</small>') !!}
    </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Létrehozás</button>
        </div>
</form>

@include('layout.footer')
