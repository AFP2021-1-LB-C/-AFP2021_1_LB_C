@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/course/edit/{{$id}}" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Megnevezés</label>
        <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Megnevezés" value="{{$name}}">
        </div>
        {!! $errors->first('name', '<small class="text-danger">A megnevezés :message</small>') !!}
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Leírás</label>
        <div class="col-sm-10">
        <textarea name="description" class="form-control" placeholder="Leírás">{{$description}}</textarea>
        </div>
        {!! $errors->first('description', '<small class="text-danger">A leírás :message</small>') !!}
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Láthatóság</label>
        <div class="col-sm-10">
        <select name="status" class="form-select">                   
            <option value="0">nem közzétett</option>       
            <option value="1">közzétéve</option>
         </select>
        </div>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>
    </form>

@include('layout.footer')
