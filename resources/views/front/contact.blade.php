@extends('front.layouts.app')

@section('title', __('Contact-Us '))

@push('styles')
<style>
:root {
  --primary-color: #7C3AED;
  --primary-light: #eef2ff;
  --secondary-color: #EC4899;
  --accent-color: #3B82F6;
  --dark-color: #1e293b;
  --light-color: #f8fafc;
  --gradient: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
  --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
  --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
  --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* Contact Page Base Styles */
.contact-page {
  min-height: 100vh;
  position: relative;
  overflow: hidden;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  {{--  background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);  --}}
}

/* Floating Elements */
.floating-elements {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 0;
}

.floating-element {
  position: absolute;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.1);
  filter: blur(1px);
  width: 150px;
  height: 150px;
  animation: floatAnimation 20s infinite alternate;
}

@keyframes floatAnimation {
  0% {
    transform: translate(0, 0);
    opacity: 0.3;
  }
  100% {
    transform: translate(var(--tx), var(--ty));
    opacity: 0.1;
  }
}

/* Glass Container */
.glass-container {
  width: 100%;
  max-width: 1300px;
  background: rgba(5, 97, 122, 0.7);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-radius: 32px;
  padding: 4rem;
  box-shadow: 
    0 8px 32px rgba(0, 0, 0, 0.3),
    inset 0 0 0 1px rgba(255, 255, 255, 0.08);
  position: relative;
  z-index: 1;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.05);
  margin: 4rem auto;
}

/* Header Section */
.contact-header {
  text-align: center;
  margin-bottom: 4rem;
  position: relative;
  padding-bottom: 2rem;
}

.contact-header::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 3px;
  background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
  border-radius: 3px;
}

.personal-badge {
  display: inline-flex;
  align-items: center;
  background: rgba(77, 3, 10, 0.831);
  color: #fefeff;
  padding: 0.6rem 1.5rem;
  border-radius: 50px;
  font-size: 0.95rem;
  font-weight: 600;
  letter-spacing: 0.5px;
  margin-bottom: 2rem;
  border: 1px solid rgba(124, 58, 237, 0.3);
}

.badge-icon {
  margin-right: 0.5rem;
  font-size: 1rem;
}

.contact-title {
  font-size: clamp(2.8rem, 6vw, 4rem);
  font-weight: 800;
  color: #f8fafc;
  margin-bottom: 1.5rem;
  line-height: 1.1;
}

.contact-subtitle {
  font-size: 1.2rem;
  color: #a5b4fc;
  max-width: 600px;
  margin: 0 auto;
}

/* Contact Form */
.contact-form-container {
  background: rgba(30, 41, 59, 0.6);
  border-radius: 24px;
  padding: 2.5rem;
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.contact-form-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: radial-gradient(circle at center, rgba(255,255,255,0.03) 1px, transparent 1px);
  background-size: 15px 15px;
  opacity: 0.5;
  z-index: 0;
}

.form-group {
  margin-bottom: 1.5rem;
  position: relative;
  z-index: 2;
}

.form-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: #cbd5e1;
}

.form-control {
  width: 100%;
  padding: 0.75rem 1rem;
  background: rgba(15, 23, 42, 0.4);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  color: #f8fafc;
  transition: var(--transition);
}

.form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
  outline: none;
}

textarea.form-control {
  min-height: 150px;
  resize: vertical;
}

.btn-submit {
  background: var(--gradient);
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 12px;
  font-weight: 600;
  cursor: pointer;
  transition: var(--transition);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}

.btn-submit:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(124, 58, 237, 0.3);
}

/* Alerts */
.alert {
  border-radius: 12px;
  padding: 1rem;
  margin-bottom: 1.5rem;
  position: relative;
  z-index: 2;
  border: 1px solid transparent;
}

.alert-success {
  background: rgba(16, 185, 129, 0.2);
  border-color: rgba(16, 185, 129, 0.3);
  color: #6ee7b7;
}

.alert-danger {
  background: rgba(239, 68, 68, 0.2);
  border-color: rgba(239, 68, 68, 0.3);
  color: #fca5a5;
}

/* Map Section */
.map-section {
  padding: 4rem 0;
  position: relative;
}

.map-container {
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 1024px) {
  .glass-container {
    padding: 3rem;
  }
}

@media (max-width: 768px) {
  .glass-container {
    padding: 3rem 2rem;
    border-radius: 24px;
    margin: 2rem auto;
  }
  
  .contact-header {
    margin-bottom: 3rem;
  }
}

@media (max-width: 480px) {
  .glass-container {
    padding: 2rem 1.5rem;
    border-radius: 20px;
  }
  
  .contact-title {
    font-size: 2rem;
  }
  
  .contact-subtitle {
    font-size: 1rem;
  }
}
</style>
@endpush

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
      
      <h1 class="contact-title">Contact us</h1>
      
      <p class="contact-subtitle">We are pleased to communicate with you. Our team is always available to help you and answer your inquiries.</p></p>
    </div>

    <!-- Contact Form -->
    <div class="contact-form-container">
      @if(session('success'))
        <div class="alert alert-success">
          <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
      @endif
      
      @if(session('error'))
        <div class="alert alert-success">
          <i class="fas fa-check-circle me-2 "></i> {{ session('error') }}
        </div>
      @endif
      
      <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        
        <div class="form-group">
          <label for="name" class="form-label">Full name *</label>
          <input type="text" class="form-control" id="name" name="name" required placeholder="أدخل اسمك الكامل">
        </div>
        
        <div class="form-group">
          <label for="email" class="form-label"> E-mail *</label>
          <input type="email" class="form-control" id="email" name="email" required placeholder="أدخل بريدك الإلكتروني">
        </div>
        
        <div class="form-group">
          <label for="subject" class="form-label"> Message subject *</label>
          <input type="text" class="form-control" id="subject" name="subject" required placeholder="ما هو موضوع رسالتك؟">
        </div>
        
        <div class="form-group">
          <label for="message" class="form-label"> Message text *</label>
          <textarea class="form-control" id="message" name="message" required placeholder="أدخل تفاصيل رسالتك هنا..."></textarea>
        </div>
        
        <div class="text-center mt-6">
          <button type="submit" class="btn-submit">
            <i class="fas fa-paper-plane me-2"></i>Send Message
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
          <div class="map-container ratio ratio-16x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d280.59457856290527!2d44.16398442951739!3d15.359500509464297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sar!2s!4v1751244006774!5m2!1sar!2s" 
                    width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection