document.addEventListener('DOMContentLoaded', function () {
    var cfg = window.GALERI_LIKE;
    if (!cfg) return;

    var items = document.querySelectorAll('[data-galeri-id]');
    var modalBtn = document.getElementById('galeriModalLike');
    var state = {};
    var currentId = null;

    function get(id) {
        if (!state[id]) state[id] = { liked: false, count: 0 };
        return state[id];
    }

    function paint(btn, s) {
        btn.classList.toggle('is-liked', s.liked);
        btn.querySelector('.galeri-like-count').textContent = s.count;
    }

    function refresh(id) {
        var s = get(id);
        var cardBtn = document.querySelector('[data-galeri-id="' + id + '"] .galeri-like-btn');
        if (cardBtn) paint(cardBtn, s);
        if (modalBtn && String(currentId) === String(id)) paint(modalBtn, s);
    }

    function toggle(id, btn) {
        if (!id || btn.disabled) return;
        btn.disabled = true;

        fetch(cfg.toggleUrl + id + '/like', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': cfg.csrf, 'Accept': 'application/json' },
            credentials: 'same-origin'
        })
            .then(function (r) { return r.json(); })
            .then(function (d) {
                state[id] = { liked: d.liked, count: d.count };
                refresh(id);
            })
            .catch(function () {})
            .finally(function () { btn.disabled = false; });
    }

    // Tombol like di grid galeri
    items.forEach(function (item) {
        var btn = item.querySelector('.galeri-like-btn');
        if (!btn) return;

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (e.detail > 1) return; // abaikan klik kedua pada klik ganda
            toggle(item.dataset.galeriId, btn);
        });
    });

    // Tombol like di popup foto besar
    if (modalBtn) {
        modalBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (e.detail > 1) return; // abaikan klik kedua pada klik ganda
            toggle(currentId, modalBtn);
        });
    }

    window.galeriLikeOpen = function (id) {
        currentId = id;
        refresh(id);
    };

    fetch(cfg.listUrl, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            var liked = (data.liked || []).map(String);
            var counts = data.counts || {};

            items.forEach(function (item) {
                var id = item.dataset.galeriId;
                state[id] = {
                    liked: liked.indexOf(String(id)) !== -1,
                    count: counts[id] || 0
                };
                refresh(id);
            });
        })
        .catch(function () {});
});