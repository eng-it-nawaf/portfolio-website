@extends('admin.layouts.app')

@section('title', 'تفاصيل المشروع')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-projects.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">تفاصيل المشروع</h1>
            <p class="page-description">عرض كافة معلومات المشروع: {{ $project->title }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> تعديل المشروع
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <div class="project-details">
        <!-- بطاقة المعلومات الأساسية -->
        <div class="project-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> المعلومات الأساسية
                </h3>
                <span class="project-status {{ $project->is_active ? 'active' : 'inactive' }}">
                    {{ $project->is_active ? 'نشط' : 'غير نشط' }}
                </span>
            </div>
            <div class="card-body">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>العنوان:</label>
                        <span>{{ $project->title }}</span>
                    </div>
                    <div class="detail-item">
                        <label>الفئة:</label>
                        <span>
                            @if($project->category == 'web')
                                <span class="badge badge-primary">ويب</span>
                            @elseif($project->category == 'mobile')
                                <span class="badge badge-success">موبايل</span>
                            @else
                                <span class="badge badge-info">سطح المكتب</span>
                            @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <label>تاريخ الإكمال:</label>
                        <span>{{ $project->completed_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="detail-item">
                        <label>تاريخ الإنشاء:</label>
                        <span>{{ $project->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- بطاقة الروابط -->
        <div class="project-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-link"></i> الروابط الخارجية
                </h3>
            </div>
            <div class="card-body">
                <div class="links-grid">
                    <div class="link-item">
                        <div class="link-icon">
                            <i class="fab fa-github"></i>
                        </div>
                        <div class="link-content">
                            <label>GitHub</label>
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="link-url">
                                    {{ $project->github_url }}
                                </a>
                            @else
                                <span class="link-missing">غير متوفر</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="link-item">
                        <div class="link-icon">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                        <div class="link-content">
                            <label>Demo</label>
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" class="link-url">
                                    {{ $project->demo_url }}
                                </a>
                            @else
                                <span class="link-missing">غير متوفر</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="link-item">
                        <div class="link-icon">
                            <i class="fab fa-google-play"></i>
                        </div>
                        <div class="link-content">
                            <label>Google Play</label>
                            @if($project->play_store_url)
                                <a href="{{ $project->play_store_url }}" target="_blank" class="link-url">
                                    {{ $project->play_store_url }}
                                </a>
                            @else
                                <span class="link-missing">غير متوفر</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- بطاقة الوصف -->
        <div class="project-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt"></i> وصف المشروع
                </h3>
            </div>
            <div class="card-body">
                <div class="description-content">
                    {!! nl2br(e($project->description)) !!}
                </div>
            </div>
        </div>

        <!-- بطاقة التقنيات -->
        <div class="project-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cogs"></i> التقنيات المستخدمة
                </h3>
            </div>
            <div class="card-body">
                <div class="technologies-grid">
                    @php
                        $technologies = explode(',', $project->technologies);
                    @endphp
                    @foreach($technologies as $tech)
                        <span class="tech-badge">{{ trim($tech) }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- بطاقة الصور -->
        @if($project->images->count() > 0)
        <div class="project-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-images"></i> معرض الصور
                    <span class="images-count">({{ $project->images->count() }} صورة)</span>
                </h3>
            </div>
            <div class="card-body">
                <div class="gallery-grid">
                    @foreach($project->images as $image)
                    <div class="gallery-item">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="صورة المشروع {{ $loop->iteration }}"
                             onclick="openModal('{{ asset('storage/' . $image->image_path) }}')">
                        <div class="gallery-actions">
                            <a href="{{ asset('storage/' . $image->image_path) }}" 
                               target="_blank" class="btn-action view" title="فتح في نافذة جديدة">
                                <i class="fas fa-expand"></i>
                            </a>
                            {{--  <form action="{{ route('admin.projects.destroyImage', ['project' => $project, 'image' => $image->id]) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action delete" title="حذف الصورة" 
                                        onclick="return confirm('هل أنت متأكد من حذف هذه الصورة؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>  --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal للصورة -->
<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
    <div class="modal-caption" id="modalCaption"></div>
</div>



<script>
function openModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImg.src = src;
}

function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Close modal when clicking outside the image
window.onclick = function(event) {
    const modal = document.getElementById('imageModal');
    if (event.target === modal) {
        closeModal();
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});
</script>
@endsection