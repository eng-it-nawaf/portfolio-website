@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">تفاصيل الخدمة: {{ $service->title }}</h6>
            <div>
                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> تعديل
                </a>
                <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-list"></i> العودة للقائمة
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="service-details">
                        @if($service->image)
                        <div class="service-image mb-4">
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->title }}" 
                                 class="img-fluid rounded">
                        </div>
                        @endif

                        <div class="service-description mb-4">
                            <h4>الوصف المختصر:</h4>
                            <p>{{ $service->description }}</p>
                        </div>

                        <div class="service-content mb-4">
                            <h4>المحتوى الكامل:</h4>
                            <div>{!! $service->content !!}</div>
                        </div>

                        @if(!empty($service->features))
                        <div class="service-features mb-4">
                            <h4>ميزات الخدمة:</h4>
                            <ul class="list-group">
                                @foreach($service->features as $feature)
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success mr-2"></i>
                                    {{ $feature }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(!empty($service->process))
                        <div class="service-process mb-4">
                            <h4>خطوات العمل:</h4>
                            <ol class="list-group">
                                @foreach($service->process as $step)
                                <li class="list-group-item">
                                    <span class="badge badge-primary mr-2">{{ $loop->iteration }}</span>
                                    {{ $step }}
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-meta card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold">معلومات الخدمة</h6>
                        </div>
                        <div class="card-body">
                            <div class="meta-item mb-3">
                                <h6>الأيقونة:</h6>
                                @if($service->icon)
                                <p><i class="{{ $service->icon }} fa-2x"></i></p>
                                @else
                                <p class="text-muted">غير محدد</p>
                                @endif
                            </div>

                            <div class="meta-item mb-3">
                                <h6>الحالة:</h6>
                                @if($service->is_active)
                                <span class="badge badge-success">نشط</span>
                                @else
                                <span class="badge badge-danger">غير نشط</span>
                                @endif
                            </div>

                            <div class="meta-item mb-3">
                                <h6>مميزة:</h6>
                                @if($service->is_featured)
                                <span class="badge badge-primary">نعم</span>
                                @else
                                <span class="badge badge-secondary">لا</span>
                                @endif
                            </div>

                            <div class="meta-item mb-3">
                                <h6>ترتيب العرض:</h6>
                                <p>{{ $service->order }}</p>
                            </div>

                            <div class="meta-item mb-3">
                                <h6>تاريخ الإنشاء:</h6>
                                <p>{{ $service->created_at->format('Y/m/d H:i') }}</p>
                            </div>

                            <div class="meta-item">
                                <h6>آخر تحديث:</h6>
                                <p>{{ $service->updated_at->format('Y/m/d H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.service-details h4 {
    color: #4e73df;
    border-bottom: 1px solid #eee;
    padding-bottom: 8px;
    margin-bottom: 15px;
}
.service-meta .meta-item h6 {
    font-weight: bold;
    color: #6c757d;
    margin-bottom: 5px;
}
.list-group-item {
    display: flex;
    align-items: center;
}
</style>
@endpush