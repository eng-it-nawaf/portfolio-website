@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">إضافة خدمة جديدة</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">عنوان الخدمة *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">الوصف المختصر *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">المحتوى الكامل *</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="icon">أيقونة (Font Awesome)</label>
                    <input type="text" class="form-control" id="icon" name="icon" 
                           value="{{ old('icon') }}" placeholder="مثال: fas fa-code">
                    <small class="form-text text-muted">استخدم أسماء أيقونات Font Awesome</small>
                </div>

                <div class="form-group">
                    <label for="image">صورة الخدمة</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                           id="image" name="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>ميزات الخدمة</label>
                    <div id="features-container">
                        @if(old('features'))
                            @foreach(old('features') as $feature)
                            <div class="input-group mb-2">
                                <input type="text" name="features[]" class="form-control" value="{{ $feature }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger remove-feature" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-feature">
                        <i class="fas fa-plus"></i> إضافة ميزة
                    </button>
                </div>

                <div class="form-group">
                    <label>خطوات العمل</label>
                    <div id="process-container">
                        @if(old('process'))
                            @foreach(old('process') as $step)
                            <div class="input-group mb-2">
                                <input type="text" name="process[]" class="form-control" value="{{ $step }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger remove-process" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-process">
                        <i class="fas fa-plus"></i> إضافة خطوة
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_featured" 
                                   name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">خدمة مميزة</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" 
                                   name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">الحالة النشطة</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="order">ترتيب العرض</label>
                            <input type="number" class="form-control" id="order" name="order" 
                                   value="{{ old('order', 0) }}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> إلغاء
                </a>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // إضافة ميزة جديدة
    $('#add-feature').click(function() {
        $('#features-container').append(`
            <div class="input-group mb-2">
                <input type="text" name="features[]" class="form-control" placeholder="أدخل ميزة جديدة">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger remove-feature" type="button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `);
    });

    // إضافة خطوة جديدة
    $('#add-process').click(function() {
        $('#process-container').append(`
            <div class="input-group mb-2">
                <input type="text" name="process[]" class="form-control" placeholder="أدخل خطوة جديدة">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger remove-process" type="button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `);
    });

    // حذف ميزة أو خطوة
    $(document).on('click', '.remove-feature, .remove-process', function() {
        $(this).closest('.input-group').remove();
    });
});
</script>
@endpush
@endsection