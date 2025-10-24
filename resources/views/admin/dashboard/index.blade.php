@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h1 class="page-title">لوحة التحكم</h1>
            <p class="page-description">نظرة عامة على الإحصائيات والنشاطات الحديثة</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="admin-card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-3">
                        <i class="fas fa-user text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">1</h3>
                        <p class="text-sm text-gray-500">مستخدم نشط</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="admin-card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-emerald-50 text-emerald-600 mr-3">
                        <i class="fas fa-cogs text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $skillsCount }}</h3>
                        <p class="text-sm text-gray-500">مهارة</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="admin-card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-violet-50 text-violet-600 mr-3">
                        <i class="fas fa-project-diagram text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $projectsCount }}</h3>
                        <p class="text-sm text-gray-500">مشروع</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="admin-card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-amber-50 text-amber-600 mr-3">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $messagesCount }}</h3>
                        <p class="text-sm text-gray-500">رسالة جديدة</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="admin-card">
            <div class="card-header">
                <h3 class="card-title">النشاط الحديث</h3>
                <a href="#" class="text-sm text-primary">عرض الكل</a>
            </div>
            <div class="card-body">
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="p-2 rounded-lg bg-blue-50 text-blue-600 mr-3">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">تم تحديث المعلومات الشخصية</p>
                            <p class="text-sm text-gray-500 mt-1">{{ now()->subHours(2)->diffForHumans() }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="p-2 rounded-lg bg-emerald-50 text-emerald-600 mr-3">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">تم إضافة مهارة جديدة</p>
                            <p class="text-sm text-gray-500 mt-1">{{ now()->subDays(1)->diffForHumans() }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="p-2 rounded-lg bg-violet-50 text-violet-600 mr-3">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">تم نشر مشروع جديد</p>
                            <p class="text-sm text-gray-500 mt-1">{{ now()->subDays(3)->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="admin-card">
            <div class="card-header">
                <h3 class="card-title">إجراءات سريعة</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.projects.create') }}" class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition">
                        <div class="w-10 h-10 rounded-full bg-violet-50 text-violet-600 flex items-center justify-center mb-2">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="text-sm font-medium">إضافة مشروع</span>
                    </a>
                    
                    <a href="{{ route('admin.skills.create') }}" class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-2">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="text-sm font-medium">إضافة مهارة</span>
                    </a>
                    
                    <a href="{{ route('admin.technologies.create') }}" class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-2">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="text-sm font-medium">إضافة تقنية</span>
                    </a>
                    
                    <a href="{{ route('admin.messages.index') }}" class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition">
                        <div class="w-10 h-10 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center mb-2">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <span class="text-sm font-medium">الرسائل الجديدة</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection