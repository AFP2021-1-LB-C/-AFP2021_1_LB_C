@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/course/edit/{{$id}}" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Megnevezés</label>
        <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Megnevezés" value="{{$name}}"><br>
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Leírás</label>
        <div class="col-sm-10">
        <textarea name="description" class="form-control" placeholder="Leírás">{{$description}}</textarea>
        </div>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>
    </form>

@include('layout.footer')
