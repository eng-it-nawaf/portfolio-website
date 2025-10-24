@extends('admin.layouts.app')

@section('title', 'إدارة التقنيات')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h1 class="page-title">إدارة التقنيات</h1>
            <p class="page-description">إضافة وتعديل التقنيات المستخدمة في المشاريع</p>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة تقنية جديدة
            </a>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الأيقونة</th>
                            <th>عدد المشاريع</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($technologies as $technology)
                        <tr>
                            <td>{{ $technology->name }}</td>
                            <td>
                                @if($technology->icon)
                                    <i class="{{ $technology->icon }} fa-lg"></i>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $technology->projects_count }}</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST">
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