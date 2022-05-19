@include('layout.header')

@inject('logged', 'App\Http\Controllers\Controller')
<?php if (!$isExists) : ?>
    <div class="row mb-3">
    <label>A kurzus nem található!</label>
    </div>
<?php else : ?>
<?php if ($isTeacher && ($teacher_id != $logged->auth('id'))) : ?>
    <div class="row mb-3">
    <label>Ezt a kurzust nem te hoztad létre, ezért nem szerkesztheted!</label>
    </div>
<?php else : ?>
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
            <label for="inputEmail3" class="col-sm-2 col-form-label">Részletes leírás</label>
            <div class="col-sm-10">
            <textarea name="longDescription" class="form-control" placeholder="Részletes leírás">{{$longDescription}}</textarea>
            </div>
            {!! $errors->first('longDescription', '<small class="text-danger">A kurzus részletes leírása :message</small>') !!}
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Láthatóság</label>
        <div class="col-sm-10">
        <select name="status" class="form-select">                   
            <option value="0" <?php if($status == 0){echo("selected");}?>>nem közzétett</option>       
            <option value="1" <?php if($status == 1){echo("selected");}?>>közzétéve</option>
         </select>
        </div>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Módosítás</button>
        </div>
    </form>
<?php endif; ?>
<?php endif; ?>
@include('layout.footer')
