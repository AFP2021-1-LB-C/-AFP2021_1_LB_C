@include('layout.sidebar')
<div class="adj-pagecontent">
@include('layout.header')
<h2>{{$course_name}}
@if ($public == false && $exists != null)
  <img class="me-3" 
  style="position: relative; top:-3px;" src="/images/locked_icon.png" 
  alt="" width="22" height="22">
@endif
  </h2>
@if ($exists == null)
<label>Nincs ilyen kurzus!</label>
@elseif ($public == false)
<label>Ez a kurzus még nincs közzétéve!</label>
<td></td>
@elseif ($subscribed == false && $isStudent)
<label>Nem vagy feliratkozva erre a kurzusra!</label>
@elseif ($accepted == 0 && $isStudent)
<label>A kurzust vezető tanár még nem fogadta el a jelentkezésed!</label>
@elseif ($accepted == -1 && $isStudent)
<label>A kurzust vezető tanár elutasította a jelentkezésed!</label>
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
    
    <td><a href="/course/{{$item -> id}}/lesson">Teljes Tananyag</a></td>
  </tr>  
  @endforeach

</tbody>
</table>
@endif
</div>
@include('layout.footer')
