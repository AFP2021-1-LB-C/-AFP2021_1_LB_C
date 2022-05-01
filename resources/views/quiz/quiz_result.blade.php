<?php
use App\Models\Grade;
?>
@include('layout.header')
@inject('logged', 'App\Http\Controllers\Controller')
<form action="/quiz/result/{{$id}}" method="get">
    @csrf

    @if ($isStudent)
<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Kérdések, válaszok:</b></label>
    @else
<label for="inputEmail3" class="col-sm-2 col-form-label"><b></b></label>
    @endif

<table class="table" style="width:100%" >
    @if ($isStudent)
    @foreach ($items as $item)

    @if (($item -> quiz_question -> quiz_id) == $id)
<thead> 
    <tr>
    <th colspan="2" style="background-color: #8dd6de; text-align:left">{{$item -> question}} </th>
    </tr>
</thead>


<tbody>


    <tr>
        <td style="width:50%; background-color:{{$item -> correct_answer == 1 ? '#63d256':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 1 ? '#ff3333':''}};
                        text-align:center"><b> 1) </b>{{$item -> answer_1}} 
                        
                    

                    </td>
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

@endif
    @endforeach
    @else
    <tr>
    <th>Tanuló Neve:</th>
    <th>Érdemjegy</th>
    <th>Részletes eredmény</th>
    </tr>
    <h2>A teszt azonosítója: {{Grade::where('quiz_id', $id) -> value('quiz_id')}}</h2>
    <?php
    $index = 0;
    ?>
    @foreach ($grades as $grade)
    <?php
    $index++;
    ?>
<thead> 
    <tr>

    </tr>
</thead>
<tbody>
<?php
(($grade->grade) == null || ($grade->grade) == 1) ? $color = '#f4b9b8' : $color = '#cbf6cb';
?>

    <tr style='background-color:{{$color}}'>
    @if ($grades == null)
    <td>Még senkinek sincs beírva jegy ehhez a teszthez!</td>
    @else
        @if($grade -> user != null)
        <td>{{$grade -> user -> name}}  </td>
        @else
        <td>Nem regisztrált tanuló</td>
        @endif
    <td>{{$grade -> grade}}</td>
    <td>
        {{-- <a href="javascript:;" onclick="show(this)" class="btn btn-primary switch">
            button
        </a> --}}

        <a class="btn btn-success" data-toggle="collapse" href="#detailedResult_{{$index}}" role="button" aria-expanded="false" aria-controls="detailedResult">
           Tanuló eredményei
        </a>


 


        @foreach ($grade -> quiz_result as $quiz_result)
        <div class="collapse" id="detailedResult_{{$index}}">

        <div class="answer_container" >

            <ul>
                <li>
                    
                    <?php
                    $studentanswer= "";
                    $correctanswer= "";
                    switch ($quiz_result->answer) {
                        case "1":
                            if ($quiz_result->answer == $quiz_result->correct_answer) {
                               $studentanswer =  "<span style='color:rgb(0, 128, 0);'>$quiz_result->answer_1</span>";
                           // $studentanswer = $quiz_result->answer_1;
                           
                            } elseif ($quiz_result->answer != $quiz_result->correct_answer) {
                                $studentanswer =  "<span style='color:rgb(255, 0, 55);'>$quiz_result->answer_1</span>"; 
                            }

                            break;
                        case "2":
                            if ($quiz_result->answer == $quiz_result->correct_answer) {
                               $studentanswer =  "<span style='color:rgb(0, 128, 0);'>$quiz_result->answer_2</span>";
                            } elseif ($quiz_result->answer != $quiz_result->correct_answer) {
                                $studentanswer =  "<span style='color:rgb(255, 0, 55);'>$quiz_result->answer_2</span>"; 
                            }
                            break;
                        case "3":
                        if ($quiz_result->answer == $quiz_result->correct_answer) {
                               $studentanswer =  "<span style='color:rgb(0, 128, 0);'>$quiz_result->answer_3</span>";
                            } elseif ($quiz_result->answer != $quiz_result->correct_answer) {
                                $studentanswer =  "<span style='color:rgb(255, 0, 55);'>$quiz_result->answer_3</span>"; 
                            }
                            break;
                        case "4":
                        //$studentanswer = $quiz_result->answer_4;
                        if ($quiz_result->answer == $quiz_result->correct_answer) {
                               $studentanswer =  "<span style='color:rgb(0, 128, 0);'>$quiz_result->answer_4</span>";
                            } elseif ($quiz_result->answer != $quiz_result->correct_answer) {
                                $studentanswer =  "<span style='color:rgb(255, 0, 55);'>$quiz_result->answer_4</span>"; 
                            }
                            break;
                    }

                    switch ($quiz_result->correct_answer) {
                        case "1":
                            $correctanswer = $quiz_result->answer_1;
                            
                            break;
                        case "2":
                        $correctanswer = $quiz_result->answer_2;
                            break;
                        case "3":
                        $correctanswer = $quiz_result->answer_3;
                            break;
                        case "4":
                        $correctanswer = $quiz_result->answer_4;
                            break;
                    }
                    ?>

                    <b>{{$quiz_result->question}}</b> <br>
                    Ezt a választ adta = <b>{!! $studentanswer!!}</b> <br>
                    A helyes válasz = <b>{{$correctanswer}} </b> <br>
                    
                    <b>
                    @if($quiz_result->answer == $quiz_result->correct_answer)
                    Helyes válasz :) 
                    @else
                    Helytelen válasz :( 
                    @endif 
                    </b>   
                <br>
                    


                </li> 

            </ul>
      </div>
         </div> 
        {{-- <script>
            function show(elem){
                console.log(elem)
            }
        </script> --}}
        @endforeach
    </td>

    @endif
    </tr>
</tbody>       
    @endforeach
    @endif

</table>

@include('layout.footer')