@include('layout.sidebar')
@php
use App\Models\Grade;
@endphp

@include('layout.header')
@inject('logged', 'App\Http\Controllers\Controller')


<table class="table">
    @if ($isStudent)
        <thead> 
            <tr>
                <td style="text-align:center">Quiz azonosító </td>
                <td style="text-align:center">Diak Neve</td>
                <td style="text-align:center">Érdemjegy</td>
            </tr>
        </thead>
        @foreach ($items as $item)
            <tbody>
                <tr>
                    <td style="text-align:center">{{$item -> quiz_name}} </td>
                    <td style="text-align:center">{{$item -> user_name}}</td>
                    <td style="text-align:center">{{$item -> grade}}</td>
                </tr>
            </tbody>  
        @endforeach

    @elseif ($isAdmin || $isTeacher)

        <thead> 
            <tr>
            <td style="text-align:center">Jegyek</td>
            @foreach ($quizzes as $quiz)
                <td style="text-align:center">{{$quiz}}</td>
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

@include('layout.footer')
