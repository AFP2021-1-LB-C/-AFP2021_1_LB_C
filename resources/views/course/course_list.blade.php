@include('layout.header')
<?php $subbed = false; ?>
<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Azonosító</th>
    <th>Kurzus neve</th>
    <th>Kurzus leírása</th>
    @if($isAdmin||$isTeacher)
    <th>Láthatóság</th>
    <th>Műveletek</th>
    @else
    <th></th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  @if (($item -> status) == 1 || $isAdmin || $isTeacher)
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> name}}</td> 
    <td>{{$item -> description}}</td>
    @if($isAdmin||$isTeacher)
      @if(($item -> status) == 0)
        <td><img class="me-3" src="/images/locked_icon.png" alt="" width="20" height="20"> Nem közzétett</td>
      @else
        <td><img class="me-3" src="/images/published_icon.png" alt="" width="20" height="20"> Közzétéve</td>
      @endif
    @endif
    <td>
    @if($isAdmin||$isTeacher)
    <a href="/admin/course/edit/{{$item -> id}}">Szerkesztés</a>
    <a href="/admin/course/delete/{{$item -> id}}">Törlés</a>
    @endif
    @if (!$isAdmin && !$isTeacher)
    @inject('logged', 'App\Http\Controllers\Controller')
   <?php $subbed = false ?>
    @foreach ($subs as $sub)
        @if (($sub -> user_id) == ($logged->auth('id')) &&
         ($item -> id) == ($sub -> course_id))
          <?php $subbed = true; ?>
          @if($subbed)
    <a href="/course/unsubscribe/{{$sub -> id}}">Leiratkozás</a>
          @endif
          @endif
    @endforeach
   @if($subbed)
    <a href="/course/{{$item -> id}}">Megtekintés</a>
    @elseif ($logged->auth('id') != null)
    <a href="/course/subscribe/{{$item -> id}}">Feliratkozás</a>
    @endif
    @endif
    </td>
  </tr>  
  @endif
  @endforeach

</tbody>
</table>

@include('layout.footer')
