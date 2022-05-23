<?php use App\Models\Courses_user;use App\Models\Course;$empty = true;?>
@include('layout.header')
<?php $subbed = false; ?>
<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Azonosító</th>
    <th>Feladat neve</th>  
    <th>Törlés ideje</th>  
    <th>Műveletek</th>
  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  @if (($item -> deleted_at) != NULL)
  @inject('logged', 'App\Http\Controllers\Controller')
  @if (!$isTeacher && ($item -> status) == 1 || $isAdmin 
  || ($isTeacher && $item -> teacher_id == $logged->auth('id')))
  <?php $empty = false;?>
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> type -> name}}</td> 
    <td>{{$item -> deleted_at}}</td>
    <td>
    @if($isAdmin||$isTeacher)
    <a href="/admin/quiz/undo_delete/{{$item -> id}}">Helyreállítás</a>

    </td>
    @endif
    @endif
  @endif
  @endforeach
</tbody>
</table>

  @if ($empty == true)
    <label>Még nincs törölt feladat!</label>
  @endif

@include('layout.footer')
