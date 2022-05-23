@include('layout.sidebar')
@include('layout.header')

    {{-- Módosítás --}}
    <form action="/admin/lesson/edit/{{$id}}" method="post">
        @csrf

        <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tananyag megnevezése</label>
        <div class="col-sm-10">
        <input type="text" name="topic" class="form-control" placeholder="Tananyag megnevezése" value="{{$topic}}">
        </div>
        {!! $errors->first('topic', '<small class="text-danger">A tananyag megnevezése :message</small>') !!}
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tananyag</label>
        <div class="col-sm-10">

      
        <!--Embed youtube video linket kell feltölteni-->
        <textarea id="editor" name="content" >{{$content}}</textarea>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        </div>
        {!! $errors->first('content', '<small class="text-danger">A tananyag :message</small>') !!}
        </div>
 
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kurzus</label>
        <div class="col-sm-10">
        <select name="course_id" class="form-select">
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
