@include('layout.sidebar')
@php
use App\Models\Grade;
@endphp

@include('layout.header')
@inject('logged', 'App\Http\Controllers\Controller')



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<form action="/quiz/result/{{$id}}" method="get">
    @csrf

    @if ($isStudent)
<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Kérdések, válaszok:</b></label>
    @else
<label for="inputEmail3" class="col-sm-2 col-form-label"><b></b></label>
    @endif

    @php 
    $index = 0;
    $marks = [0,0,0,0,0];
    $marksresult = [0,0,0,0,0,0,0,0,0,0];

     @endphp

@foreach ($grades as $grade)
@php
//$index++; 
$graderesult = ($grade->grade);
   $marks[$graderesult -1 ]++;

@endphp
@endforeach 

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
        <td style="width:50%; background-color:{{$item -> correct_answer == 1 ? '#408736':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 1 ? '#bf0f0f':''}};
                        text-align:center"><b> 1) </b>{{$item -> answer_1}} 
                        
                    

                    </td>
        <td style="width:50%; background-color:{{$item -> correct_answer == 2 ? '#408736':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 2 ? '#bf0f0f':''}};
                        text-align:center"><b> 2) </b>{{$item -> answer_2}}</td>
    </tr>
    <tr>
        <td style="width:50%; background-color:{{$item -> correct_answer == 3 ? '#408736':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 3 ? '#bf0f0f':''}};
                        text-align:center"><b> 3) </b>{{$item -> answer_3}}</td>
        <td style="width:50%; background-color:{{$item -> correct_answer == 4 ? '#408736':''}};
                        background-color:{{$item -> answer != $item -> correct_answer && $item -> answer == 4 ? '#bf0f0f':''}};
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

    @foreach ($grades as $grade)
    @php
    $index++;
  //  $graderesult = ($grade->grade);
  //     $marks[$graderesult -1 ]++;

@endphp
    
<thead> 
    <tr>

    </tr>
</thead>
<tbody>
    @php
(($grade->grade) == null || ($grade->grade) == 1) ? $color= ' #f70905' : $color = '#19b519';
@endphp

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
    <td>
        {{-- <a href="javascript:;" onclick="show(this)" class="btn btn-primary switch">
            button
        </a> --}}

        <a class="btn btn-success" data-toggle="collapse" href="#detailedResult_{{$index}}" role="button" aria-expanded="false" aria-controls="detailedResult">
           Tanuló eredményei
        </a>


 

        @php  $i=0; /* dump($grade);*/  @endphp
        @foreach ($grade -> quiz_result as $quiz_result)
        @php $i++; @endphp

        <div class="collapse" id="detailedResult_{{$index}}">

        <div class="answer_container" >

            <ul>
                <li>
                    
                    @php
                    $studentanswer= "";
                    $correctanswer= "";
                    switch ($quiz_result->answer) {
                        case "1":
                            if ($quiz_result->answer == $quiz_result->correct_answer) {
                               $studentanswer =  "<span style='color:rgb(31, 87, 31);'>$quiz_result->answer_1</span>";
                           // $studentanswer = $quiz_result->answer_1;
                           
                            } elseif ($quiz_result->answer != $quiz_result->correct_answer) {
                                $studentanswer =  "<span style='color:rgb(120, 8, 32);'>$quiz_result->answer_1</span>"; 
                            }

                            break;
                        case "2":
                            if ($quiz_result->answer == $quiz_result->correct_answer) {
                               $studentanswer =  "<span style='color:rgb(31, 87, 31);'>$quiz_result->answer_2</span>";
                            } elseif ($quiz_result->answer != $quiz_result->correct_answer) {
                                $studentanswer =  "<span style='color:rgb(120, 8, 32);'>$quiz_result->answer_2</span>"; 
                            }
                            break;
                        case "3":
                        if ($quiz_result->answer == $quiz_result->correct_answer) {
                               $studentanswer =  "<span style='color:rgb(31, 87, 31);'>$quiz_result->answer_3</span>";
                            } elseif ($quiz_result->answer != $quiz_result->correct_answer) {
                                $studentanswer =  "<span style='color:rgb(120, 8, 32);'>$quiz_result->answer_3</span>"; 
                            }
                            break;
                        case "4":
                        //$studentanswer = $quiz_result->answer_4;
                        if ($quiz_result->answer == $quiz_result->correct_answer) {
                               $studentanswer =  "<span style='color:rgb(31, 87, 31);'>$quiz_result->answer_4</span>";
                            } elseif ($quiz_result->answer != $quiz_result->correct_answer) {
                                $studentanswer =  "<span style='color:rgb(120, 8, 32);'>$quiz_result->answer_4</span>"; 
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
                    @endphp

                    <b>{{$quiz_result->question}}</b> <br>
                    Ezt a választ adta = <b>{!! $studentanswer!!}</b> <br>
                    A helyes válasz = <b>{{$correctanswer}} </b> <br>
                    
                    <b>
                    @if($quiz_result->answer == $quiz_result->correct_answer)
                    @php 
                    $marksresult[$i -1 ]++;
                    @endphp
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
</div>
@include('layout.footer')
@php
 
$pieDataPoints = array( 
	array("label"=>"5 (Jeles)", "y"=>$marks[4]),
	array("label"=>"4 (Jó)", "y"=>$marks[3]),
	array("label"=>"3 (Közepes)", "y"=>$marks[2]),
	array("label"=>"2 (Elégséges)", "y"=>$marks[1]),
	array("label"=>"1 (Elégtelen)", "y"=>$marks[0])
);

$chartDataPoints = array(
	array("x"=> 1, "y"=> $marksresult[0]),
	array("x"=> 2, "y"=> $marksresult[1],),
	array("x"=> 3, "y"=> $marksresult[2]),
	array("x"=> 4, "y"=> $marksresult[3]),
	array("x"=> 5, "y"=> $marksresult[4]),
	array("x"=> 6, "y"=> $marksresult[5]),
	array("x"=> 7, "y"=> $marksresult[6]),
	array("x"=> 8, "y"=> $marksresult[7],),
	array("x"=> 9, "y"=> $marksresult[8]),
	array("x"=> 10, "y"=> $marksresult[9]),
); 
 
@endphp
<script>
    window.onload = function() {

     
    var piechart = new CanvasJS.Chart("pieChartContainer", {
        animationEnabled: true,
        title: {
            text: "Eredmények eloszlása"
        },
        // subtitles: [{
        //     text: "2022"
        // }],
        data: [{
            type: "pie",    
            indexLabel: "{label} ({y})",
            dataPoints: @php echo json_encode($pieDataPoints, JSON_NUMERIC_CHECK); @endphp
        }]
    });
    piechart.render();
     
    var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: false,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Kérdésekre érkezett helyes válaszok száma"
	},
	axisY:{
		includeZero: true,
        interval: 1
	},
    axisX:{
		includeZero: true,
        interval: 1
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		 dataPoints: @php echo json_encode($chartDataPoints, JSON_NUMERIC_CHECK); @endphp
        
	}]
});
chart.render();

    }
</script>

<div id="pieChartContainer" style="height: 370px; width: 100%;"></div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
@include('layout.footer')
