@include('layout.header')
@if ($exists == null)
<label>Nincs ilyen kurzus!</label>
@else
<h2>{{$course_name}}</h2>
@inject('logged', 'App\Http\Controllers\Controller')
@if ($isTeacher && ($teacher_id != $logged->auth('id')))
<label>Ezt a kurzust nem te hoztad létre, ezért nem módosíthatod a jelentkezések állapotát!</label>
@else
  
<table class="table">
  <thead class="table-secondary">
  <tr>
    
    <th>Jelentkezett Hallgató</th>
    <th>Jelentkezés Állapota</th>
    <th>Műveletek</th>

  </tr>
</thead>
<tbody>
<?php $count = 0; ?>
  @foreach ($items as $item)
  
  <?php 
  ($item -> status) == 0 ? $color = '#FEFF89' : (($item -> status) == 1 ? $color = '#cbf6cb' : $color = '#f4b9b8')
  ?>

    <tr style='background-color:{{$color}}'>
@if ($item -> course_id == $id)
  <?php $count++; ?>
    <td>{{$item -> user -> name}}</td>
    <td>{{($item -> status) == 0 ? "Várakozás" : (($item -> status) == 1 ? "Elfogadva" : "Elutasítva")}}</td>
    <td>
    <a href="/course/students/accept/{{$item -> id}}">Elfogadás</a>
    <a href="/course/students/reject/{{$item -> id}}">Elutasítás</a>
    <a href="/course/students/remove/{{$item -> id}}">Jelentkezés törlése</a>
    </td>
@endif
  </tr>  
  @endforeach

</tbody>
</table>
@if ($count == 0)
<td>Erre a kurzusra még egy hallgató sem jelentkezett!</td>
@endif
@endif
@endif
@include('layout.footer')
