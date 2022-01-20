@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/lesson/edit/{{$id}}" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tananyag megnevezése</label>
        <div class="col-sm-10">
        <input type="text" name="topic" class="form-control" placeholder="Tananyag megnevezése" value="{{$topic}}">
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tananyag</label>
        <div class="col-sm-10">
        <textarea name="content" class="form-control" placeholder="Tananyag">{{$content}}</textarea>
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kurzus</label>
        <div class="col-sm-10">
        <select name="course_id" class="form-select>
        @foreach ($courses as $course )             
            <option value="{{$course -> id}}">{{$course -> name}}</option>       
        @endforeach
         </select>
        </div>
        </div>

         <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>

    </form>

@include('layout.footer')
