@include('layout.header')
<h2>{{$course_name}}</h2>
@if ($exists == null)
<label>Nincs ilyen kurzus!</label>
@elseif ($items -> first() == null)
<label>Még nem található lecke ehhez a kurzushoz!</label>
@else
<table class="table">
  <thead class="table-secondary">
  <tr>
    
    <th>Tananyag megnevezése</th>
    <th>Tananyag</th>
    <th>Tananyag Megtekintése</th>

  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  <tr>
    
    <td>{{$item -> topic}}</td>
    <td>{{substr($item -> content, 0, 50)."..."}}</td>
    
    
    <td><a href="/lesson/content/{{$item -> id}}">Teljes Tananyag</a></td>
  </tr>  
  @endforeach

</tbody>
</table>
@endif
@include('layout.footer')