@include('layout.sidebar')
<div class="adj-pagecontent">
@include('layout.header')

<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Azonosító</th>
    <th>Kvíz típus neve</th>
    @if($isAdmin)
    <th>Műveletek</th>
    @else
    <th></th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> name}}</td>
    @if($isAdmin)
    <td><a href="/admin/quiz-type/edit/{{$item -> id}}">Szerkesztés</a></td>
    @else
    <td><a></a></td>
    @endif
  </tr>  
  @endforeach

</tbody>
</table>
</div>
@include('layout.footer')
