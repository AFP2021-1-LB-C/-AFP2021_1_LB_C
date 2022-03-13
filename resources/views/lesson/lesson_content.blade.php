@include('layout.sidebar')
<div class="adj-pagecontent">
@include('layout.header')
<h2>{{$topic}}</h2>
<div>
{!! $content !!}
</div>
</div>
@include('layout.footer')
