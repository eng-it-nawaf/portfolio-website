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

<style>
/* تنسيقات شريط التنقل */
/* المتغيرات العامة */
:root {
    --primary: rgba(108, 92, 231, 0.9);
    --primary-light: rgba(162, 155, 254, 0.7);
    --secondary: rgba(0, 184, 148, 0.9);
    --dark: rgba(7, 149, 189, 0.9);
    --light: rgba(245, 246, 250, 0.95);
    --gray: rgba(99, 110, 114, 0.8);
    --gradient: linear-gradient(135deg, var(--primary), var(--secondary));
    --shadow: 0 10px 30px rgba(10, 139, 149, 0.1);
    --section-padding: 80px 0;
}

/* تحسينات عامة */
body {
    background-color: #108a8ebb;
    color: #fff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    padding-top: 70px !important;
    overflow-x: hidden;
    margin: 0 !important;
}

/* تأكد من أن النافبار أعلى كل شيء */
.navbar {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 103090 !important; /* قيمة عالية تضمن ظهوره فوق كل شيء */
}

/* تأكد من أن تأثيرات الخلفية لا تتداخل */
.cursor-effect, 
.particles-container, 
.moving-light,
.interactive-grid {
    z-index: -1 !important; /* خلف كل المحتوى */
    position: fixed;
}

.navbar.scrolled {
    background: rgba(8, 137, 151, 0.708) !important;
    box-shadow: 0 4px 30px rgba(7, 159, 123, 0.1) !important;
    padding: 0.75rem 0 !important;
}

.navbar-brand {
    display: flex;
    align-items: center;
    font-weight: 700;
    font-size: 1.3rem;
    color: white !important;
}

.logo-icon {
    font-size: 1.8rem;
    color: #6366f1;
    transition: transform 0.3s ease;
}

.logo-text {
    background: linear-gradient(90deg, #6366f1, #a855f7);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    position: relative;
}

.logo-text::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #6366f1, #a855f7);
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.4s ease;
}
.navbar-custom {
    z-index: 10000; /* قيمة أعلى من العناصر الأخرى */
}

.navbar-brand:hover .logo-icon {
    transform: rotate(15deg) scale(1.1);
}

.navbar-brand:hover .logo-text::after {
    transform: scaleX(1);
    transform-origin: left;
}

.nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
    font-weight: 500;
    padding: 0.5rem 1rem !important;
    position: relative;
    transition: all 0.3s ease;
}

.nav-link:hover,
.nav-link.active {
    color: white !important;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 1rem;
    width: calc(100% - 2rem);
    height: 2px;
    background: linear-gradient(90deg, #6366f1, #a855f7);
    border-radius: 2px;
}

.navbar-toggler {
    border: none;
    color: white;
    font-size: 1.5rem;
    padding: 0.5rem;
}

.navbar-toggler:focus {
    box-shadow: none;
}

@media (max-width: 767.98px) {
    .navbar {
        padding: 0.75rem 0 !important;
    }
    
    body {
        padding-top: 60px !important;
    }
}

/* القائمة المتنقلة للشاشات الصغيرة */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background: rgba(30, 41, 59, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 1rem;
        margin-top: 1rem;
        border-radius: 0.5rem;
    }
    
    .nav-link {
        padding: 0.75rem 0 !important;
    }
    
    .nav-link.active::after {
        left: 0;
        width: 100%;
    }

        body {
        padding-top: 70px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    
    function updateNavbar() {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
    
    // تهيئة أولية
    updateNavbar();
    
    // استماع لحدث التمرير
    window.addEventListener('scroll', updateNavbar);
});
</script>