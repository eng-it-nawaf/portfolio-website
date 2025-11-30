@extends('admin.layouts.app')

@section('title', 'إدارة المشاريع')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">إدارة المشاريع</h1>
            <p class="page-description">إضافة وتعديل مشاريعك الشخصية</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة مشروع جديد
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success fade-in">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        <div class="card-body">
            @if($projects->count() > 0)
            <div class="table-responsive">
                <table class="projects-table sortable-table" data-sort-url="{{ route('admin.projects.reorder') }}">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>العنوان</th>
                            <th width="120">الفئة</th>
                            <th>التقنيات</th>
                            <th width="80">الصور</th>
                            <th width="100">الحالة</th>
                            <th width="120">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @foreach($projects as $project)
                        <tr data-id="{{ $project->id }}">
                            <td>
                                <i class="fas fa-arrows-alt sortable-handle" title="اسحب لتغيير الترتيب"></i>
                            </td>
                            <td>
                                <div class="project-title">
                                    <strong>{{ $project->title }}</strong>
                                    <small class="project-date">{{ $project->completed_at->format('d/m/Y') }}</small>
                                </div>
                            </td>
                            <td>
                                @if($project->category == 'web')
                                    <span class="badge badge-primary">ويب</span>
                                @elseif($project->category == 'mobile')
                                    <span class="badge badge-success">موبايل</span>
                                @else
                                    <span class="badge badge-info">سطح المكتب</span>
                                @endif
                            </td>
                            <td>
                                <div class="technologies-list">
                                    @php
                                        $techs = explode(',', $project->technologies);
                                        $displayTechs = array_slice($techs, 0, 3);
                                    @endphp
                                    @foreach($displayTechs as $tech)
                                        <span class="tech-tag">{{ trim($tech) }}</span>
                                    @endforeach
                                    @if(count($techs) > 3)
                                        <span class="tech-more">+{{ count($techs) - 3 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="images-count">
                                    <i class="fas fa-image"></i>
                                    <span>{{ $project->images_count }}</span>
                                </div>
                            </td>
                            <td>
                                @if($project->is_active)
                                    <span class="badge badge-success">نشط</span>
                                @else
                                    <span class="badge badge-danger">غير نشط</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.projects.show', $project) }}" class="btn-action view" title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn-action edit" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذا المشروع؟')">
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
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h3 class="empty-title">لا توجد مشاريع</h3>
                <p class="empty-description">ابدأ بإضافة مشروعك الأول لعرضه هنا</p>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة مشروع جديد
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-projects.css') }}">
@endpush

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