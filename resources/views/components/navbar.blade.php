<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="{{route('home')}}">
                <i class="fa-sharp fa-regular fa-crosshairs"></i>
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('index.turmas')}}">Turmas</a>
                </li>
                @if(session()->has('id'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index.avaliacao')}}">Avaliações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Projects</a>
                    </li>
                @endif
            </ul>
            <!-- Left links -->
        </div>
        @if(session()->has('id'))
            <form action="{{route('logout.usuarios')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-info"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i></button>
            </form>
        @else
            <form action="{{route('index.usuarios')}}" method="get">
                <button type="submit" class="btn btn-info"><i class="fa-solid fa-user-plus"></i></button>
            </form>
       @endif
</nav>
<!-- Navbar -->
