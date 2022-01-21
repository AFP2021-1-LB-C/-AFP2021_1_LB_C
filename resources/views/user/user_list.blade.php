<?php use App\Models\User; ?>

@include('layout.header')

<table class="table">
<thead class="table-secondary">
@if (!User::exists())
    <tr>
      <th>Még nincs felhasználó regisztrálva!</th>
    </tr>
    <tbody>
@else
  <tr>
    <th>Azonosító</th>
    <th>Név</th>
    <th>Életkor</th>
    <th>Szerepkör</th>
    <th>Felhasználónév</th>
    <th>Email</th>
    <th>Regisztrálva</th>
    <th>Utolsó Bejelentkezés</th>
    <th>Műveletek</th>
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
    
    <td>{{$item -> registration_date}}</td>
    <td>{{$item -> last_login_date}}</td>
    <td>
    @if ($isAdmin == 1)
    <a href="/admin/user/edit/{{$item -> id}}">Szerkesztés</a>
    @endif
    <a href="/user/profile/{{$item -> id}}">Profil</a>
    </td>
  </tr>  
  @endforeach

</tbody>
</table>

  @endif

@include('layout.footer')
