@include('layout.sidebar')
<div class="adj-pagecontent">
@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/quiz/edit/{{$id}}" method="post">
        @csrf
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Kezdő dátum</label>
            <div class="col-sm-10">
                <input type="text" name="started_at" class="form-control" placeholder="Kezdő dátum" value="{{$started_at}}">
            </div>
            {!! $errors->first('started_at', '<small class="text-danger">A kezdő dátum :message</small>') !!}
        </div>
        
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Befejező dátum</label>
            <div class="col-sm-10">
                <input type="text" name="submitted_at" class="form-control" placeholder="Befejező dátum" value="{{$submitted_at}}">
            </div>
            {!! $errors->first('submitted_at', '<small class="text-danger">A befejező dátum :message</small>') !!}
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kurzus</label>
        <div class="col-sm-10">
        <select name="course_id" class="form-select">
        @foreach ($courses as $course )             
            <option value="{{$course -> id}}">{{$course -> name}}</option>       
        @endforeach
         </select>
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Feladat típus</label>
        <div class="col-sm-10">
        <select name="type_id" class="form-select">
        @foreach ($types as $type )             
            <option value="{{$type -> id}}">{{$type -> name}}</option>       
        @endforeach
         </select>
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Jegyszerzős-e</label>
        <div class="col-sm-10">
        <select name="quizType" class="form-select">               
            <option value="0">Gyakorló</option>       
            <option value="1">Jegyszerzős</option>
         </select>
        </div>
        </div>

        @for ($i = 0; $i < count($questions); $i++ )  
            <div class="form-group">
                <label for="question[{{$i}}]"  class="col-sm-2 col-form-label">Kérdés</label>
                <input name="question_id[{{$i}}]" value="{{$questions[$i]->id}}" type="hidden">
                <input type="text" name="question[{{$i}}]" value="{{$questions[$i] -> question}}" class="form-control">
                <label for="answer" class="col-sm-2 col-form-label">Valaszok</label>
                <div class="form-check">
                    <input type="radio" name="correct_answer[{{$i}}]" value="1" {{ ($questions[$i]->correct_answer==1)? "checked" : "" }} class="form-check-input">
                    <input type="text" name="answer_1[{{$i}}]" value="{{$questions[$i] -> answer_1}}" class="form-control">
                    <label for="answer_1[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="correct_answer[{{$i}}]" value="2" {{ ($questions[$i]->correct_answer==2)? "checked" : "" }} class="form-check-input">
                    <input type="text" name="answer_2[{{$i}}]" value="{{$questions[$i] -> answer_2}}" class="form-control">
                    <label for="answer_2[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="correct_answer[{{$i}}]" value="3" {{ ($questions[$i]->correct_answer==3)? "checked" : "" }} class="form-check-input">
                    <input type="text" name="answer_3[{{$i}}]" value="{{$questions[$i] -> answer_3}}" class="form-control">
                    <label for="answer_3[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="correct_answer[{{$i}}]" value="4" {{ ($questions[$i]->correct_answer==4)? "checked" : "" }} class="form-check-input">
                    <input type="text" name="answer_4[{{$i}}]" value="{{$questions[$i] -> answer_4}}" class="form-control">
                    <label for="answer_4[{{$i}}]" class="form-check-label"></label>
                </div>
                
            </div>
        @endfor

        @for ($i = count($questions); $i < 10; $i++ )  
            <div class="form-group">
                <label for="question[{{$i}}]"  class="col-sm-2 col-form-label">Kérdés</label>
                <input name="new_question_id[{{$i}}]" value="" type="hidden">
                <input type="text" name="new_question[{{$i}}]" value="" class="form-control">
                <label for="answer" class="col-sm-2 col-form-label">Valaszok</label>
                <div class="form-check">
                    <input type="radio" name="new_correct_answer[{{$i}}]" value="1" class="form-check-input">
                    <input type="text" name="new_answer_1[{{$i}}]" value="" class="form-control">
                    <label for="answer_1[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="new_correct_answer[{{$i}}]" value="2" class="form-check-input">
                    <input type="text" name="new_answer_2[{{$i}}]" value="" class="form-control">
                    <label for="answer_2[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="new_correct_answer[{{$i}}]" value="3" class="form-check-input">
                    <input type="text" name="new_answer_3[{{$i}}]" value="" class="form-control">
                    <label for="answer_3[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="new_correct_answer[{{$i}}]" value="4" class="form-check-input">
                    <input type="text" name="new_answer_4[{{$i}}]" value="" class="form-control">
                    <label for="answer_4[{{$i}}]" class="form-check-label"></label>
                </div>
                
            </div>
        @endfor

         <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>

    </form>
</div>
@include('layout.footer')
