<footer class="site-footer">
    {{--  <div class="footer-wave">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
        </svg>
    </div>  --}}
    
    <div class="footer-content">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="footer-logo">
                        {{ config('app.name') }}
                    </a>
                    <p class="footer-description">
                        {{ __('Professional developer creating innovative digital solutions with modern technologies') }}
                    </p>
                    <div class="footer-newsletter">
                        <h5>{{ __('Stay Updated') }}</h5>
                        <form class="newsletter-form">
                            <input type="email" placeholder="{{ __('Your Email') }}" required>
                            <button type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="footer-links">
                    <h5 class="footer-title">{{ __('Quick Links') }}</h5>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li><a href="{{ route('about') }}">{{ __('About Me') }}</a></li>
                        <li><a href="{{ route('projects') }}">{{ __('My Projects') }}</a></li>
                        <li><a href="{{ route('home') }}#contact">{{ __('Contact Me') }}</a></li>
                        <li><a href="#">{{ __('Blog') }}</a></li>
                    </ul>
                </div>
                
@if(isset($services) && $services->count())
<div class="footer-services">
    <h5 class="footer-title">{{ __('Services') }}</h5>
    <ul>
        @foreach($services as $service)
            <li><a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></li>
        @endforeach
    </ul>
</div>
@endif

                <div class="footer-contact">
                    <h5 class="footer-title">{{ __('Get In Touch') }}</h5>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $profile->address ?? __('Not specified') }}</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <a href="{{ $profile->phone ?? __('Not specified') }}">{{ $profile->phone ?? __('Not specified') }}

                            </a>
                        </li>
                    </ul>
                    
<div class="footer-social">
    <!-- روابط التواصل الأساسية -->
    @if(isset($profile->social_links['facebook']) || $profile->facebook)
        <a href="{{ $profile->facebook ?? $profile->social_links['facebook'] ?? '#' }}" target="_blank" class="social-icon" title="Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
    @endif
    
    @if(isset($profile->social_links['twitter']))
        <a href="{{ $profile->social_links['twitter'] }}" target="_blank" class="social-icon" title="Twitter">
            <i class="fab fa-twitter"></i>
        </a>
    @endif
    
    @if(isset($profile->social_links['linkedin']))
        <a href="{{ $profile->social_links['linkedin'] }}" target="_blank" class="social-icon" title="LinkedIn">
            <i class="fab fa-linkedin-in"></i>
        </a>
    @endif
    
    @if(isset($profile->social_links['github']))
        <a href="{{ $profile->social_links['github'] }}" target="_blank" class="social-icon" title="GitHub">
            <i class="fab fa-github"></i>
        </a>
    @endif
    
    <!-- الروابط الجديدة -->
    @if($profile->instagram)
        <a href="{{ $profile->instagram }}" target="_blank" class="social-icon" title="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
    @endif
    
    @if($profile->youtube)
        <a href="{{ $profile->youtube }}" target="_blank" class="social-icon" title="YouTube">
            <i class="fab fa-youtube"></i>
        </a>
    @endif
    
    @if($profile->telegram)
        <a href="https://t.me/{{ ltrim($profile->telegram, '@') }}" target="_blank" class="social-icon" title="Telegram">
            <i class="fab fa-telegram-plane"></i>
        </a>
    @endif
    
    @if($profile->whatsapp)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->whatsapp) }}" target="_blank" class="social-icon" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    @endif
    
    @if($profile->stackoverflow)
        <a href="{{ $profile->stackoverflow }}" target="_blank" class="social-icon" title="StackOverflow">
            <i class="fab fa-stack-overflow"></i>
        </a>
    @endif
    
    @if($profile->website)
        <a href="{{ $profile->website }}" target="_blank" class="social-icon" title="Website">
            <i class="fas fa-globe"></i>
        </a>
    @endif
</div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="footer-copyright">
                <p>&copy; {{ date('Y') }} {{ __('Eng.IT.Nawaf') }}. {{ __('All rights reserved.') }}</p>
            </div>
            <div class="footer-legal">
                <a href="#">{{ __('Privacy Policy') }}</a>
                <a href="#">{{ __('Terms of Service') }}</a>
                <a href="#">{{ __('Sitemap') }}</a>
            </div>
        </div>
    </div>
</footer>

<link href="{{ asset('front/css/footer.css') }}" rel="stylesheet">
    <script src="{{ asset('front/js/navbar-footer.js') }}"></script>

