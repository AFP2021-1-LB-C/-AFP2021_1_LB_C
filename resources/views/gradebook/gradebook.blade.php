@include('layout.sidebar')
@php
use App\Models\Grade;
@endphp

@include('layout.header')
@inject('logged', 'App\Http\Controllers\Controller')

<div class="table-responsive">
<table class="table table-bordered table-striped">
    @if ($isStudent)
        <thead class="thead-light"> 
            <tr>
                <th style="text-align:left" width="50%">Quiz azonosító </th>
                <th style="text-align:left" width="50%">Érdemjegy</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td style="text-align:left" width="50%">{{$item -> quiz_name}} </td>
                    <td style="text-align:left" width="50%">{{$item -> grade}}</td>
                </tr>
            @endforeach
        </tbody>  
        
    @elseif ($isAdmin || $isTeacher)

        <thead class="thead-light"> 
            <tr>
            <th style="text-align:center">Jegyek</th>
            @foreach ($quizzes as $quiz)
                <th style="text-align:center">{{$quiz}}</th>
            @endforeach
            </tr>
        </thead>

        <tbody>
        @foreach ($grades as $name => $grade)
            <tr>
                <td style="text-align:center">{{$name}}</td>
                @foreach ( $quizzes as $quiz )
                    @if($grade -> get($quiz) != "")
                        <td style="text-align:center">{{$grade -> get($quiz)}}</td>
                    @else
                        <td style="text-align:center">-</td>
                    @endif
                @endforeach
            </tr>
        @endforeach 
        </tbody>   
    @endif
</table>
</div>
@include('layout.footer')
