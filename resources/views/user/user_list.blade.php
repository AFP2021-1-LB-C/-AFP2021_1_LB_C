@include('layout.header')

<table>
<thead>
  <tr>
    <th>Azonosító</th>
    <th>Név</th>
    <th>Életkor</th>
    <th>Szerepkör Azonosító</th>
    <th>Felhasználónév</th>
    <th>Email</th>
    <th>Jelszó</th>
    <th>Regisztrálás Dátuma</th>
    <th>Utolsó Bejelentkezés Dátuma</th>

  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> name}}</td>
    <td>{{$item -> age}}</td>
    <td>{{$item -> role -> name}}</td>
    <td>{{$item -> username}}</td>
    <td>{{$item -> email}}</td>
    <td>{{$item -> password}}</td>
    <td>{{$item -> registration_date}}</td>
    <td>{{$item -> last_login_date}}</td>
    <td><a href="/admin/user/edit/{{$item -> id}}">Szerkesztés</a></td>
  </tr>  
  @endforeach

</tbody>
</table>

@include('layout.footer')
