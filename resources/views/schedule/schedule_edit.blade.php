@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/schedule/edit/{{$id}}" method="post">
        @csrf

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Vizsga dátum</label>
        <div class="col-sm-10">
        <input type="datetime-local" name="date" class="form-control" placeholder="Vizsga dátum" value="{{ $date }}">
        </div>
        {!! $errors->first('date', '<small class="text-danger">A vizsga dátum :message</small>') !!}
        </div>


        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Vizsga típus</label>
        <div class="col-sm-10">
        <select name="type" class="form-select" value="types_id">
        @foreach ($contents as $content )             
            <option value="{{$content -> id}}" <?php if ($types_id == $content->id) {echo ' selected="selected"';} ?>>{{$content -> name}}</option>       
        @endforeach
         </select>
        </div>
        </div>
        


        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kurzus</label>
        <div class="col-sm-10">
        <select name="course_id" class="form-select" value="course_id">
        @foreach ($courses as $course )             
            <option value="{{$course -> id}}" <?php if ($course_id == $course->id) {echo ' selected="selected"';} ?>>{{$course -> name}}</option>       
        @endforeach
         </select>
        </div>
        </div>



         <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>

    </form>

@include('layout.footer')
