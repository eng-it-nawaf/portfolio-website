// admin.js - المكونات التفاعلية للوحة التحكم
document.addEventListener('DOMContentLoaded', function() {
    // تبديل القائمة الجانبية
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.admin-sidebar');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
    
    // إغلاق القائمة عند النقر خارجها (للشاشات الصغيرة)
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        }
    });
    
    // تهيئة Sortable.js للجداول القابلة للسحب
    const sortableTables = document.querySelectorAll('.sortable-table');
    sortableTables.forEach(table => {
        const tbody = table.querySelector('tbody.sortable');
        if (tbody) {
            new Sortable(tbody, {
                handle: '.sortable-handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function(evt) {
                    const order = Array.from(tbody.querySelectorAll('tr')).map(row => row.dataset.id);
                    const category = tbody.dataset.category;
                    const url = table.dataset.sortUrl;
                    
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ order, category })
                    }).then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              console.log('تم تحديث الترتيب بنجاح');
                          }
                      });
                }
            });
        }
    });
    
    // تهيئة أدوات التلميح
    const tooltipElements = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipElements.forEach(element => {
        new bootstrap.Tooltip(element);
    });
    
    // التحقق من صحة النماذج
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});