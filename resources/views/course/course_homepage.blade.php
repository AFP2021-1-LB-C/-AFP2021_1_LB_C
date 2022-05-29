@include('layout.sidebar')
<div class="adj-pagecontent">
@include('layout.header')
<h2>{{$course_name}}</h2>
<div>
{!! $homepage !!}
</div>
@if($isAdmin || $isTeacher)
<a href="/course/{{$course_id}}/homepage/edit">Módosítás</a>
@endif
</div>
@include('layout.footer')