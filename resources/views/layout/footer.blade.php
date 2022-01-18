  @if (isset($page_links))
    @foreach ($page_links as $page_link)
    <small class="d-block text-end mt-3">
      <a href="{{$page_link -> link}}">{{$page_link -> label}}</a>
    </small> 
    @endforeach 
  @endif


   </div>

</main>
    </body>
</html>
