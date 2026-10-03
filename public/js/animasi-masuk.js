(function () {
    var root = document.documentElement;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    root.classList.add('anim-prep');

    function tandai(selector, mulai, jeda, maks) {
        document.querySelectorAll(selector).forEach(function (el, n) {
            el.classList.add('anim-item');
            el.style.setProperty('--delay', (mulai + Math.min(n, maks) * jeda) + 'ms');
        });
    }

    function jalankan() {
        tandai('.admin-content .admin-section-title, .admin-form-title, .admin-form-desc', 0, 60, 3);
        tandai('.admin-content .admin-toolbar, .admin-content .admin-tabs', 100, 60, 2);
        tandai('.admin-content .admin-table-wrap', 180, 0, 0);
        tandai('.admin-content .admin-table tbody tr', 280, 55, 10);
        tandai('.admin-content .admin-form-col-upload, .admin-content .admin-form-col-fields .admin-field, .admin-content .admin-form-buttons', 100, 70, 8);

        requestAnimationFrame(function () {
            root.classList.add('anim-start');
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', jalankan);
    } else {
        jalankan();
    }
})();