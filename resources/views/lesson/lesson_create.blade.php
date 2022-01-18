@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/lesson/create" method="post">
        @csrf
        <input type="text" name="topic" placeholder="Tananyag megnevezése"><br>
        <textarea name="content" placeholder="Tananyag"></textarea>
        
        <select name="course_id">
        @foreach ($courses as $course )             
            <option value="{{$course -> id}}">{{$course -> name}}</option>       
        @endforeach
        </select>
        <button type="submit">Létrehozás</button>
    </form>

@include('layout.footer')
