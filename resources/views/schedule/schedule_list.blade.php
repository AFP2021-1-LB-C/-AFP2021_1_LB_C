@include('layout.header')

<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Kurzus neve</th>
    <th>Vizsga típusa</th>
    <th>Vizsga dátum</th>
    @if($isAdmin || $isTeacher)
    <th>Műveletek</th>
    @else
    <th></th>
    @endif

  </tr>
</thead>
<tbody>
  @foreach ($schedules as $schedule)
  @if (($schedule -> deleted_at) == NULL)
  <tr>
    <td>{{$schedule -> course -> name}}</td>
    <td>{{collect($contents)->first(function($item) use ($schedule) { return $item->id == $schedule->type; })->name; }}</td>
    <td>{{$schedule -> date}}</td>
    @if($isAdmin || $isTeacher)
    <td><a href="/admin/schedule/edit/{{$schedule -> id}}">Szerkesztés</a>
    <a href="/admin/schedule/delete/{{$schedule -> id}}">Töröl</a></td>
    @endif
   </tr>  
   @endif
  @endforeach
</tbody>
</table>

@include('layout.footer')
