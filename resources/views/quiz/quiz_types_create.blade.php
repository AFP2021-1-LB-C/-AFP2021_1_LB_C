@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/quiz-type/create" method="post">
        @csrf
        <input type="text" name="name" placeholder="Megnevezés"><br>
        <button type="submit">Létrehozás</button>
    </form>

@include('layout.footer')
