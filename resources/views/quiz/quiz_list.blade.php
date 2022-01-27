<?php use App\Models\Grade; ?>
@include('layout.header')
@inject('logged', 'App\Http\Controllers\Controller')

<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Azonosító</th>
    <th>Kezdő dátum</th>
    <th>Befejező dátum</th>
    <th>Feladat típus neve</th>
    <th>Kurzus neve</th>
    <th>Műveletek</th>
    <th>Jegyek</th>

  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
@if ((Grade::where('quiz_id', ($item -> id))
    ->where('user_id', $logged->auth('id'))
    ->value('grade')) == null)
<tr>
@elseif((Grade::where('quiz_id', ($item -> id))
    ->where('user_id', $logged->auth('id'))
    ->value('grade')) != 1)
  <tr style='background-color:#cbf6cd'>  
@else
  <tr style='background-color:#f4b9b8'>
@endif
    <td>{{$item -> id}}</td>
    <td>{{$item -> started_at}}</td>
    <td>{{$item -> submitted_at	}}</td>
    <td>{{$item -> type -> name}}</td>
    <td>{{$item -> course -> name}}</td>
    <td>
    @if($isAdmin || $isTeacher)
    <a href="/admin/quiz/edit/{{$item -> id}}">Szerkesztés</a>
    @endif
   
    @if($isAdmin || $isTeacher)
    <a href="/quiz/result/{{$item -> id}}">Eredmények</a>
    @elseif ((Grade::where('quiz_id', ($item -> id))
    ->where('user_id', $logged->auth('id'))
    ->value('grade')) != null)
    <label><a href="/quiz/result/{{$item -> id}}">Eredmény</a></label>
    <td>{{Grade::where('quiz_id', ($item -> id))
    ->where('user_id', $logged->auth('id'))
    ->value('grade');}}</td>
    @else
    <a href="/quiz/completion/{{$item -> id}}">Kitöltés</a>
    <td>-</td>
    @endif
    </td>
  </tr>  
  @endforeach

</tbody>
</table>

@include('layout.footer')
