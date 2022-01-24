@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/course/create" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Megnevezés</label>
        <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Megnevezés" value="{{ old('name') }}">
        </div>
        {!! $errors->first('name', '<small class="text-danger">A megnevezés :message</small>') !!}
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Leírás</label>
        <div class="col-sm-10">
        <textarea name="description" class="form-control" placeholder="Leírás">{{ old('description') }}</textarea>
        </div>
        {!! $errors->first('description', '<small class="text-danger">A leírás :message</small>') !!}
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Létrehozás</button>
        </div>

    </form>

@include('layout.footer')
