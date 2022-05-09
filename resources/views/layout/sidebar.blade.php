<div class="container-fluid bg-dark sidebar shadow-sm">
    <div class="row flex-nowrap navbar-dark bg-dark">
        <div class="col-auto col-md-2 col-xl-1 px-sm-1 px-0">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
                <ul class="nav navbar-nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                @foreach ($items as $item)
                    <li class="nav-item active" style="display:block; text-align:center;">
                        <a href="/course/homepage/{{$item -> id}}" class="nav-link align-middle px-0">
                            <img class="me-3" src="/images/home.png" alt="" width="40" height="40" style="margin-top:20px; margin-left:15px; text-align:center;">
                            <i class="fs-4"></i> <span class="ms-1 d-none d-sm-inline">Kezdőlap</span>
                        </a>
                    </li>
                    <li class="nav-item" style="display:block; text-align:center;">
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <img class="me-3" src="/images/syllabus.png" alt="" width="40" height="40" style="margin-top:10px; margin-left:15px; text-align:center;">
                            <i class="fs-4"></i> <span class="ms-1 d-none d-sm-inline">Tanmenet</span>
                        </a>
                    </li>
                    <li class="nav-item" style="display:block; text-align:center;">
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <img class="me-3" src="/images/grade.png" alt="" width="40" height="40" style="margin-top:10px; margin-left:15px; text-align:center;">
                            <i class="fs-4"></i> <span class="ms-1 d-none d-sm-inline">Napló</span>
                        </a>
                    </li>
                    <li class="nav-item" style="display:block; text-align:center;">
                        <a href="/course/lesson/{{$item -> id}}" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <img class="me-3" src="/images/lectures.png" alt="" width="40" height="40" style="margin-top:10px; margin-left:15px; text-align:center;">
                            <i class="fs-4"></i> <span class="ms-1 d-none d-sm-inline">Tananyagok</span>
                        </a>
                    </li>
                    <li class="nav-item" style="display:block; text-align:center;">
                        <a href="/course/quiz/{{$item -> id}}" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <img class="me-3" src="/images/test.png" alt="" width="40" height="40" style="margin-top:10px; margin-left:15px; text-align:center;">
                            <i class="fs-4"></i> <span class="ms-1 d-none d-sm-inline">Feladatok</span>
                        </a>
                    </li>
                @endforeach
                </ul>
                <hr>
            </div>
        </div>
    </div>
</div>