@include('layout.header')
<form action="/quiz/rating/{{$id}}" method="post">
    @csrf

<h2>A teszt elkezdve ekkor: {{$started_at}}</h2>
<table class="table">
  @foreach ($items as $item)
  <thead class="table-secondary"> 
  <tr><th>{{$item -> question}}</th></tr>

</thead>
<tbody>
{{-- <tr><th> <input type="radio" name="{{$item->id}}" value="1"> 1) {{$item -> answer_1}}</th></tr>
<tr><th> <input type="radio" name="{{$item->id}}" value="2"> 2) {{$item -> answer_2}}</th></tr>
<tr><th> <input type="radio" name="{{$item->id}}" value="3"> 3) {{$item -> answer_3}}</th></tr>
<tr><th> <input type="radio" name="{{$item->id}}" value="4"> 4) {{$item -> answer_4}}</th></tr>  --}}
@foreach ($item->answers as $index => $answer)
<tr><th> <input type="radio" name="{{$item->id}}" value="{{$answer->num}}"> {{++$index}}) {{$answer->answer}}</th></tr>
@endforeach

</tbody>       
  @endforeach

</table>
<button type="submit" class="btn btn-primary">Válaszok elküldése</button>

@include('layout.footer')
