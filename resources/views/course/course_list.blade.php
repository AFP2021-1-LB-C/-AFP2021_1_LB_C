@include('layout.header')
<?php $subbed = false; ?>
<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Azonosító</th>
    <th>Kurzus neve</th>
    <th>Kurzus leírása</th>
    <th>Oktató</th>
    @if($isAdmin||$isTeacher)
    <th>Láthatóság</th>
    <th>Műveletek</th>
    <th>Hallgatók</th>
    @else
    <th></th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  @inject('logged', 'App\Http\Controllers\Controller')
  @if (!$isTeacher && ($item -> status) == 1 || $isAdmin 
  || ($isTeacher && $item -> teacher_id == $logged->auth('id')))
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> name}}</td> 
    <td>{{$item -> description}}</td>
<?php try { ?>
    <td>{{$item -> teacher -> name}}</td>
<?php } catch (Exception $ex) { ?>
    -
<?php } ?>
    @if($isAdmin||$isTeacher)
      @if(($item -> status) == 0)
        <td><img class="me-3" style="position: relative; left:30px;" src="/images/locked_icon.png" alt="" width="20" height="20"></td>
      @else
        <td><img class="me-3" style="position: relative; left:30px;" src="/images/published_icon.png" alt="" width="20" height="20"></td>
      @endif
    @endif
    <td>
    @if($isAdmin||$isTeacher)
    <a href="/admin/course/edit/{{$item -> id}}">Szerkesztés</a>
    <a href="/admin/course/delete/{{$item -> id}}">Törlés</a>
    <td>
    <a href="/admin/course/students/{{$item -> id}}">Megtekintés</a>
    </td>
    @endif
    @if (!$isAdmin && !$isTeacher)
    @inject('logged', 'App\Http\Controllers\Controller')
   <?php $subbed = false ?>
    @foreach ($subs as $sub)
        @if (($sub -> user_id) == ($logged->auth('id')) &&
         ($item -> id) == ($sub -> course_id))
          <?php $subbed = true; ?>
          @if($subbed)
    <a href="/course/unsubscribe/{{$sub -> id}}">Leadás</a>
          @endif
          @endif
    @endforeach
   @if($subbed)
    <a href="/course/{{$item -> id}}">Megtekintés</a>
    @elseif ($logged->auth('id') != null)
    <a href="/course/subscribe/{{$item -> id}}">Jelentkezés</a>
    @endif
    @endif
    </td>
  </tr>
  @endif
  @endforeach

</tbody>
</table>

@include('layout.footer')
