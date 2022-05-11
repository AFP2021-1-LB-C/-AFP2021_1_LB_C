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
    <th>E-mail</th>
    <th>Regisztrálva</th>
    <th>Utolsó bejelentkezés</th>
    <th>Műveletek</th>
  </tr>
</thead>
<tbody>
  

  @foreach ($items as $item)
  @if (($item -> deleted_at) == NULL)
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
    @if($isAdmin)
    <a href="/admin/user/edit/{{$item -> id}}">Szerkesztés</a>
    <a href="/admin/user/delete/{{$item -> id}}">Törlés</a>
    @endif
    <a href="/user/profile/{{$item -> id}}">Profil megtekintése</a>
    </td>
  </tr>  
  @endif
  @endforeach

</tbody>
</table>

  @endif

@include('layout.footer')
