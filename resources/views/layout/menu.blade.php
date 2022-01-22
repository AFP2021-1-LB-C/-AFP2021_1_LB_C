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
        </ul>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item dropdown">
        @inject('logged', 'App\Http\Controllers\Controller')
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">{{$logged->auth('name');}}</a>
          <ul class="dropdown-menu" style="right:0;" aria-labelledby="dropdown01">
            <li><a class="dropdown-item" href="/user/profile/{{$logged->auth('id');}}">Adataim</a></li>
            <li><a class="dropdown-item" href="#">Jelszó megváltoztatása</a></li>
            <li><a class="dropdown-item" href="#">Kijelentkezés</a></li>
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