<header class="admin-header">
    <div class="header-left">
        <button class="menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="page-title">@yield('title', 'لوحة التحكم')</h1>
    </div>
    
    <div class="header-right">
        <div class="notification-btn">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">3</span>
        </div>
        
        <div class="user-menu-btn relative">
            <div class="user-avatar-sm">{{ substr(auth()->user()->name, 0, 1) }}</div>
            <span class="hidden md:inline-block ml-2">{{ auth()->user()->name }}</span>
            
            <div class="user-dropdown">
                <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    <span>الملف الشخصي</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    <span>الإعدادات</span>
                </a>
                <div class="border-t border-gray-100 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-right w-full">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>