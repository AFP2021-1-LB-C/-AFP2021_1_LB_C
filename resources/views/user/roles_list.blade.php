@include('layout.header')

<table>
<thead>
  <tr>
    <th>Azonosító</th>
    <th>Felhasználói szerepkör neve</th>
    <th>Műveletek</th>
  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> name}}</td>
    <td><a href="/admin/role/edit/{{$item -> id}}">Szerkesztés</a></td>
  </tr>  
  @endforeach

</tbody>
</table>

@include('layout.footer')
