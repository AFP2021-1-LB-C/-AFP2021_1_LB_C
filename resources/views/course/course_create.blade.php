@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/course/create" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Megnevezés</label>
        <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Megnevezés">
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Leírás</label>
        <div class="col-sm-10">
        <textarea name="description" class="form-control" placeholder="Leírás"></textarea>
        </div>
        </div>


        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Létrehozás</button>
        </div>

    </form>

@include('layout.footer')
