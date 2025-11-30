@extends('admin.layouts.app')

@section('title', 'إدارة المهارات')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-skills.css') }}">
@endpush

@section('content')
<div class="skills-management">
    <div class="page-header">
        <div>
            <h1 class="page-title">إدارة المهارات</h1>
            <p class="page-description">إضافة وتعديل مهاراتك الشخصية</p>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.skills.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> إضافة مهارة جديدة
            </a>
        </div>
    </div>

    @foreach($categories as $category)
    <div class="category-card fade-in-up">
        <div class="category-header">
            <h3 class="category-title">{{ $category }}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="skills-table sortable-table" data-sort-url="{{ route('admin.skills.reorder') }}">
                    <thead>
                        <tr>
                            <th width="50" data-label="ترتيب">#</th>
                            <th data-label="الأيقونة">الأيقونة</th>
                            <th data-label="الاسم">الاسم</th>
                            <th data-label="المستوى">المستوى</th>
                            <th data-label="الإجراءات">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-category="{{ $category }}">
                        @foreach($skills->where('category', $category) as $skill)
                        <tr data-id="{{ $skill->id }}">
                            <td data-label="ترتيب">
                                <i class="fas fa-arrows-alt sortable-handle"></i>
                            </td>
                            <td data-label="الأيقونة">
                                <div class="skill-icon">
                                    <i class="{{ $skill->icon }}"></i>
                                </div>
                            </td>
                            <td data-label="الاسم">
                                <strong>{{ $skill->name }}</strong>
                            </td>
                            <td data-label="المستوى">
                                <div class="progress-container">
                                    <div class="progress-bar-bg">
                                        <div class="progress-bar-fill" style="width: {{ $skill->percentage }}%"></div>
                                    </div>
                                    <span class="percentage-text">{{ $skill->percentage }}%</span>
                                </div>
                            </td>
                            <td data-label="الإجراءات">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="btn-action btn-edit" data-toggle="tooltip" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" data-toggle="tooltip" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')">
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
    @endforeach
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize sortable for each category
    document.querySelectorAll('.sortable-table').forEach(table => {
        new Sortable(table.querySelector('tbody'), {
            handle: '.sortable-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function(evt) {
                const order = Array.from(table.querySelectorAll('tr[data-id]')).map(row => row.dataset.id);
                const category = table.querySelector('tbody').dataset.category;
                const url = table.dataset.sortUrl;
                
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ order, category })
                }).then(response => {
                    if (!response.ok) {
                        console.error('Failed to update order');
                    }
                });
            }
        });
    });

    // Add animation to progress bars
    document.querySelectorAll('.progress-bar-fill').forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
            bar.style.width = width;
        }, 100);
    });
});
</script>
@endpush