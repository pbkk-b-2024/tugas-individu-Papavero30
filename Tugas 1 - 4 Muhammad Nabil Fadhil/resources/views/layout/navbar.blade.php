<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark sticky-top bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="btn btn-dark me-2" id="sidebarToggle" type="button">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand fw-light" href="/"><span class="fa-solid fa-table-columns"> </span>Kantin Gymbros</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@include('sidebar.sidebar')