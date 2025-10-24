// // تهيئة القوائم
// document.addEventListener('DOMContentLoaded', function() {
//     // إغلاق رسائل التنبيه تلقائياً بعد 5 ثواني
//     setTimeout(() => {
//         const alerts = document.querySelectorAll('.alert');
//         alerts.forEach(alert => {
//             const bsAlert = new bootstrap.Alert(alert);
//             bsAlert.close();
//         });
//     }, 5000);
    
//     // تهيئة الرسوم البيانية
//     if (typeof ApexCharts !== 'undefined') {
//         // يمكنك إضافة تهيئة الرسوم البيانية هنا
//     }
    
//     // تهيئة عناصر واجهة المستخدم
//     const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
//     tooltipTriggerList.map(function (tooltipTriggerEl) {
//         return new bootstrap.Tooltip(tooltipTriggerEl);
//     });
// });