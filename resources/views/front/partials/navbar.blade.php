<nav class="navbar navbar-expand-lg fixed-top navbar-scroll" id="mainNavbar">
    <div class="container">
        <!-- اللوجو -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="logo-icon me-2">
                <i class="fas fa-code"></i>
            </span>
            <span class="logo-text">{{ config('app.name', 'My Portfolio') }}</span>
        </a>

        <!-- زر القائمة المتنقلة -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- محتوى شريط التنقل -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i> {{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="fas fa-user me-1"></i> {{ __('About') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}" href="{{ route('projects') }}">
                        <i class="fas fa-project-diagram me-1"></i> {{ __('Projects') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">
                        <i class="fas fa-cogs me-1"></i> {{ __('Services') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('home') }}#contact">
                        <i class="fas fa-envelope me-1"></i> {{ __('contact') }}
                    </a>
                </li>
            </ul>

           
        </div>
    </div>
</nav>

<link href="{{ asset('front/css/navbar.css') }}" rel="stylesheet">
    <script src="{{ asset('front/js/navbar-footer.js') }}"></script>
