document.addEventListener('DOMContentLoaded', function () {
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var targets = [
    '.btn', '.btn-login', '.btn-outline-small', '.btn-pill-jurusan',
    '.berita-card', '.jurusan-item', '.stat-card', '.visi-misi-box',
    '.informasi-card', 'a.kategori-badge', '.link-kembali', '.galeri-item',
    '.link-detail', '.kontak-item', '.kontak-pesan-submit'
  ].join(', ');

  document.querySelectorAll(targets).forEach(function (el) {
    if (el.dataset.animasiKlik) return;
    el.dataset.animasiKlik = '1';

    var cs = window.getComputedStyle(el);
    if (cs.position === 'static') el.style.position = 'relative';
    if (cs.overflow === 'visible') el.style.overflow = 'hidden';

    el.addEventListener('click', function (e) {
      if (e.target.closest('.galeri-like-btn')) return;

      var rect = this.getBoundingClientRect();
      var size = Math.max(rect.width, rect.height);
      var r = document.createElement('span');
      r.className = 'ripple';
      r.style.width = r.style.height = size + 'px';
      r.style.left = (e.clientX - rect.left - size / 2) + 'px';
      r.style.top = (e.clientY - rect.top - size / 2) + 'px';
      this.appendChild(r);
      setTimeout(function () { r.remove(); }, 600);

      if (this.matches('.stat-card, .visi-misi-box')) {
        this.classList.remove('pop');
        void this.offsetWidth;
        this.classList.add('pop');
      }

      var link = this.matches('a[href]') ? this : this.closest('a[href]');
      if (!link) return;

      var href = link.getAttribute('href');
      if (
        href && href.charAt(0) !== '#' &&
        link.target !== '_blank' &&
        !e.ctrlKey && !e.metaKey && !e.shiftKey && !e.altKey
      ) {
        e.preventDefault();
        setTimeout(function () { window.location.href = link.href; }, 250);
      }
    });
  });

  var mapFrame = document.querySelector('.kontak-map iframe[data-src]');
  if (mapFrame) {
    var loadMap = function () {
      if (!mapFrame.dataset.src) return;
      mapFrame.src = mapFrame.dataset.src;
      delete mapFrame.dataset.src;
    };
    if (reduce) {
      loadMap();
    } else {
      mapFrame.parentNode.addEventListener('animationend', loadMap, { once: true });
      setTimeout(loadMap, 2800);
    }
  }

  var form = document.querySelector('.kontak-pesan-form');
  if (!form) return;

  var card = form.closest('.kontak-pesan-card');
  var submit = form.querySelector('.kontak-pesan-submit');
  var label = submit.firstChild;
  var labelText = label.textContent;

  var errors = form.querySelectorAll('.kontak-pesan-error');
  var success = card.querySelector('.kontak-pesan-success');

  if (errors.length || success) {
    setTimeout(function () {
      card.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'center' });
    }, 400);
  }

  errors.forEach(function (err) {
    var field = err.closest('.kontak-pesan-field');
    if (field) field.classList.add('has-error', 'shake');
  });

  form.querySelectorAll('input, textarea').forEach(function (input) {
    input.addEventListener('input', function () {
      var field = input.closest('.kontak-pesan-field');
      var msg = field.querySelector('.kontak-pesan-error');
      field.classList.remove('has-error', 'shake');
      if (msg) msg.remove();
    });
  });

  if (success) {
    setTimeout(function () {
      success.classList.add('hide');
      setTimeout(function () { success.remove(); }, 500);
    }, 6000);
  }

  form.addEventListener('submit', function () {
    submit.classList.add('loading');
    label.textContent = 'Mengirim... ';
    setTimeout(function () { submit.disabled = true; }, 0);
  });

  window.addEventListener('pageshow', function (e) {
    if (!e.persisted) return;
    submit.disabled = false;
    submit.classList.remove('loading');
    label.textContent = labelText;
  });
});