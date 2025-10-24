@extends('admin.layouts.app')

@section('title', 'إدارة المهارات')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h1 class="page-title">إدارة المهارات</h1>
            <p class="page-description">إضافة وتعديل مهاراتك الشخصية</p>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة مهارة جديدة
            </a>
        </div>
    </div>

    @foreach($categories as $category)
    <div class="admin-card mb-4">
        <div class="card-header">
            <h3 class="card-title">{{ $category }}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="admin-table sortable-table" data-sort-url="{{ route('admin.skills.reorder') }}">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>الأيقونة</th>
                            <th>الاسم</th>
                            <th>النسبة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-category="{{ $category }}">
                        @foreach($skills->where('category', $category) as $skill)
                        <tr data-id="{{ $skill->id }}">
                            <td><i class="fas fa-arrows-alt sortable-handle"></i></td>
                            <td><i class="{{ $skill->icon }} fa-lg"></i></td>
                            <td>{{ $skill->name }}</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $skill->percentage }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $skill->percentage }}%</span>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST">
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
            onEnd: function() {
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
                });
            }
        });
    });
});
</script>
@endpush