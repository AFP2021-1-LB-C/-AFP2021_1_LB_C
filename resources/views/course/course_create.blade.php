@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/course/create" method="post">
        @csrf
        <input type="text" name="name" placeholder="Megnevezés"><br>
        <textarea name="description" placeholder="Leírás"></textarea>
        <button type="submit">Létrehozás</button>
    </form>

@include('layout.footer')
