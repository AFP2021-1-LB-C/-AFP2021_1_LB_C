@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/quiz/edit/{{$id}}" method="post">
        @csrf
        <input type="text" name="started_at" placeholder="Kezdő dátum" value="{{$started_at}}"><br>
        <input type="text" name="submitted_at" placeholder="Befejező dátum" value="{{$submitted_at}}"><br>
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
        <button type="submit">Módosítás</button>
    </form>

@include('layout.footer')
