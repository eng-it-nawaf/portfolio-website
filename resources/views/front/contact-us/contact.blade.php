@extends('front.layouts.app')

@section('title', __('Contact Us'))

@section('content')
<div class="contact-page">
    <!-- Floating Elements -->
    <div class="floating-elements">
        @for($i = 0; $i < 8; $i++)
        <div class="floating-element" 
             style="
               --tx: {{ rand(-100, 100) }}px;
               --ty: {{ rand(-100, 100) }}px;
               top: {{ rand(0, 100) }}%;
               left: {{ rand(0, 100) }}%;
               animation-delay: {{ $i * 2 }}s;
             ">
        </div>
        @endfor
    </div>

    <div class="glass-container">
        <!-- Header Section -->
        <div class="contact-header">
            <div class="personal-badge">
                <i class="fas fa-envelope badge-icon"></i>
                {{ __('Contact us') }}
            </div>
            
            <h1 class="contact-title">{{ __('Contact Us') }}</h1>
            
            <p class="contact-subtitle">{{ __('We are pleased to communicate with you. Our team is always available to help you and answer your inquiries.') }}</p>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-container">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Full name') }} *</label>
                    <input type="text" class="form-control" id="name" name="name" required 
                           placeholder="{{ __('Enter your full name') }}"
                           value="{{ old('name') }}">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email') }} *</label>
                    <input type="email" class="form-control" id="email" name="email" required 
                           placeholder="{{ __('Enter your email address') }}"
                           value="{{ old('email') }}">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="subject" class="form-label">{{ __('Message subject') }} *</label>
                    <input type="text" class="form-control" id="subject" name="subject" required 
                           placeholder="{{ __('What is the subject of your message?') }}"
                           value="{{ old('subject') }}">
                    @error('subject')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">{{ __('Message text') }} *</label>
                    <textarea class="form-control" id="message" name="message" required 
                              placeholder="{{ __('Enter your message details here...') }}"
                              rows="6">{{ old('message') }}</textarea>
                    @error('message')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="text-center mt-6">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-paper-plane me-2"></i>{{ __('Send Message') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    <div class="map-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d280.59457856290527!2d44.16398442951739!3d15.359500509464297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sar!2s!4v1751244006774!5m2!1sar!2s" 
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="{{ asset('front/css/contact.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const originalText = submitBtn.innerHTML;
            
            // Add loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>{{ __("Sending...") }}';
            submitBtn.disabled = true;
            
            // Form will submit normally, this is just for UX
        });
        
        // Add real-time validation
        const inputs = contactForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearFieldError(this);
            });
        });
        
        function validateField(field) {
            const value = field.value.trim();
            const errorElement = field.parentElement.querySelector('.error-message');
            
            if (field.hasAttribute('required') && !value) {
                showFieldError(field, '{{ __("This field is required") }}');
                return false;
            }
            
            if (field.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    showFieldError(field, '{{ __("Please enter a valid email address") }}');
                    return false;
                }
            }
            
            clearFieldError(field);
            return true;
        }
        
        function showFieldError(field, message) {
            let errorElement = field.parentElement.querySelector('.error-message');
            if (!errorElement) {
                errorElement = document.createElement('span');
                errorElement.className = 'error-message';
                field.parentElement.appendChild(errorElement);
            }
            errorElement.textContent = message;
            field.classList.add('error');
        }
        
        function clearFieldError(field) {
            const errorElement = field.parentElement.querySelector('.error-message');
            if (errorElement) {
                errorElement.remove();
            }
            field.classList.remove('error');
        }
    }
    
    // Add floating labels effect
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach(group => {
        const input = group.querySelector('.form-control');
        const label = group.querySelector('.form-label');
        
        if (input && label) {
            // Check if input has value on load
            if (input.value) {
                label.classList.add('active');
            }
            
            input.addEventListener('focus', function() {
                label.classList.add('active');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    label.classList.remove('active');
                }
            });
        }
    });
});
</script>
@endpush