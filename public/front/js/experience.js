
document.addEventListener('DOMContentLoaded', function() {
    // Navigation dots functionality
    const navDots = document.querySelectorAll('.nav-dot');
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    navDots.forEach(dot => {
        dot.addEventListener('click', function() {
            const year = this.getAttribute('data-year');
            
            // Update active state
            navDots.forEach(d => d.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items by year
            timelineItems.forEach(item => {
                const itemYear = item.getAttribute('data-year');
                if (year === 'all' || itemYear === year) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Hover effects
    timelineItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-10px) scale(1)';
        });
    });
    
    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    timelineItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(item);
    });
});
