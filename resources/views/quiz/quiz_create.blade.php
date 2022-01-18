@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/quiz/create" method="post">
        @csrf
        <input type="datetime-local" name="started_at" placeholder="Kezdő dátum"><br>
        <input type="datetime-local" name="submitted_at" placeholder="Befejező dátum"><br>
         <select name="course_id">
        @foreach ($courses as $course )             
            <option value="{{$course -> id}}">{{$course -> name}}</option>       
        @endforeach
         </select>
        <select name="type_id">
        @foreach ($types as $type )             
            <option value="{{$type -> id}}">{{$type -> name}}</option>       
        @endforeach
         </select>
        <button type="submit">Létrehozás</button>
    </form>

@include('layout.footer')
