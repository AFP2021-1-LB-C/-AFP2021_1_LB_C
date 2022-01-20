@include('layout.header')

    {{-- LÉTREHOZÁS --}}
    <form action="/admin/quiz/create" method="post">
        @csrf
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kezdő dátum</label>
        <div class="col-sm-10">
        <input type="datetime-local" name="started_at" class="form-control" placeholder="Kezdő dátum">
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Befejező dátum</label>
        <div class="col-sm-10">
        <input type="datetime-local" name="submitted_at" class="form-control" placeholder="Befejező dátum">
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kurzus</label>
        <div class="col-sm-10">
         <select name="course_id" class="form-control">
        @foreach ($courses as $course )             
            <option value="{{$course -> id}}">{{$course -> name}}</option>       
        @endforeach
         </select>
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kvíz típus</label>
        <div class="col-sm-10">
        <select name="type_id" class="form-control">
        @foreach ($types as $type )             
            <option value="{{$type -> id}}">{{$type -> name}}</option>       
        @endforeach
         </select>
        </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Létrehozás</button>
        </div>
    </form>

@include('layout.footer')
