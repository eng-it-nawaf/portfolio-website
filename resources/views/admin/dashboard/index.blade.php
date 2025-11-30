@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">لوحة التحكم</h1>
            <p class="page-description">نظرة عامة على الإحصائيات والنشاطات الحديثة</p>
        </div>
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon user-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">1</h3>
                <p class="stat-label">مستخدم نشط</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon skill-icon">
                <i class="fas fa-cogs"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $skillsCount }}</h3>
                <p class="stat-label">مهارة</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon project-icon">
                <i class="fas fa-project-diagram"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $projectsCount }}</h3>
                <p class="stat-label">مشروع</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon message-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $messagesCount }}</h3>
                <p class="stat-label">رسالة جديدة</p>
            </div>
        </div>
    </div>

    <!-- الشبكة الرئيسية -->
    <div class="main-grid">
        <!-- النشاط الحديث -->
        <div class="activity-card admin-card">
            <div class="card-header">
                <h3 class="card-title">النشاط الحديث</h3>
                <a href="#" class="view-all-link">عرض الكل</a>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon info">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-text">تم تحديث المعلومات الشخصية</p>
                            <span class="activity-time">{{ now()->subHours(2)->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon success">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-text">تم إضافة مهارة جديدة</p>
                            <span class="activity-time">{{ now()->subDays(1)->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon primary">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-text">تم نشر مشروع جديد</p>
                            <span class="activity-time">{{ now()->subDays(3)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- الإجراءات السريعة -->
        <div class="actions-card admin-card">
            <div class="card-header">
                <h3 class="card-title">إجراءات سريعة</h3>
            </div>
            <div class="card-body">
                <div class="actions-grid">
                    <a href="{{ route('admin.projects.create') }}" class="action-item">
                        <div class="action-icon project">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="action-text">إضافة مشروع</span>
                    </a>
                    
                    <a href="{{ route('admin.skills.create') }}" class="action-item">
                        <div class="action-icon skill">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="action-text">إضافة مهارة</span>
                    </a>
                    
                    <a href="{{ route('admin.technologies.create') }}" class="action-item">
                        <div class="action-icon tech">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="action-text">إضافة تقنية</span>
                    </a>
                    
                    <a href="{{ route('admin.messages.index') }}" class="action-item">
                        <div class="action-icon message">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <span class="action-text">الرسائل الجديدة</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: #fff;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.user-icon { background: #dbeafe; color: #1d4ed8; }
.skill-icon { background: #d1fae5; color: #047857; }
.project-icon { background: #ede9fe; color: #7c3aed; }
.message-icon { background: #fef3c7; color: #d97706; }

.stat-content h3 {
    font-size: 28px;
    font-weight: 700;
    color: var(--dark-color);
    margin: 0 0 4px 0;
}

.stat-label {
    font-size: 13px;
    color: var(--secondary-color);
    margin: 0;
}

.main-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.activity-list {
    space-y: 20px;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px 0;
    border-bottom: 1px solid var(--border-color);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.activity-icon.info { background: #dbeafe; color: #1d4ed8; }
.activity-icon.success { background: #d1fae5; color: #047857; }
.activity-icon.primary { background: #ede9fe; color: #7c3aed; }

.activity-content {
    flex: 1;
}

.activity-text {
    font-size: 13px;
    font-weight: 500;
    color: var(--dark-color);
    margin: 0 0 4px 0;
}

.activity-time {
    font-size: 11px;
    color: var(--secondary-color);
}

.actions-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.action-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.action-item:hover {
    background: #f8fafc;
    border-color: var(--primary-color);
    transform: translateY(-2px);
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    font-size: 18px;
}

.action-icon.project { background: #ede9fe; color: #7c3aed; }
.action-icon.skill { background: #d1fae5; color: #047857; }
.action-icon.tech { background: #dbeafe; color: #1d4ed8; }
.action-icon.message { background: #fef3c7; color: #d97706; }

.action-text {
    font-size: 12px;
    font-weight: 600;
    color: var(--dark-color);
    text-align: center;
}

.view-all-link {
    font-size: 13px;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

@media (max-width: 1024px) {
    .main-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-card {
        padding: 20px;
    }
}
</style>
@endsection