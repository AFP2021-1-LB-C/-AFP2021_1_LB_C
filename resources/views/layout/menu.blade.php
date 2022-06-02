<!-- Menü -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
  <div class="container-fluid">
    <img class="me-3" src="/images/logo1.png" alt="" width="60" height="59" style="margin-bottom:-15px;">
    <a class="navbar-brand studysloth" href="/">StudySloth</a>
    <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" aria-current="page" href="/">Kezdőlap</a>
          {{-- <a class="nav-link active" aria-current="page" href="/">Kezdőlap</a> --}}
          {{-- <li class="{{ (request()->is('admin/cities*')) ? 'active' : '' }}"> --}}
        </li>
        @inject('perm', 'App\Http\Controllers\Controller')
        @if ($perm->auth('role_id') != null)
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('course')) ? 'active' : '' }}" href="/course">Kurzusok</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('schedule')) ? 'active' : '' }}" href="/schedule">Vizsga időpontok</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('user')) ? 'active' : '' }}" href="/user">Felhasználók</a>
        </li>
        @endif
        </ul>

      <ul class="navbar-nav justify-content-end">
        <li class="nav-item dropdown">
        @inject('logged', 'App\Http\Controllers\Controller')
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">{{$logged->auth('name') == null ? "Profil":$logged->auth('name');}}</a>
          <ul class="dropdown-menu dropdown-menu-dark" style="right:0;" aria-labelledby="dropdown01">
          @if ($logged->auth('name') == null)
            <li><a class="dropdown-item" href="/login">Bejelentkezés</a></li>
            <li><a class="dropdown-item" href="/registration">Regisztráció</a></li>
          @else
            <li><a class="dropdown-item" href="/user/profile/{{$logged->auth('id');}}">Adataim</a></li>
            <li><a class="dropdown-item" href="/user/edit/{{$logged->auth('id');}}">Adataim megváltoztatása</a></li>
            <li><a class="dropdown-item" href="/logout">Kijelentkezés</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a href="javascript:;" id="switchtheme" class="dropdown-item btn switch">Halvány/Sötét</a></li>
          @endif
          </ul>
        </li>
      </ul>
      <!--<form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>-->
    </div>
  </div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (document.cookie.indexOf("theme=dark") > -1) {
        
            $("body").toggleClass("bg-dark bg-light")
            
        }
        $("#switchtheme").click(function () {
            $("body").toggleClass("bg-dark bg-light");
            if ($("body").hasClass("bg-dark")) {
                document.cookie = "theme=dark";
            } else {
                document.cookie = "theme=light";
            }
        })

    });
</script>

</nav>