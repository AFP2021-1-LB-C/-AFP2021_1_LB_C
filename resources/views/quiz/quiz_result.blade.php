<?php use App\Models\Grade;?>
@include('layout.header')
@inject('logged', 'App\Http\Controllers\Controller')
<form action="/quiz/result/{{$id}}" method="get">
    @csrf
<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Kérdések, válaszok:</b></label>

<table class="table" style="width:100%" >
    @if (1 != $logged->auth('role_id') && 2 != $logged->auth('role_id'))
    @foreach ($items as $item)
<thead> 
    <tr>
    <th colspan="2" style="background-color: #8dd6de; text-align:left">{{$item -> question}}</th>
    </tr>
</thead>
<tbody>
<td>{{$item -> user_id}}</td>

    <tr>
        <td style="width:50%; background-color:{{$item -> correct_answer == 1 ? '#63d256':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 1 ? '#ff3333':''}};
                        text-align:center"><b> 1) </b>{{$item -> answer_1}}</td>
        <td style="width:50%; background-color:{{$item -> correct_answer == 2 ? '#63d256':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 2 ? '#ff3333':''}};
                        text-align:center"><b> 2) </b>{{$item -> answer_2}}</td>
    </tr>
    <tr>
        <td style="width:50%; background-color:{{$item -> correct_answer == 3 ? '#63d256':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 3 ? '#ff3333':''}};
                        text-align:center"><b> 3) </b>{{$item -> answer_3}}</td>
        <td style="width:50%; background-color:{{$item -> correct_answer == 4 ? '#63d256':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 4 ? '#ff3333':''}};
                        text-align:center"><b> 4) </b>{{$item -> answer_4}}</td>
    </tr>

</tbody>       
    @endforeach
    @else
    <tr>
    <th>Tanuló Neve:</th>
    <th>Érdemjegy</th>
    </tr>
    <h2>A teszt azonosítója: {{Grade::where('quiz_id', $id) -> value('quiz_id')}}</h2>
    @foreach ($grades as $grade)
<thead> 
    <tr>
    
    
    </tr>
</thead>
<tbody>
<?php (($grade -> grade) == null || ($grade -> grade) == 1) ? $color = '#f4b9b8' : $color = '#cbf6cb' ?>

    <tr style='background-color:{{$color}}'>
    @if ($grades == null)
    <td>Még senkinek sincs beírva jegy ehhez a teszthez!</td>
    @else
        @if($grade -> user != null)
        <td>{{$grade -> user -> name}}</td>
        @else
        <td>Nem regisztrált tanuló</td>
        @endif
    <td>{{$grade -> grade}}</td>
    @endif
    </tr>
</tbody>       
    @endforeach
    @endif

</table>

@include('layout.footer')
