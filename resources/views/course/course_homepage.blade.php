@include('layout.sidebar')
<div class="adj-pagecontent">
@include('layout.header')
<h2>{{$course_name}}</h2>
<div>
{!! $homepage !!}
</div>
</div>
@include('layout.footer')