<?php use App\Models\User; ?>

@include('layout.header')

<form action="/user/profile/{{ $id }}" method="get">


<table class="table">
  <thead class="table-secondary">

  @if ($id == 0)
  <tr><th>Nincs ilyen felhasználó!</th></tr>
  @else
    <tr><th>Név</th><th>{{$items -> name}}</th></tr>
</thead>
<tbody>
<tr><th>Azonosító</th><td>{{$items -> id}}</td></tr>
    
    <tr><th>Életkor</th><td>{{$items -> age}}</td></tr>
    <tr><th>Szerepkör</th><td>{{$items -> role -> name}}</td></tr>
    <tr><th>Felhasználónév</th><td>{{$items -> username}}</td></tr>
    <tr><th>Email</th><td>{{$items -> email}}</td></tr>
    <tr><th>Regisztrálva</th><td>{{$items -> registration_date}}</td></tr>
    <tr><th>Utolsó Bejelentkezés</th><td>{{$items -> last_login_date}}</td></tr>
</tbody>
</table>

@endif
@include('layout.footer')
