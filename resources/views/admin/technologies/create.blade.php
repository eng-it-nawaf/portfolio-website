@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">إضافة تقنية جديدة</h6>
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.technologies.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">اسم التقنية</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="icon" class="form-label">أيقونة (اختياري)</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" 
                           value="{{ old('icon') }}" placeholder="مثال: fab fa-laravel">
                    <small class="text-muted">استخدم أيقونات Font Awesome (مثال: fab fa-laravel, fas fa-code)</small>
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">حفظ</button>
            </form>
        </div>
    </div>
</div>
@endsection