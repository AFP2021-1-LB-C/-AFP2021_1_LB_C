@include('layout.sidebar')
<div class="adj-pagecontent">
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
    <th>Értékelés</th>
    <th>Műveletek</th>
    @if ($isStudent)
    <th>Jegyek</th>
    @endif

  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  @if (($item -> deleted_at) == NULL)
@if ((Grade::where('quiz_id', ($item -> id))
    ->where('user_id', $logged->auth('id'))
    ->value('grade')) == null)
<tr>
@elseif((Grade::where('quiz_id', ($item -> id))
    ->where('user_id', $logged->auth('id'))
    ->value('grade')) != 1)
  <tr style='background-color:#408736'>  
@else
  <tr style='background-color:#ff3333'>
@endif
    <td>{{$item -> id}}</td>
    <td>{{$item -> started_at}}</td>
    <td>{{$item -> submitted_at	}}</td>
    <td>{{$item -> type -> name}}</td>
    <td>{{$item -> course -> name}}</td>
    <td>{{$item -> quizType == 0 ? "Gyakorló" : "Jegyszerzős"}}</td>
    <td>
    @if($isAdmin || $isTeacher)
    <a class="linking" href="/admin/quiz/edit/{{$item -> id}}">Szerkesztés</a>
    <a class="linking" href="/admin/quiz/delete/{{$item -> id}}">Törlés</a>
    @endif
   
    @if($isAdmin || $isTeacher)
    <a class="linking" href="/quiz/result/{{$item -> id}}">Eredmények</a>
    @elseif ((Grade::where('quiz_id', ($item -> id))
    ->where('user_id', $logged->auth('id'))
    ->value('grade')) != null)
    
    <label><a class="linking" href="/quiz/result/{{$item -> id}}">Eredmény</a></label>
    <label><a href="/quiz/rating/{{$item -> id}}">Válaszok</a></label>

    <td>{{Grade::where('quiz_id', ($item -> id))
    ->where('user_id', $logged->auth('id'))
    ->value('grade');}}</td>
    @else
    <a class="linking" href="/quiz/completion/{{$item -> id}}">Kitöltés</a>
    <td>-</td>
    @endif
    </td>
  </tr>  
  @endif
  @endforeach

</tbody>
</table>
</div>
@include('layout.footer')
