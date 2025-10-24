@extends('admin.layouts.app')

@section('title', 'إدارة الخبرات')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h1 class="page-title">إدارة الخبرات</h1>
            <p class="page-description">إضافة وتعديل خبراتك العملية</p>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة خبرة جديدة
            </a>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>العنوان</th>
                            <th>الشركة</th>
                            <th>النوع</th>
                            <th>الفترة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($experiences as $experience)
                        <tr>
                            <td>{{ $experience->title }}</td>
                            <td>{{ $experience->company }}</td>
                            <td>
                                @if($experience->type == 'full-time')
                                    <span class="badge badge-primary">دوام كامل</span>
                                @elseif($experience->type == 'part-time')
                                    <span class="badge badge-success">دوام جزئي</span>
                                @else
                                    <span class="badge badge-info">عمل حر</span>
                                @endif
                            </td>
                            <td>
                                {{ $experience->start_date?->format('M Y') ?? 'N/A' }} - 
                                {{ $experience->is_current ? 'الحاضر' : ($experience->end_date?->format('M Y') ?? 'N/A') }}
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST">
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