@include('layout.header')

<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Kurzus neve</th>
    <th>Vizsga típusa</th>
    <th>Vizsga dátum</th>
    @if($isAdmin)
    <th>Műveletek</th>
    @else
    <th></th>
    @endif

  </tr>
</thead>
<tbody>
  @foreach ($schedules as $schedule)
  <tr>
    <td>{{$schedule -> course -> name}}</td>
    <td>{{collect($contents)->first(function($item) use ($schedule) { return $item->id == $schedule->type; })->name; }}</td>
    <td>{{$schedule -> date}}</td>
    @if($isAdmin)
    <td><a href="/admin/schedule/edit/{{$schedule -> id}}">Szerkesztés</a></td>
    @endif
   </tr>  
  @endforeach
</tbody>
</table>

@include('layout.footer')
