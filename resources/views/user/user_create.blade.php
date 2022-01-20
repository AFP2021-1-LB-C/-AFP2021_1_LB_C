@include('layout.header')

{{-- LÉTREHOZÁS --}}
<form action="/admin/user/create" method="post">
    @csrf
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Név</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="Név">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kor</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="age" placeholder="Kor">
        </div>
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
            <input type="text" name="username" class="form-control" placeholder="Felhasználónév">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail cím</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" placeholder="E-mail cím">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Jelszó</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" placeholder="Jelszó">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Regisztrálás dátuma</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="registration_date" class="form-control" placeholder="Regisztrálás dátuma">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Utolsó bejelentkezés dátuma</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="last_login_date" class="form-control" placeholder="Utolsó bejelentkezés dátuma">
        </div>
    </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Létrehozás</button>
        </div>
</form>

@include('layout.footer')
