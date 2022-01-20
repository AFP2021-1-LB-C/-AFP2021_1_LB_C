<?php use App\Models\User; ?>

@include('layout.header')

@if (!User::exists())
  <table>
<thead>
  <thead>
    <tr>
      <th>Még nincs felhasználó regisztrálva!</th>
    </tr>
  </thead>
  </thead>
<tbody>
@else

<table>
<thead>
  <tr>
    <th>Azonosító</th>
    <th>Név</th>
    <th>Életkor</th>
    <th>Szerepkör</th>
    <th>Felhasználónév</th>
    <th>Email</th>
    
    <th>Regisztrálva</th>
    <th>Utolsó Bejelentkezés</th>

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
    <td><a href="/admin/user/edit/{{$item -> id}}">Szerkesztés</a></td>
  </tr>  
  @endforeach

</tbody>
</table>

  @endif

@include('layout.footer')
