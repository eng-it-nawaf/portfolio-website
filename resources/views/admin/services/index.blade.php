@extends('admin.layouts.app')

@section('title', 'إدارة الخدمات')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">
                        <i class="fas fa-concierge-bell text-primary me-2"></i>
                        إدارة الخدمات
                    </h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> إضافة خدمة جديدة
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if($services->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th>الخدمة</th>
                            <th>الوصف</th>
                            <th width="120">الحالة</th>
                            <th width="120">مميز</th>
                            <th width="150" class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($service->icon)
                                    <div class="me-3">
                                        <i class="{{ $service->icon }} fa-lg text-primary"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1">{{ $service->title }}</h6>
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i>
                                            {{ $service->created_at->format('Y/m/d') }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 text-truncate" style="max-width: 300px;">
                                    {{ $service->excerpt }}
                                </p>
                            </td>
                            <td>
                                <form action="{{ route('admin.services.toggle-status', $service->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $service->is_active ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-{{ $service->is_active ? 'check-circle' : 'times-circle' }} me-1"></i>
                                        {{ $service->is_active ? 'نشط' : 'معطل' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.services.toggle-featured', $service->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $service->is_featured ? 'btn-warning' : 'btn-secondary' }}">
                                        <i class="fas fa-{{ $service->is_featured ? 'star' : 'star' }} me-1"></i>
                                        {{ $service->is_featured ? 'مميز' : 'عادي' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.services.show', $service->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" 
                                       class="btn btn-sm btn-warning" 
                                       title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <i class="fas fa-list me-1"></i>
                        إجمالي الخدمات: {{ $services->count() }}
                    </div>
                    <div>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>
                            نشط: {{ $services->where('is_active', true)->count() }}
                        </span>
                        <span class="badge bg-warning ms-2">
                            <i class="fas fa-star me-1"></i>
                            مميز: {{ $services->where('is_featured', true)->count() }}
                        </span>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="fas fa-concierge-bell fa-3x text-muted mb-3"></i>
                    <h4 class="mb-3">لا توجد خدمات</h4>
                    <p class="text-muted mb-4">ابدأ بإضافة خدماتك الأولى لعرضها هنا</p>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> إضافة خدمة جديدة
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.table th {
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}

.empty-state {
    padding: 3rem 1rem;
}

.empty-state i {
    opacity: 0.5;
}
</style>
@endsection