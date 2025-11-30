// Contact & About Page Animations
document.addEventListener('DOMContentLoaded', function() {
    // Initialize particles
    initParticles();
    
    // Scroll animations
    initScrollAnimations();
    
    // Form interactions
    initFormInteractions();
    
    // Hover effects
    initHoverEffects();
});

// Particle System
function initParticles() {
    const particles = document.querySelectorAll('.particle');
    
    particles.forEach(particle => {
        const randomX = Math.random() * 2 - 1;
        const randomY = Math.random() * 2 - 1;
        particle.style.setProperty('--i', Math.random() * 2 + 1);
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;
    });
}

// Scroll Animations
function initScrollAnimations() {
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.fade-in, .scroll-animate');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (elementPosition < screenPosition) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
                element.classList.add('animated');
            }
        });
    };
    
    // Run animation on scroll
    window.addEventListener('scroll', animateOnScroll);
    // Run once on page load
    animateOnScroll();
}

// Form Interactions
function initFormInteractions() {
    const contactForm = document.querySelector('.contact-form-container form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            
            // Add loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            // Simulate form submission
            setTimeout(() => {
                submitBtn.innerHTML = '<i class="fas fa-check"></i> Message Sent!';
                submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    this.reset();
                }, 2000);
            }, 2000);
        });
        
        // Add focus effects to form inputs
        const formInputs = contactForm.querySelectorAll('.form-control');
        
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    }
}

// Hover Effects
function initHoverEffects() {
    // Contact cards hover effects
    const contactCards = document.querySelectorAll('.contact-card');
    
    contactCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-10px) scale(1)';
        });
    });
    
    // Timeline items hover effects
    const timelineItems = document.querySelectorAll('.timeline-content');
    
    timelineItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
}

// Parallax Effect for Background Elements
function initParallax() {
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.bg-elements, .floating-elements');
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

// Initialize when page loads
window.addEventListener('load', function() {
    initParallax();
    
    // Add loading animation
    const loadingBar = document.createElement('div');
    loadingBar.className = 'page-loading-bar';
    loadingBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899);
        transform: scaleX(0);
        transform-origin: left;
        animation: loadingBar 2s ease-in-out;
        z-index: 9999;
    `;
    
    document.body.appendChild(loadingBar);
    
    setTimeout(() => {
        loadingBar.remove();
    }, 2000);
});

// Custom cursor effect (optional)
function initCustomCursor() {
    if (window.innerWidth > 768) {
        const cursor = document.createElement('div');
        cursor.className = 'custom-cursor';
        cursor.style.cssText = `
            position: fixed;
            width: 20px;
            height: 20px;
            border: 2px solid #6366f1;
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s ease;
            mix-blend-mode: difference;
        `;
        
        document.body.appendChild(cursor);
        
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });
        
        document.addEventListener('mousedown', () => {
            cursor.style.transform = 'scale(0.8)';
        });
        
        document.addEventListener('mouseup', () => {
            cursor.style.transform = 'scale(1)';
        });
    }
}
