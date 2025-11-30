@extends('admin.layouts.app')

@section('title', 'إدارة الخدمات')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-services.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">إدارة الخدمات</h1>
            <p class="page-description">إضافة وتعديل الخدمات التي تقدمها</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة خدمة جديدة
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success fade-in">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="service-card">
        <div class="card-body">
            @if($services->count() > 0)
            <div class="table-responsive">
                <table class="services-table sortable-table" data-sort-url="{{ route('admin.services.reorder') }}">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>الخدمة</th>
                            <th>الوصف</th>
                            <th width="100">مميز</th>
                            <th width="100">الحالة</th>
                            <th width="120">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @foreach($services as $service)
                        <tr data-id="{{ $service->id }}">
                            <td>
                                <i class="fas fa-arrows-alt sortable-handle" title="اسحب لتغيير الترتيب"></i>
                            </td>
                            <td>
                                <div class="service-info">
                                    @if($service->icon)
                                    <div class="service-icon">
                                        <i class="{{ $service->icon }}"></i>
                                    </div>
                                    @endif
                                    <div class="service-details">
                                        <strong class="service-title">{{ $service->title }}</strong>
                                        @if($service->image)
                                        <small class="service-has-image">تحتوي على صورة</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="service-description">{{ Str::limit($service->description, 60) }}</span>
                            </td>
                            <td class="text-center">
                                @if($service->is_featured)
                                    <span class="badge badge-success">نعم</span>
                                @else
                                    <span class="badge badge-secondary">لا</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($service->is_active)
                                    <span class="badge badge-success">نشط</span>
                                @else
                                    <span class="badge badge-danger">غير نشط</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.services.show', $service) }}" class="btn-action view" title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn-action edit" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذه الخدمة؟')">
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
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h3 class="empty-title">لا توجد خدمات</h3>
                <p class="empty-description">ابدأ بإضافة خدمتك الأولى لعرضها هنا</p>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة خدمة جديدة
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1px solid transparent;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border-color: #a7f3d0;
}

.alert-success i {
    color: #10b981;
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.service-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.service-icon {
    width: 36px;
    height: 36px;
    background: #f3f4f6;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 14px;
    flex-shrink: 0;
}

.service-details {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.service-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--dark-color);
}

.service-has-image {
    font-size: 10px;
    color: var(--secondary-color);
    background: #f3f4f6;
    padding: 2px 6px;
    border-radius: 4px;
    align-self: flex-start;
}

.service-description {
    font-size: 12px;
    color: var(--secondary-color);
    line-height: 1.4;
}

.actions {
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 12px;
}

.btn-action.view {
    background: #dbeafe;
    color: #1d4ed8;
}

.btn-action.view:hover {
    background: #1d4ed8;
    color: white;
}

.btn-action.edit {
    background: #fef3c7;
    color: #d97706;
}

.btn-action.edit:hover {
    background: #d97706;
    color: white;
}

.btn-action.delete {
    background: #fef2f2;
    color: #dc2626;
}

.btn-action.delete:hover {
    background: #dc2626;
    color: white;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: var(--secondary-color);
    font-size: 32px;
}

.empty-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 8px;
}

.empty-description {
    font-size: 14px;
    color: var(--secondary-color);
    margin-bottom: 20px;
}

.sortable-ghost {
    opacity: 0.4;
    background: #e5e7eb;
}

@media (max-width: 768px) {
    .service-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
    }
    
    .service-icon {
        align-self: flex-start;
    }
    
    .actions {
        flex-direction: column;
        gap: 4px;
    }
    
    .btn-action {
        width: 28px;
        height: 28px;
    }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableTable = document.querySelector('.sortable-table');
    if (sortableTable) {
        new Sortable(sortableTable.querySelector('tbody'), {
            handle: '.sortable-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function() {
                const order = Array.from(sortableTable.querySelectorAll('tr[data-id]')).map(row => row.dataset.id);
                const url = sortableTable.dataset.sortUrl;
                
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ order })
                });
            }
        });
    }
});
</script>
@endpush
@endsection