@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/user/edit/{{$id}}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Megnevezés" value="{{$name}}"><br>
        <button type="submit">Módosítás</button>
    </form>

@include('layout.footer')
