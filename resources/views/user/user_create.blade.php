@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/user/create" method="post">
        @csrf
        <input type="text" name="name" placeholder="Név"><br>
        <input type="text" name="age" placeholder="Kor"><br>
        <input type="text" name="role_id" placeholder="Szerepkör azonosítója"><br>
        <input type="text" name="username" placeholder="Felhasználónév"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="text" name="password" placeholder="Jelszó"><br>
        <input type="text" name="registration_date" placeholder="Regisztrálás Dátuma"><br>
        <input type="text" name="last_login_date" placeholder="Utolsó Bejelentkezés Dátuma"><br>
        <button type="submit">Létrehozás</button>
    </form>

@include('layout.footer')
