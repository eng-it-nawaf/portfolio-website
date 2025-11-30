// Enhanced Projects Interactions
document.addEventListener('DOMContentLoaded', function() {
    initProjectGallery();
    initFilterSystem();
    initModalSystem();
    initScrollAnimations();
});

// Project Gallery with Enhanced Features
function initProjectGallery() {
    const projects = document.querySelectorAll('.card');
    
    projects.forEach(project => {
        const images = project.querySelectorAll('.image');
        const dots = project.querySelectorAll('.navDot');
        let currentIndex = 0;
        let interval;
        
        if (images.length > 1) {
            startAutoRotation();
            
            const imageContainer = project.querySelector('.imageContainer');
            
            imageContainer.addEventListener('mouseenter', () => {
                clearInterval(interval);
            });
            
            imageContainer.addEventListener('mouseleave', startAutoRotation);
            
            dots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    goToSlide(index);
                    resetInterval();
                });
            });
        }
        
        function startAutoRotation() {
            interval = setInterval(() => {
                nextSlide();
            }, 5000);
        }
        
        function nextSlide() {
            let newIndex = (currentIndex + 1) % images.length;
            goToSlide(newIndex);
        }
        
        function goToSlide(index) {
            images[currentIndex].classList.remove('active');
            images[currentIndex].style.opacity = '0';
            dots[currentIndex].classList.remove('active');
            
            currentIndex = index;
            
            setTimeout(() => {
                images[currentIndex].classList.add('active');
                images[currentIndex].style.opacity = '1';
                dots[currentIndex].classList.add('active');
            }, 300);
        }
        
        function resetInterval() {
            clearInterval(interval);
            startAutoRotation();
        }
    });
}

// Enhanced Filter System
function initFilterSystem() {
    const filterToggle = document.getElementById('filterToggle');
    const filterDropdown = document.getElementById('filterDropdown');
    const filterText = document.getElementById('filterText');
    const filterItems = document.querySelectorAll('.dropdownItem');
    const projectItems = document.querySelectorAll('.card');
    const resetFilters = document.getElementById('resetFilters');
    
    if (!filterToggle) return;
    
    filterToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        filterDropdown.style.display = filterDropdown.style.display === 'none' ? 'block' : 'none';
    });
    
    filterItems.forEach(item => {
        item.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');
            
            filterText.textContent = this.textContent;
            
            filterItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            filterProjects(filterValue);
            filterDropdown.style.display = 'none';
        });
    });
    
    function filterProjects(filterValue) {
        projectItems.forEach(project => {
            const category = project.getAttribute('data-category');
            
            if (filterValue === 'all' || category === filterValue) {
                project.style.display = 'block';
                setTimeout(() => {
                    project.style.opacity = '1';
                    project.style.transform = 'translateY(0)';
                }, 100);
            } else {
                project.style.opacity = '0';
                project.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    project.style.display = 'none';
                }, 300);
            }
        });
        
        const visibleProjects = document.querySelectorAll('.card[style*="display: block"]');
        const noResults = document.querySelector('.noResults');
        
        if (visibleProjects.length === 0) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }
    
    if (resetFilters) {
        resetFilters.addEventListener('click', function() {
            filterText.textContent = 'All Projects';
            filterItems.forEach(i => i.classList.remove('active'));
            filterItems[0].classList.add('active');
            
            projectItems.forEach(project => {
                project.style.display = 'block';
                setTimeout(() => {
                    project.style.opacity = '1';
                    project.style.transform = 'translateY(0)';
                }, 100);
            });
            
            document.querySelector('.noResults').style.display = 'none';
        });
    }
    
    document.addEventListener('click', function() {
        filterDropdown.style.display = 'none';
    });
}

// Enhanced Modal System
function initModalSystem() {
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');
    const modalPrev = document.getElementById('modalPrev');
    const modalNext = document.getElementById('modalNext');
    const modalNavDots = document.getElementById('modalNavDots');
    
    let currentModalProject = null;
    let currentModalIndex = 0;
    let modalImages = [];
    
    document.querySelectorAll('.image').forEach(img => {
        img.addEventListener('click', function() {
            const project = this.closest('.card');
            currentModalProject = project;
            modalImages = Array.from(project.querySelectorAll('.image'));
            currentModalIndex = parseInt(this.getAttribute('data-index'));
            
            openModal(this.src, this.alt);
        });
    });
    
    function openModal(src, alt) {
        modalImage.src = src;
        modalImage.alt = alt;
        
        createModalNavigation();
        
        imageModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function createModalNavigation() {
        modalNavDots.innerHTML = '';
        modalImages.forEach((img, index) => {
            const dot = document.createElement('button');
            dot.className = `modalNavDot ${index === currentModalIndex ? 'active' : ''}`;
            dot.setAttribute('data-index', index);
            dot.addEventListener('click', () => {
                goToModalImage(index);
            });
            modalNavDots.appendChild(dot);
        });
    }
    
    function closeModalFunc() {
        imageModal.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    function goToModalImage(index) {
        currentModalIndex = index;
        modalImage.style.opacity = '0';
        
        setTimeout(() => {
            modalImage.src = modalImages[index].src;
            modalImage.alt = modalImages[index].alt;
            modalImage.style.opacity = '1';
            
            updateModalNavigation();
        }, 300);
    }
    
    function updateModalNavigation() {
        document.querySelectorAll('.modalNavDot').forEach((dot, i) => {
            dot.classList.toggle('active', i === currentModalIndex);
        });
    }
    
    function nextModalImage() {
        const newIndex = (currentModalIndex + 1) % modalImages.length;
        goToModalImage(newIndex);
    }
    
    function prevModalImage() {
        const newIndex = (currentModalIndex - 1 + modalImages.length) % modalImages.length;
        goToModalImage(newIndex);
    }
    
    closeModal.addEventListener('click', closeModalFunc);
    modalPrev.addEventListener('click', prevModalImage);
    modalNext.addEventListener('click', nextModalImage);
    
    document.addEventListener('keydown', function(e) {
        if (imageModal.classList.contains('show')) {
            if (e.key === 'Escape') {
                closeModalFunc();
            } else if (e.key === 'ArrowRight') {
                nextModalImage();
            } else if (e.key === 'ArrowLeft') {
                prevModalImage();
            }
        }
    });
    
    imageModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModalFunc();
        }
    });
}

// Scroll Animations
function initScrollAnimations() {
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
    
    document.querySelectorAll('.card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
}

// Add floating elements
function createFloatingElements() {
    const container = document.querySelector('.projects-gallery-page');
    const floatingContainer = document.createElement('div');
    floatingContainer.className = 'floating-elements';
    
    for (let i = 0; i < 8; i++) {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.style.cssText = `
            width: ${Math.random() * 200 + 50}px;
            height: ${Math.random() * 200 + 50}px;
            top: ${Math.random() * 100}%;
            left: ${Math.random() * 100}%;
            animation-delay: ${i * 2}s;
        `;
        floatingContainer.appendChild(element);
    }
    
    container.appendChild(floatingContainer);
}

// Initialize floating elements
createFloatingElements();