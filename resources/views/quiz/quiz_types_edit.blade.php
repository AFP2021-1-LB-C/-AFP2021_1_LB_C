@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/quiz-type/edit/{{$id}}" method="post">
        @csrf
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Megnevezés</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="Megnevezés" value="{{$name}}">
            </div>
            {!! $errors->first('name', '<small class="text-danger">A megnevezés :message</small>') !!}
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>
    </form>

@include('layout.footer')
