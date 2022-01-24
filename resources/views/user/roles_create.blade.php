@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/role/create" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Szerepkör neve</label>
        <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Megnevezés" value="{{ old('name') }}">
        </div>
        {!! $errors->first('name', '<small class="text-danger">A megnevezés :message</small>') !!}
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Létrehozás</button>
        </div>
    </form>

@include('layout.footer')