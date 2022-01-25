<?php 
use App\Models\Quiz_question;
use App\Models\Grade;
?>

@include('layout.header')

<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Kérdés</th>
    <th>Megjelölt válasz</th>
    <th>Helyes válasz</th>

  </tr>
</thead>
<tbody>
<?php 
$question_count = 0;
$correct_answer_count = 0;
?>
  @foreach ($items as $item)
  
  <tr>
  
  <?php $question = Quiz_question::where('id', $item -> quiz_question_id) 
  -> first();?>
  <?php 
  switch ($item -> answer){
  case 1: $chosen = $question -> answer_1;break;
  case 2: $chosen = $question -> answer_2;break;
  case 3: $chosen = $question -> answer_3;break;
  case 4: $chosen = $question -> answer_4;break;
  default: $chosen = "-";break;
  }

  switch ($question -> correct_answer){
  case 1: $correct = $question -> answer_1;break;
  case 2: $correct = $question -> answer_2;break;
  case 3: $correct = $question -> answer_3;break;
  case 4: $correct = $question -> answer_4;break;
  default: $correct = 0;break;
  }
  ?>
  @if (($item -> answer) == ($question -> correct_answer))
    <td style='background-color:#cbf6cd'>{{$question -> question}}</td>
    <td style='background-color:#cbf6cd'>{{$chosen}}</td>
    <td style='background-color:#cbf6cd'>{{$correct}}</td>
    <?php $correct_answer_count++; ?>
  @else
    <td style='background-color:#f4b9b8'>{{$question -> question}}</td>
    <td style='background-color:#f4b9b8'>{{$chosen}}</td>
    <td style='background-color:#f4b9b8'>{{$correct}}</td>
  @endif
  </tr> 
  <?php $question_count++; ?> 
  @endforeach

</tbody>
</table>
<h2>Elért pontszám: {{$question_count}}/{{$correct_answer_count}}</h2>
<?php
$percent = $correct_answer_count/($question_count/100);
switch ($percent){
  case $percent > 85 : $grade = 5;break;
  case $percent > 70 : $grade = 4;break;
  case $percent > 55 : $grade = 3;break;
  case $percent > 40 : $grade = 2;break;
  default : $grade = 1;break;
}
if ($percent < 40){
  $grade = 1;
  }
 ?>
<h2>Százalék: {{round($percent)}}%</h2>
<h2>Érdemjegy: {{$grade}}</h2>

<?php 
$new = Grade::create([
            'user_id' => $user_id,
            'quiz_id' => $quiz_id,
            'grade' => $grade,
            'date' => $submitted_at
        ]);
?>
@include('layout.footer')