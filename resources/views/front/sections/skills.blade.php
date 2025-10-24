<!-- ملف: resources/views/front/sections/skills.blade.php -->
<section class="skillsSection">
  <div class="container">
    <!-- Header Section -->
    <div class="header">
      <h2 class="title">
        {{ __('My Technical Skills') }}
        <span class="titleUnderline"></span>
      </h2>
      <p class="subtitle">
        {{ __('Technologies I\'ve mastered through years of experience and continuous learning') }}
      </p>
    </div>

    <!-- Filter Dropdown -->
    <div class="filterDropdownContainer">
      <button class="dropdownButton" id="filterDropdownButton">
        <span class="buttonContent">
          <i class="filterIcon fas fa-filter"></i>
          <span id="selectedCategory">All Categories</span>
          <i class="chevronIcon fas fa-chevron-down"></i>
        </span>
      </button>
      
      <ul class="dropdownMenu" id="categoryDropdown" style="display: none;">
        <li class="dropdownItem">
          <button class="categoryButton activeCategory" data-category="all">
            <span class="activeIndicator"></span>
            All Categories
          </button>
        </li>
        @foreach($skills->groupBy('category') as $category => $categorySkills)
        <li class="dropdownItem">
          <button class="categoryButton" data-category="{{ Str::slug($category) }}">
            {{ $category }}
          </button>
        </li>
        @endforeach
      </ul>
    </div>

    <!-- Skills Grid -->
    <div class="skillsGrid">
      @foreach($skills->groupBy('category') as $category => $categorySkills)
      <div class="categoryCard" data-category="{{ Str::slug($category) }}">
        <h3 class="categoryTitle">{{ $category }}</h3>
        <div class="skillsContainer">
          @foreach($categorySkills as $skill)
          <div class="skillCard">
            <div class="skillIconContainer">
              <div class="iconBackground"></div>
              <i class="{{ $skill->icon }}"></i>
            </div>
            <span class="skillName">{{ $skill->name }}</span>
            <div class="progressContainer">
              <div class="progressBar">
                <div class="progressFill" style="width: {{ $skill->percentage }}%"></div>
              </div>
              <div class="progressText">{{ $skill->percentage }}%</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

    <link href="{{ asset('front/css/skills.css') }}" rel="stylesheet">


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Dropdown functionality
  const dropdownButton = document.getElementById('filterDropdownButton');
  const dropdownMenu = document.getElementById('categoryDropdown');
  const categoryButtons = document.querySelectorAll('.categoryButton');
  const selectedCategory = document.getElementById('selectedCategory');
  const chevronIcon = document.querySelector('.chevronIcon');
  
  // Toggle dropdown
  dropdownButton.addEventListener('click', function() {
    const isOpen = dropdownMenu.style.display === 'block';
    dropdownMenu.style.display = isOpen ? 'none' : 'block';
    chevronIcon.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
  });
  
  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.style.display = 'none';
      chevronIcon.style.transform = 'rotate(0deg)';
    }
  });
  
  // Category filtering
  categoryButtons.forEach(button => {
    button.addEventListener('click', function() {
      const category = this.dataset.category;
      
      // Update selected category
      selectedCategory.textContent = this.textContent.trim();
      
      // Update active button
      categoryButtons.forEach(btn => {
        btn.classList.remove('activeCategory');
        btn.querySelector('.activeIndicator')?.remove();
      });
      
      this.classList.add('activeCategory');
      
      if (category !== 'all') {
        const indicator = document.createElement('span');
        indicator.className = 'activeIndicator';
        this.prepend(indicator);
      }
      
      // Filter skills
      document.querySelectorAll('.categoryCard').forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
      
      // Close dropdown
      dropdownMenu.style.display = 'none';
      chevronIcon.style.transform = 'rotate(0deg)';
    });
  });
  
  // Animate progress bars on scroll
  const animateProgressBars = () => {
    const progressBars = document.querySelectorAll('.progressFill');
    progressBars.forEach(bar => {
      const targetWidth = bar.style.width;
      bar.style.width = '0';
      
      setTimeout(() => {
        bar.style.transition = 'width 1.5s ease-out';
        bar.style.width = targetWidth;
      }, 100);
    });
  };
  
  // Intersection Observer for scroll animation
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateProgressBars();
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });
  
  observer.observe(document.querySelector('.skillsSection'));
});
</script>
@endpush