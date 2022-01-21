@include('layout.header')

<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Azonosító</th>
    <th>Kezdő dátum</th>
    <th>Befejező dátum</th>
    <th>Feladat típus neve</th>
    <th>Kurzus neve</th>
    <th>Műveletek</th>

  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> started_at}}</td>
    <td>{{$item -> submitted_at	}}</td>
    <td>{{$item -> type -> name}}</td>
    <td>{{$item -> course -> name}}</td>
    <td>
    @if ($isAdmin == 1)
    <a href="/admin/quiz/edit/{{$item -> id}}">Szerkesztés</a>
    @endif
    </td>
  </tr>  
  @endforeach

</tbody>
</table>

@include('layout.footer')
