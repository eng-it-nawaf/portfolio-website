// تأثير حركة المؤشر
document.addEventListener('mousemove', (e) => {
    const cursor = document.querySelector('.cursor-effect');
    if (cursor) {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
    }

    const light = document.querySelector('.moving-light');
    if (light) {
        light.style.transform = `translate(${e.clientX / 20}px, ${e.clientY / 20}px)`;
    }
});

// جسيمات الخلفية
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.particles-container');
    if (container) {
        const particleCount = 20;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // مواضع عشوائية
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            
            // حركة الجسيمات
            particle.animate([
                { opacity: 0, transform: 'translate(0, 0)' },
                { opacity: 0.6, transform: `translate(${Math.random() * 200 - 100}px, ${Math.random() * 200 - 100}px)` },
                { opacity: 0, transform: `translate(${Math.random() * 200 - 100}px, ${Math.random() * 200 - 100}px)` }
            ], {
                duration: 15000 + Math.random() * 20000,
                iterations: Infinity,
                delay: Math.random() * 5000
            });
            
            container.appendChild(particle);
        }
    }

    // حركة العناصر العائمة
    const floatingElements = document.querySelectorAll('.floating-element');
    floatingElements.forEach((el, index) => {
        const duration = 20000 + Math.random() * 20000;
        const delay = index * 1000;
        
        el.animate([
            { 
                opacity: 0,
                transform: `translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px)`
            },
            { 
                opacity: 0.3,
                transform: `translate(${Math.random() * 200 - 100}px, ${Math.random() * 200 - 100}px)`
            }
        ], {
            duration: duration,
            iterations: Infinity,
            direction: 'alternate',
            delay: delay
        });
    });

    // تأثيرات عند التمرير
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.id === 'profile-image-wrapper') {
                    entry.target.animate([
                        { transform: 'scale(0.9)', opacity: 0 },
                        { transform: 'scale(1)', opacity: 1 }
                    ], {
                        duration: 1000,
                        easing: 'cubic-bezier(0.175, 0.885, 0.32, 1.275)'
                    });
                }
                
                if (entry.target.classList.contains('service-card')) {
                    const index = Array.from(document.querySelectorAll('.service-card')).indexOf(entry.target);
                    entry.target.animate([
                        { opacity: 0, transform: 'translateY(10px)' },
                        { opacity: 1, transform: 'translateY(0)' }
                    ], {
                        duration: 600,
                        delay: index * 100,
                        easing: 'ease-out'
                    });
                }
            }
        });
    }, { threshold: 0.1 });

    // مراقبة العناصر
    document.querySelectorAll('#profile-image-wrapper, .service-card').forEach(el => {
        observer.observe(el);
    });
});

// public/js/front.js
document.addEventListener('DOMContentLoaded', function() {
    // إضافة تأثير الانتقال عند تحميل الصفحة
    document.body.classList.add('page-transition');
    
    // منع التحميل المفاجئ للصفحات
    document.querySelectorAll('a').forEach(link => {
        if (link.href && !link.href.startsWith('javascript') && 
            !link.href.startsWith('mailto') && 
            !link.href.startsWith('tel') &&
            link.hostname === window.location.hostname) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.body.classList.remove('page-transition');
                
                setTimeout(() => {
                    window.location.href = link.href;
                }, 300);
            });
        }
    });
    
    // تحسين الانتقال بين أقسام الصفحة الواحدة
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    const navbarHeight = navbar.offsetHeight;
    
    // تعويض مساحة body ديناميكياً
    document.body.style.paddingTop = navbarHeight + 'px';
    
    function updateNavbar() {
        if (window.scrollY > navbarHeight) {
            navbar.classList.add('scrolled');
            navbar.style.backdropFilter = 'blur(15px)';
        } else {
            navbar.classList.remove('scrolled');
            navbar.style.backdropFilter = 'blur(10px)';
        }
    }
    
    // التهيئة الأولية
    updateNavbar();
    
    // تحسين الأداء باستخدام requestAnimationFrame
    let lastScrollY = window.scrollY;
    function onScroll() {
        if (Math.abs(lastScrollY - window.scrollY) > 5) {
            lastScrollY = window.scrollY;
            updateNavbar();
        }
        requestAnimationFrame(onScroll);
    }
    requestAnimationFrame(onScroll);
});