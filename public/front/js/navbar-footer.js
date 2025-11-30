// Navbar & Footer Interactions
document.addEventListener('DOMContentLoaded', function() {
    // Navbar Scroll Effect
    const navbar = document.getElementById('mainNavbar');
    
    function updateNavbar() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
    
    // Initialize
    updateNavbar();
    window.addEventListener('scroll', updateNavbar);
    
    // Mobile Menu Toggle
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
            this.classList.toggle('active');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navbar.contains(event.target)) {
                navbarCollapse.classList.remove('show');
                navbarToggler.classList.remove('active');
            }
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Close mobile menu after click
                if (navbarCollapse) {
                    navbarCollapse.classList.remove('show');
                }
            }
        });
    });
    
    // Footer animations
    const footer = document.querySelector('.site-footer');
    if (footer) {
        // Create floating particles
        createFooterParticles();
        
        // Add stagger animation to footer items
        const footerItems = footer.querySelectorAll('.footer-grid > *');
        footerItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
            item.classList.add('fade-in-up');
        });
    }
    
    // Newsletter form interaction
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            // Add loading state
            const button = this.querySelector('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.style.background = 'linear-gradient(135deg, #b91024ff, #eedb0eff)';
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    this.reset();
                }, 2000);
            }, 1500);
        });
    }
    
    // Create floating particles for footer
    function createFooterParticles() {
        const particlesContainer = document.createElement('div');
        particlesContainer.className = 'footer-particles';
        document.querySelector('.site-footer').appendChild(particlesContainer);
        
        for (let i = 0; i < 15; i++) {
            const particle = document.createElement('div');
            particle.className = 'footer-particle';
            
            const size = Math.random() * 4 + 1;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const delay = Math.random() * 5;
            
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.animationDelay = `${delay}s`;
            
            particlesContainer.appendChild(particle);
        }
    }
    
    // Navbar particles
    function createNavbarParticles() {
        const particlesContainer = document.createElement('div');
        particlesContainer.className = 'navbar-particles';
        navbar.appendChild(particlesContainer);
        
        for (let i = 0; i < 8; i++) {
            const particle = document.createElement('div');
            particle.className = 'nav-particle';
            
            const size = Math.random() * 3 + 1;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const delay = Math.random() * 8;
            
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.animationDelay = `${delay}s`;
            
            particlesContainer.appendChild(particle);
        }
    }
    
    createNavbarParticles();
    
    // Active link highlighting based on scroll position
    function updateActiveNavLink() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        
        let currentSection = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.clientHeight;
            
            if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${currentSection}`) {
                link.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', updateActiveNavLink);
    
    // Loading animation
    function showLoadingBar() {
        const loadingBar = document.createElement('div');
        loadingBar.className = 'navbar-loading';
        document.body.appendChild(loadingBar);
        
        setTimeout(() => {
            loadingBar.remove();
        }, 2000);
    }
    
    // Show loading bar on page load
    showLoadingBar();
});