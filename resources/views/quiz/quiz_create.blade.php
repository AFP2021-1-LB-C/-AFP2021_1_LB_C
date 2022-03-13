@include('layout.sidebar')
<div class="adj-pagecontent">
@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/quiz/create" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kezdő dátum</label>
        <div class="col-sm-10">
        <input type="datetime-local" name="started_at" class="form-control" placeholder="Kezdő dátum" value="{{ old('started_at') }}">
        </div>
        {!! $errors->first('started_at', '<small class="text-danger">A kezdő dátum :message</small>') !!}
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Befejező dátum</label>
        <div class="col-sm-10">
        <input type="datetime-local" name="submitted_at" class="form-control" placeholder="Befejező dátum" value="{{ old('submitted_at') }}">
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

        @for ($i = 1; $i < 11; $i++ )  
            <div class="form-group">
                <label for="question[{{$i}}]" class="col-sm-2 col-form-label">Kérdés</label>
                <input type="text" name="question[{{$i}}]" value="{{old('question[' .$i. ']')}}" class="form-control">
                <label for="answer" class="col-sm-2 col-form-label">Valaszok</label>
                <div class="form-check">
                    <input type="radio" name="correct_answer[{{$i}}]" value="1" class="form-check-input">
                    <input type="text" name="answer_1[{{$i}}]" value="" class="form-control">
                    <label for="answer_1[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="correct_answer[{{$i}}]" value="2" class="form-check-input">
                    <input type="text" name="answer_2[{{$i}}]" value="" class="form-control">
                    <label for="answer_2[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="correct_answer[{{$i}}]" value="3" class="form-check-input">
                    <input type="text" name="answer_3[{{$i}}]" value="" class="form-control">
                    <label for="answer_3[{{$i}}]" class="form-check-label"></label>
                </div>
                <div class="form-check">
                    <input type="radio" name="correct_answer[{{$i}}]" value="4" class="form-check-input">
                    <input type="text" name="answer_4[{{$i}}]" value="" class="form-control">
                    <label for="answer_4[{{$i}}]" class="form-check-label"></label>
                </div>
                
            </div>
        @endfor

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Létrehozás</button>
        </div>
    </form>
</div>
@include('layout.footer')
