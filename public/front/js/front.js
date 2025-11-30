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



// JavaScript for Skills Galaxy
document.addEventListener('DOMContentLoaded', function() {
    const planets = document.querySelectorAll('.planet');
    const planetCard = document.getElementById('planetCard');
    const cardSkillTitle = document.getElementById('cardSkillTitle');
    const cardSkillType = document.getElementById('cardSkillType');
    const cardStats = document.getElementById('cardStats');
    const planetFeatures = document.getElementById('planetFeatures');
    const cardIcon = document.getElementById('cardIcon');

    // بيانات المهارات
    const skillsData = {
        frontend: {
            title: "Frontend Development",
            type: "Web Technology",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                  </svg>`,
            stats: [
                { label: "Experience", value: "4+ Years" },
                { label: "Proficiency", value: "Advanced" },
                { label: "Projects", value: "50+" }
            ],
            features: ["React", "Vue.js", "Angular", "TypeScript", "SASS"]
        },
        backend: {
            title: "Backend Development",
            type: "Server Technology",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/>
                  </svg>`,
            stats: [
                { label: "Experience", value: "3+ Years" },
                { label: "Proficiency", value: "Advanced" },
                { label: "Projects", value: "30+" }
            ],
            features: ["Node.js", "Python", "PHP", "Laravel", "Express"]
        },
        database: {
            title: "Database Management",
            type: "Data Technology",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                  </svg>`,
            stats: [
                { label: "Experience", value: "3+ Years" },
                { label: "Proficiency", value: "Intermediate" },
                { label: "Projects", value: "25+" }
            ],
            features: ["MySQL", "MongoDB", "PostgreSQL", "Redis", "Firebase"]
        },
        mobile: {
            title: "Mobile Development",
            type: "App Technology",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                    <path d="M12 18h.01"/>
                  </svg>`,
            stats: [
                { label: "Experience", value: "2+ Years" },
                { label: "Proficiency", value: "Intermediate" },
                { label: "Projects", value: "15+" }
            ],
            features: ["React Native", "Flutter", "iOS", "Android", "PWA"]
        },
        devops: {
            title: "DevOps & Cloud",
            type: "Infrastructure",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/>
                    <path d="M12 8v8"/>
                  </svg>`,
            stats: [
                { label: "Experience", value: "2+ Years" },
                { label: "Proficiency", value: "Intermediate" },
                { label: "Projects", value: "20+" }
            ],
            features: ["Docker", "AWS", "CI/CD", "Linux", "Nginx"]
        },
        design: {
            title: "UI/UX Design",
            type: "Creative Technology",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>`,
            stats: [
                { label: "Experience", value: "3+ Years" },
                { label: "Proficiency", value: "Advanced" },
                { label: "Projects", value: "40+" }
            ],
            features: ["Figma", "Adobe XD", "Prototyping", "Wireframing", "Design Systems"]
        }
    };

    // إضافة event listeners للكواكب
    planets.forEach(planet => {
        planet.addEventListener('mouseenter', function() {
            const skillType = this.getAttribute('data-skill');
            showPlanetCard(skillType, this);
        });

        planet.addEventListener('mouseleave', function() {
            hidePlanetCard();
        });

        planet.addEventListener('click', function() {
            const skillType = this.getAttribute('data-skill');
            showPlanetCard(skillType, this);
        });
    });

    // إظهار بطاقة الكوكب
    function showPlanetCard(skillType, planetElement) {
        const skillData = skillsData[skillType];
        if (!skillData) return;

        // تحديث المحتوى
        cardSkillTitle.textContent = skillData.title;
        cardSkillType.textContent = skillData.type;
        cardIcon.innerHTML = skillData.icon;

        // تحديث الإحصائيات
        cardStats.innerHTML = '';
        skillData.stats.forEach(stat => {
            const statElement = document.createElement('div');
            statElement.className = 'stat';
            statElement.innerHTML = `
                <span class="statLabel">${stat.label}</span>
                <span class="statValue">${stat.value}</span>
            `;
            cardStats.appendChild(statElement);
        });

        // تحديث الميزات
        planetFeatures.innerHTML = '';
        skillData.features.forEach(feature => {
            const featureElement = document.createElement('span');
            featureElement.textContent = feature;
            planetFeatures.appendChild(featureElement);
        });

        // إظهار البطاقة
        planetCard.style.display = 'block';

        // إضافة تأثير highlight للكوكب
        planets.forEach(p => p.classList.remove('highlighted'));
        planetElement.classList.add('highlighted');
    }

    // إخفاء بطاقة الكوكب
    function hidePlanetCard() {
        planetCard.style.display = 'none';
        planets.forEach(p => p.classList.remove('highlighted'));
    }

    // إغلاق البطاقة عند النقر خارجها
    document.addEventListener('click', function(event) {
        if (!planetCard.contains(event.target) && !event.target.closest('.planet')) {
            hidePlanetCard();
        }
    });

    // تأثير مؤشر الماوس
    const cursorEffect = document.getElementById('cursorEffect');
    document.addEventListener('mousemove', function(e) {
        cursorEffect.style.left = e.clientX + 'px';
        cursorEffect.style.top = e.clientY + 'px';
    });
});

