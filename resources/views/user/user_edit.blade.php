@include('layout.header')

{{-- Módosítás --}}
<form action="/admin/user/edit/{{ $id }}" method="post">
    @csrf
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Név</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" placeholder="Név" value="{{ $name }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kor</label>
        <div class="col-sm-10">
            <input type="number" name="age" class="form-control" placeholder="Kor" value="{{ $age }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Szerepkör</label>
        <div class="col-sm-10">
            <select name="role_id" class="form-control" value="{{ $role_id }}">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" <?php if ($role_id == $role->id) {    echo ' selected="selected"';} ?>>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Felhasználónév</label>
        <div class="col-sm-10">
            <input type="text" name="username" class="form-control" placeholder="Felhasználónév" value="{{ $username }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail cím</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" placeholder="E-mail cím" value="{{ $email }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Jelszó</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" placeholder="Jelszó" value="{{ $password }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Regisztrálás dátuma</label>
        <div class="col-sm-10">

            <input type="datetime-local" name="registration_date" class="form-control" placeholder="Regisztrálás dátuma"value="{{ $registration_date }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Utolsó bejelentkezés dátuma</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="last_login_date" class="form-control" placeholder="Utolsó bejelentkezés dátuma"value="{{ $last_login_date }}">
        </div>
    </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>
</form>

@include('layout.footer')
