@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/admin-profile.css') }}">
@endpush

@section('content')
<div class="container-fluid profile-edit-container">
    <div class="profile-card">
        <!-- الهيدر -->
        <div class="profile-header">
            <h3>تعديل الملف الشخصي</h3>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left me-1"></i> رجوع
            </a>
        </div>

        <!-- محتوى البطاقة -->
        <div class="card-body p-4">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                @php
                    $socialLinks = $profile->social_links ?? [];
                @endphp

                <div class="row g-4">
                    <!-- بطاقة الصورة الشخصية -->
                    <div class="col-lg-4">
                        <div class="photo-card">
                            <div class="card-body text-center">
                                <div class="photo-container">
                                    <img src="{{ $profile->photo ? asset('storage/' . $profile->photo) : asset('images/default-avatar.png') }}"
                                         id="photoPreview"
                                         class="profile-photo rounded-circle shadow"
                                         style="object-fit: cover">
                                </div>

                                <label class="btn-change-photo">
                                    <i class="fas fa-camera me-1"></i> تغيير الصورة
                                    <input type="file" class="d-none" id="photo" name="photo" onchange="previewImage(this)">
                                </label>

                                <div class="user-info">
                                    <h5 class="user-name">{{ $profile->name ?? 'الاسم الكامل' }}</h5>
                                    <p class="user-title">{{ $profile->title ?? 'المسمى الوظيفي' }}</p>
                                    <div class="social-links">
                                        @isset($socialLinks['github'])
                                            <a href="{{ $socialLinks['github'] }}" target="_blank">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        @endisset
                                        @isset($socialLinks['linkedin'])
                                            <a href="{{ $socialLinks['linkedin'] }}" target="_blank">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        @endisset
                                        @isset($socialLinks['twitter'])
                                            <a href="{{ $socialLinks['twitter'] }}" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- بطاقة المعلومات -->
                    <div class="col-lg-8">
                        <div class="info-card h-100">
                            <div class="card-body">
                                <!-- المعلومات الأساسية -->
                                <h5 class="section-title">
                                    <i class="fas fa-user-edit"></i> المعلومات الأساسية
                                </h5>

                                <div class="form-row">
                                    <!-- الاسم الكامل -->
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label for="name" class="form-label">الاسم الكامل</label>
                                            <input type="text" class="form-control" id="name" name="name" 
                                                   value="{{ old('name', $profile->name) }}" required>
                                            <div class="invalid-feedback">يرجى إدخال الاسم الكامل</div>
                                        </div>
                                    </div>

                                    <!-- المسمى الوظيفي -->
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label for="title" class="form-label">المسمى الوظيفي</label>
                                            <input type="text" class="form-control" id="title" name="title" 
                                                   value="{{ old('title', $profile->title) }}" required>
                                            <div class="invalid-feedback">يرجى إدخال المسمى الوظيفي</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- البريد الإلكتروني -->
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label for="email" class="form-label">البريد الإلكتروني</label>
                                            <div class="input-icon">
                                                <i class="fas fa-envelope"></i>
                                                <input type="email" class="form-control" id="email" name="email" 
                                                       value="{{ old('email', $profile->email) }}" required>
                                            </div>
                                            <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح</div>
                                        </div>
                                    </div>

                                    <!-- رقم الهاتف -->
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">رقم الهاتف</label>
                                            <div class="input-icon">
                                                <i class="fas fa-phone"></i>
                                                <input type="text" class="form-control" id="phone" name="phone" 
                                                       value="{{ old('phone', $profile->phone) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- نبذة عني -->
                                <div class="form-group long-field">
                                    <label for="about" class="form-label">نبذة عني</label>
                                    <textarea class="form-control" id="about" name="about" rows="4" required>{{ old('about', $profile->about) }}</textarea>
                                    <div class="invalid-feedback">يرجى كتابة نبذة عنك</div>
                                </div>

                                <!-- العنوان -->
                                <div class="form-group long-field">
                                    <label for="address" class="form-label">العنوان</label>
                                    <div class="input-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="text" class="form-control" id="address" name="address" 
                                               value="{{ old('address', $profile->address) }}">
                                    </div>
                                </div>

                                <!-- روابط التواصل الاجتماعي -->
                                <h5 class="section-title mt-5">
                                    <i class="fas fa-share-alt"></i> روابط التواصل الاجتماعي
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="social_links_github" class="form-label">
                                            <i class="fab fa-github me-1"></i> GitHub
                                        </label>
                                        <input type="url" class="form-control" id="social_links_github" name="social_links[github]"
                                               value="{{ old('social_links.github', $socialLinks['github'] ?? '') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="social_links_linkedin" class="form-label">
                                            <i class="fab fa-linkedin me-1"></i> LinkedIn
                                        </label>
                                        <input type="url" class="form-control" id="social_links_linkedin" name="social_links[linkedin]"
                                               value="{{ old('social_links.linkedin', $socialLinks['linkedin'] ?? '') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="social_links_twitter" class="form-label">
                                            <i class="fab fa-twitter me-1"></i> Twitter
                                        </label>
                                        <input type="url" class="form-control" id="social_links_twitter" name="social_links[twitter]"
                                               value="{{ old('social_links.twitter', $socialLinks['twitter'] ?? '') }}">
                                    </div>
                                </div>

                                <!-- روابط التواصل الإضافية -->
                                <div class="row g-3 mt-3">
                                    <div class="col-md-4">
                                        <label for="facebook" class="form-label">
                                            <i class="fab fa-facebook me-1"></i> Facebook
                                        </label>
                                        <input type="url" class="form-control" id="facebook" name="facebook"
                                               value="{{ old('facebook', $profile->facebook) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="instagram" class="form-label">
                                            <i class="fab fa-instagram me-1"></i> Instagram
                                        </label>
                                        <input type="url" class="form-control" id="instagram" name="instagram"
                                               value="{{ old('instagram', $profile->instagram) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="youtube" class="form-label">
                                            <i class="fab fa-youtube me-1"></i> YouTube
                                        </label>
                                        <input type="url" class="form-control" id="youtube" name="youtube"
                                               value="{{ old('youtube', $profile->youtube) }}">
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <div class="col-md-4">
                                        <label for="telegram" class="form-label">
                                            <i class="fab fa-telegram me-1"></i> Telegram
                                        </label>
                                        <input type="text" class="form-control" id="telegram" name="telegram"
                                               value="{{ old('telegram', $profile->telegram) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="whatsapp" class="form-label">
                                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                        </label>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                               value="{{ old('whatsapp', $profile->whatsapp) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="stackoverflow" class="form-label">
                                            <i class="fab fa-stack-overflow me-1"></i> StackOverflow
                                        </label>
                                        <input type="url" class="form-control" id="stackoverflow" name="stackoverflow"
                                               value="{{ old('stackoverflow', $profile->stackoverflow) }}">
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label for="website" class="form-label">
                                            <i class="fas fa-globe me-1"></i> الموقع الشخصي
                                        </label>
                                        <input type="url" class="form-control" id="website" name="website"
                                               value="{{ old('website', $profile->website) }}">
                                    </div>
                                </div>

                                <!-- زر الحفظ -->
                                <div class="d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn-save">
                                        <i class="fas fa-save me-1"></i> حفظ التغييرات
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// معاينة الصورة قبل الرفع
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// التحقق من صحة النموذج
(function () {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>
@endpush