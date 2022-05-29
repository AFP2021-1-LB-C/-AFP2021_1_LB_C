@include('layout.sidebar')
@include('layout.header')

    {{-- Módosítás --}}
    <form action="/course/{{$course_id}}/homepage/edit" method="post">
        @csrf

        <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Kezdőlap</label>
        <div class="col-sm-10">

      
        <!--Embed youtube video linket kell feltölteni-->
        <textarea id="editor" name="homepage" >{{$homepage}}</textarea>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        </div>
        {!! $errors->first('homepage', '<small class="text-danger">A Kezdőlap :message</small>') !!}
        </div>

         <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>

    </form>

@include('layout.footer')
