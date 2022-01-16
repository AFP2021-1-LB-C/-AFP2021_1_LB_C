@include('layout.header')

<table>
<thead>
  <tr>
    <th>Azonosító</th>
    <th>Kvíz típus neve</th>
    <th>Műveletek</th>
  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> started_at}}</td>
    <td>{{$item -> submitted_at	}}</td>
    <td>{{$item -> type_id}}</td>
    <td>{{$item -> course_id}}</td>
    <td><a href="/admin/quiz-type/edit/{{$item -> id}}">Szerkesztés</a></td>
  </tr>  
  @endforeach

</tbody>
</table>

@include('layout.footer')
