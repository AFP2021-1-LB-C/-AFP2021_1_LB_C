@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/user/create" method="post">
        @csrf
        <input type="text" name="name" placeholder="Név"><br>
        <input type="number" name="age" placeholder="Kor"><br>
        <select name="role_id">
        @foreach ($roles as $role)             
            <option value="{{$role -> id}}">{{$role -> name}}</option>       
        @endforeach
         </select><br>
        <input type="text" name="username" placeholder="Felhasználónév"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Jelszó"><br>
        <input type="datetime_local" name="registration_date" placeholder="Regisztrálás Dátuma"><br>
        <input type="datetime_local" name="last_login_date" placeholder="Utolsó Bejelentkezés Dátuma"><br>
        <button type="submit">Létrehozás</button>
    </form>

@include('layout.footer')
