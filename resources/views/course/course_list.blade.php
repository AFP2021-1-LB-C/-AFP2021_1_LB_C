@include('layout.header')
<?php $subbed = false; ?>
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
    <td>
    @if($isAdmin)
    <a href="/admin/course/edit/{{$item -> id}}">Szerkesztés</a>
    @endif
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
    </td>
  </tr>  
  @endforeach

</tbody>
</table>

@include('layout.footer')
