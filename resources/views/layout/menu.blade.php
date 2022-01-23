<!-- Menü -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">E-LEARNING</a>
    <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Kezdőlap</a>
        </li>
        @inject('perm', 'App\Http\Controllers\Controller')
        @if ($perm->auth('role_id') != null)
        <li class="nav-item">
          <a class="nav-link" href="/course">Kurzusok</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/lesson">Tananyagok</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/quiz">Feladatok</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/user">Felhasználók</a>
        </li>
        @endif
        </ul>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item dropdown">
        @inject('logged', 'App\Http\Controllers\Controller')
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">{{$logged->auth('name') == null ? "Profil":$logged->auth('name');}}</a>
          <ul class="dropdown-menu" style="right:0;" aria-labelledby="dropdown01">
          @if ($logged->auth('name') == null)
            <li><a class="dropdown-item" href="/login">Bejelentkezés</a></li>
            <li><a class="dropdown-item" href="/registration">Regisztráció</a></li>
          @else
            <li><a class="dropdown-item" href="/user/profile/{{$logged->auth('id');}}">Adataim</a></li>
            <li><a class="dropdown-item" href="/user/edit/{{$logged->auth('id');}}">Adataim megváltoztatása</a></li>
            <li><a class="dropdown-item" href="/logout">Kijelentkezés</a></li>
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
</nav>