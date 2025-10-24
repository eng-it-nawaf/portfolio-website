@extends('admin.layouts.app')

@section('title', 'إدارة المشاريع')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h1 class="page-title">إدارة المشاريع</h1>
            <p class="page-description">إضافة وتعديل مشاريعك الشخصية</p>
        </div>
        <div class="ms-auto">
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
            <div class="table-responsive">
                <table class="admin-table sortable-table" data-sort-url="{{ route('admin.projects.reorder') }}">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>العنوان</th>
                            <th>الفئة</th>
                            <th>التقنيات</th>
                            <th>الصور</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @foreach($projects as $project)
                        <tr data-id="{{ $project->id }}">
                            <td><i class="fas fa-arrows-alt sortable-handle"></i></td>
                            <td>{{ $project->title }}</td>
                            <td>
                                @if($project->category == 'web')
                                    <span class="badge badge-primary">ويب</span>
                                @elseif($project->category == 'mobile')
                                    <span class="badge badge-success">موبايل</span>
                                @else
                                    <span class="badge badge-info">سطح المكتب</span>
                                @endif
                            </td>
                            {{--  <td>
                                @foreach($project->technologies as $tech)
                                    <span class="badge badge-secondary">{{ $tech->name }}</span>
                                @endforeach
                            </td>  --}}
                            <td>{{ $project->images_count }}</td>
                            <td>
                                @if($project->is_active)
                                    <span class="badge badge-success">نشط</span>
                                @else
                                    <span class="badge badge-danger">غير نشط</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="حذف" onclick="return confirm('هل أنت متأكد؟')">
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
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize sortable
    const sortableTable = document.querySelector('.sortable-table');
    if (sortableTable) {
        new Sortable(sortableTable.querySelector('tbody'), {
            handle: '.sortable-handle',
            animation: 150,
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