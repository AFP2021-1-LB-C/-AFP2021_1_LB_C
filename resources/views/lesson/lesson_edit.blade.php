@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/lesson/edit/{{$id}}" method="post">
        @csrf
        <input type="text" name="topic" placeholder="Tananyag megnevezése" value="{{$topic}}"><br>
        <textarea name="content" placeholder="Tananyag">{{$content}}</textarea>
        <select name="course_id">
        @foreach ($courses as $course )             
            <option value="{{$course -> id}}">{{$course -> name}}</option>       
        @endforeach
         </select>
        <button type="submit">Módosítás</button>
    </form>

@include('layout.footer')
