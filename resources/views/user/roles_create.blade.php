@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/role/create" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Szerepkör neve</label>
        <div class="col-sm-10">
        <input type="text" name="name" placeholder="Megnevezés">
        </div>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Létrehozás</button>
        </div>
    </form>

@include('layout.footer')