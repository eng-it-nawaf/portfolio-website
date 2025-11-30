<!-- Professional Contact Section Design -->
<section id="contact" class="contact-section">
  <!-- Animated Background Elements -->
  <div class="bg-elements">
    <div class="gradient-bg"></div>
    <div class="particles">
      <div class="particle" style="--i:1"></div>
      <div class="particle" style="--i:2"></div>
      <div class="particle" style="--i:3"></div>
      <div class="particle" style="--i:4"></div>
      <div class="particle" style="--i:5"></div>
    </div>
  </div>

  <!-- Main Container -->
  <div class="container">
    <!-- Section Header -->
    <div class="section-header">
      <span class="section-label">
        <i class="fas fa-paper-plane"></i>
        Let's Connect
      </span>
      <h2 class="section-title">Get In Touch</h2>
      <p class="section-subtitle">Have a project in mind or want to discuss opportunities?</p>
    </div>

    <!-- Contact Cards Grid -->
    <div class="contact-grid">
      <!-- Email Card -->
      <div class="contact-card email-card">
        <div class="card-icon">
          <i class="fas fa-envelope"></i>
        </div>
        <h3>Email Me</h3>
        <p>For professional inquiries</p>
        <a href="{{ $profile->email }}" class="card-link">
          {{ $profile->email }}
          <i class="fas fa-arrow-right"></i>
        </a>
        <div class="card-hover-effect"></div>
      </div>

      <!-- Phone Card -->
      <div class="contact-card phone-card">
        <div class="card-icon">
          <i class="fas fa-phone-alt"></i>
        </div>
        <h3>Call Me</h3>
        <p>Available Mon-Fri, 9AM-5PM</p>
        <a href="tel:+1234567890" class="card-link">
           {{ $profile->phone ?? __('Not specified') }}
          <i class="fas fa-arrow-right"></i>
        </a>
        <div class="card-hover-effect"></div>
      </div>

      <!-- Location Card -->
      <div class="contact-card location-card">
        <div class="card-icon">
          <i class="fas fa-map-marker-alt"></i>
        </div>
        <h3>My Location</h3>
        <p>{{ $profile->address ?? __('Not specified') }}</p>
        <div class="card-link">
          View On Map
          <i class="fas fa-arrow-right"></i>
        </div>
        <div class="card-hover-effect"></div>
      </div>
    </div>

    <!-- Contact Form CTA -->
    <div class="contact-cta">
      <div class="cta-content">
        <h3>Ready to Start Your Project?</h3>
        <p>Send me a message and I'll get back to you within 24 hours</p>
        <a href="contact" class="cta-button">
          Send Message
          <i class="fas fa-paper-plane"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<link href="{{ asset('front/css/contact.css') }}" rel="stylesheet">


{{--  <script>
// Initialize particles with random positions
document.querySelectorAll('.particle').forEach(particle => {
  const randomX = Math.random() * 2 - 1;
  const randomY = Math.random() * 2 - 1;
  particle.style.setProperty('--i', Math.random() * 2 + 1);
  particle.style.left = `${Math.random() * 100}%`;
  particle.style.top = `${Math.random() * 100}%`;
});
</script>  --}}