@include('layout.header')

<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Azonosító</th>
    <th>Kurzus neve</th>
    <th>Kurzus leírása</th>
    <th>Műveletek</th>
  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> name}}</td> 
    <td>{{$item -> description}}</td>
    @if($isAdmin)
    <td><a href="/admin/course/edit/{{$item -> id}}">Szerkesztés</a></td>
    @endif
  </tr>  
  @endforeach

</tbody>
</table>

@include('layout.footer')
