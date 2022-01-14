@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/course/edit/{{$id}}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Megnevezés" value="{{$name}}"><br>
        <textarea name="description" placeholder="Leírás">{{$description}}</textarea>
        <button type="submit">Módosítás</button>
    </form>

@include('layout.footer')
