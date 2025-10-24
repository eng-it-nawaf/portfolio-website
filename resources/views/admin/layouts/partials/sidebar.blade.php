<aside class="admin-sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <div class="sidebar-logo">
                <i class="fas fa-cog"></i>
            </div>
            <span class="sidebar-title">لوحة التحكم</span>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>لوحة التحكم</span>
            </a>
            
            <a href="{{ route('admin.profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.profile.edit') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>الملف الشخصي</span>
            </a>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">إدارة المحتوى</div>
                
                <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i>
                    <span>المهارات</span>
                </a>
                
                <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="fas fa-project-diagram"></i>
                    <span>المشاريع</span>
                </a>
                
                <a href="{{ route('admin.technologies.index') }}" class="sidebar-link {{ request()->routeIs('admin.technologies.*') ? 'active' : '' }}">
                    <i class="fas fa-microchip"></i>
                    <span>التقنيات</span>
                </a>
                
                <a href="{{ route('admin.experiences.index') }}" class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span>الخبرات</span>
                </a>
                
                <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="fas fa-server"></i>
                    <span>الخدمات</span>
                </a>
            </div>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">التواصل</div>
                
                <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    <span>رسائل الزوار</span>
                </a>
            </div>
        </nav>
    </div>
    
    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">مدير النظام</div>
            </div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</aside>