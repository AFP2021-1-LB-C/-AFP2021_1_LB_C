@include('layout.header')
<form action="/quiz/result/{{$id}}" method="get">
    @csrf
<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Kérdések, válaszok:</b></label>

<table class="table" style="width:100%" >
    @foreach ($items as $item)
<thead> 
    <tr>
    <th colspan="2" style="background-color: #8dd6de; text-align:left">{{$item -> question}}</th>
    </tr>
</thead>
<tbody>
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

</table>

@include('layout.footer')
