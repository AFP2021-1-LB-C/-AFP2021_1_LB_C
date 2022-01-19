
@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/user/edit/{{$id}}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Név" value="{{$name}}"><br>
        <input type="number" name="age" placeholder="Kor" value="{{$age}}"><br>
        <select name="role_id" value="{{$role_id}}">
        @foreach ($roles as $role)            
            <option value="{{$role -> id}}" <?php if ($role_id == $role -> id) echo ' selected="selected"'; ?>>{{$role -> name}}</option>       
        @endforeach
         </select><br>
        <input type="text" name="username" placeholder="Felhasználónév" value="{{$username}}"><br>
        <input type="email" name="email" placeholder="Email" value="{{$email}}"><br>
        <input type="password" name="password" placeholder="Jelszó" value="{{$password}}"><br>
        <input type="datetime-local" name="registration_date" placeholder="Regisztrálás Dátuma" value="{{$registration_date}}"><br>
        <input type="datetime-local" name="last_login_date" placeholder="Utolsó Bejelentkezés Dátuma"value="{{$last_login_date}}"><br>
        <button type="submit">Módosítás</button>
    </form>

@include('layout.footer')
