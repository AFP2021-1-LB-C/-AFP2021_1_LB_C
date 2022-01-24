@include('layout.header')
<h2>A teszt elkezdve ekkor: {{$started_at}}</h2>
<table class="table">
  @foreach ($items as $item)
  <thead class="table-secondary"> 
  <tr><th>{{$item -> question}}</th></tr>

</thead>
<tbody>
<tr><th> <input type="radio" name="{{$item->id}}" value="1"> a) {{$item -> answer_1}}</th></tr>
<tr><th> <input type="radio" name="{{$item->id}}" value="2"> b) {{$item -> answer_2}}</th></tr>
<tr><th> <input type="radio" name="{{$item->id}}" value="3"> c) {{$item -> answer_3}}</th></tr>
<tr><th> <input type="radio" name="{{$item->id}}" value="4"> d) {{$item -> answer_4}}</th></tr>
</tbody>       
  @endforeach

</table>

@include('layout.footer')
