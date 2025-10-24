@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-profile.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">تفاصيل المشروع: {{ $project->title }}</h6>
            <div>
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> تعديل
                </a>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> رجوع
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="font-weight-bold">معلومات أساسية</h5>
                        <hr>
                        <p><strong>العنوان:</strong> {{ $project->title }}</p>
                        <p><strong>الفئة:</strong> 
                            @if($project->category == 'web')
                                Web
                            @elseif($project->category == 'mobile')
                                Mobile
                            @else
                               Desktop
                            @endif
                        </p>
                        <p><strong>تاريخ الإكمال:</strong> {{ $project->completed_at->format('Y-m-d') }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="font-weight-bold">التقنيات المستخدمة</h5>
                        <hr>
                        <div class="bg-light p-3 rounded">
                            {{ $project->technologies }}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="font-weight-bold">الروابط</h5>
                        <hr>
                        <p>
                            <strong>GitHub:</strong> 
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank">{{ $project->github_url }}</a>
                            @else
                                غير متوفر
                            @endif
                        </p>
                        <p>
                            <strong>Demo:</strong> 
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank">{{ $project->demo_url }}</a>
                            @else
                                غير متوفر
                            @endif
                        </p>
                        <p>
                            <strong>Google Play:</strong> 
                            @if($project->play_store_url)
                                <a href="{{ $project->play_store_url }}" target="_blank">{{ $project->play_store_url }}</a>
                            @else
                                غير متوفر
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <h5 class="font-weight-bold">الوصف</h5>
                <hr>
                <div class="bg-light p-3 rounded">
                    {!! nl2br(e($project->description)) !!}
                </div>
            </div>
            
            @if($project->images->count() > 0)
            <div class="mb-4">
                <h5 class="font-weight-bold">صور المشروع</h5>
                <hr>
                <div class="row">
                    @foreach($project->images as $image)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Project Image">
                            <div class="card-body p-2 text-center">
                                <form action="{{ route('admin.projects.destroyImage', ['project' => $project, 'image' => $image->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection