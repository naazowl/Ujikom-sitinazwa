(function () {
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce || !('IntersectionObserver' in window)) return;

  var groups = [
    { t: '.sambutan-container', gap: 200, items: [['.sambutan-img-wrap', 'left'], ['.sambutan-text', 'right']] },
    { t: '.tentang-card', gap: 0, items: [['.tentang-card', 'up']] },
    { t: '.visi-misi-grid', gap: 180, items: [['.visi-misi-box:nth-child(1)', 'left'], ['.visi-misi-box:nth-child(2)', 'right']] },
    { t: '.stats-grid', gap: 150, items: [['.stat-card', 'zoom']], countUp: true },
    { t: '.informasi-terbaru .section-header', gap: 0, items: [['.informasi-terbaru .section-header', 'up']] },
    { t: '.berita-scroll-wrap', gap: 140, items: [['.berita-card', 'up']] },
    { t: '.section-header-center', gap: 0, items: [['.section-header-center', 'zoom']] },
    { t: '.lihat-jurusan-wrap', gap: 0, items: [['.lihat-jurusan-wrap', 'up']] },
    { t: '.jurusan-list', gap: 130, items: [['.jurusan-item', 'left']] },

    { t: '.informasi-heading', gap: 0, items: [['.informasi-heading', 'up']] },
    { t: '.kategori-header:not(.kategori-header-center)', gap: 0,
      items: [['.kategori-header:not(.kategori-header-center)', 'up']] },
    { t: '.informasi-scroll-wrap', gap: 130, items: [['.informasi-card', 'up']] },
    { t: '.kategori-header-center', gap: 0, items: [['.kategori-header-center', 'zoom']] },
    { t: '.informasi-grid', gap: 100, each: true, items: [['.informasi-card', 'up']] },
    { t: '.galeri-grid', gap: 90, each: true, items: [['.galeri-item', 'zoom']] },

    { t: '.informasi-detail-top', gap: 0, items: [['.informasi-detail-top', 'left']] },
    { t: '.informasi-detail-card:not(.produk-detail-card)', gap: 120,
      items: [['.informasi-detail-card:not(.produk-detail-card)', 'up'],
              ['.informasi-detail-img', 'zoom'], ['.informasi-detail-meta', 'up'],
              ['.informasi-detail-title', 'up'], ['.informasi-detail-body', 'up'],
              ['.informasi-detail-hashtag', 'up']] },

    { t: '.produk-detail-card', gap: 120,
      items: [['.produk-detail-card', 'up'], ['.produk-kategori-label', 'up'],
              ['.informasi-detail-img', 'zoom'], ['.informasi-detail-title', 'up'],
              ['.informasi-detail-body', 'up']] },

    { t: '.jurusan-daftar-header', gap: 150,
      items: [['.jurusan-daftar-header h2', 'up'], ['.jurusan-daftar-header p', 'up']] },
    { t: '.jurusan-grid', gap: 130, each: true, items: [['.jurusan-page-card', 'up']] },

    { t: '.jurusan-detail-header', gap: 180,
      items: [['.jurusan-detail-badge', 'zoom'], ['.jurusan-detail-header > div:last-child', 'up']] },
    { t: '.jurusan-detail-desc-box', gap: 0, items: [['.jurusan-detail-desc-box', 'up']] },
    { t: '.jurusan-detail-grid', gap: 160,
      items: [['.jurusan-detail-photo', 'left'],
              ['.jurusan-left-col > .jurusan-detail-col', 'left'],
              ['.jurusan-detail-grid > .jurusan-detail-col', 'right']] },
    { t: '.jurusan-left-col > .jurusan-detail-col', gap: 110, base: 350, items: [['.jurusan-list-item', 'left']] },
    { t: '.prestasi-list', gap: 130, base: 350, items: [['.prestasi-item', 'up']] },

    { t: '.kontak-pesan-card', gap: 90,
      items: [['.kontak-pesan-card', 'up'], ['.kontak-pesan-card h2', 'up'],
              ['.kontak-pesan-card > p', 'up'], ['.kontak-pesan-field', 'up'],
              ['.kontak-pesan-submit', 'up']] },

    { t: '.kembali-wrap', gap: 0, items: [['.kembali-wrap', 'up']] }
  ];

  function find(trigger, sel) {
    if (trigger.matches(sel)) return [trigger];
    return Array.prototype.slice.call(trigger.querySelectorAll(sel));
  }

  function cleanUp(el) {
    el.addEventListener('animationend', function (e) {
      if (e.target !== el || e.animationName.indexOf('rv-') !== 0) return;
      el.classList.remove('reveal', 'show', 'reveal-up', 'reveal-left', 'reveal-right', 'reveal-zoom');
      el.style.removeProperty('--d');
    });
  }

  function countUp(el) {
    var original = el.textContent.trim();
    var m = original.match(/^(\D*)(\d{1,3}(?:[.,]\d{3})*|\d+)(.*)$/);
    if (!m) return;
    var target = parseInt(m[2].replace(/[.,]/g, ''), 10);
    if (!isFinite(target) || target === 0) return;

    var start = null, duration = 1500;
    function frame(ts) {
      if (start === null) start = ts;
      var p = Math.min((ts - start) / duration, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = m[1] + Math.round(target * eased).toLocaleString('id-ID') + m[3];
      if (p < 1) requestAnimationFrame(frame); else el.textContent = original;
    }
    el.textContent = m[1] + '0' + m[3];
    requestAnimationFrame(frame);
  }

  var observer = new IntersectionObserver(function (entries) {
    var k = 0;
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return;
      var info = entry.target._reveal;
      observer.unobserve(entry.target);

      if (info.batch) {
        entry.target.style.setProperty('--d', (info.base + Math.min(k, 6) * info.gap) + 'ms');
        k++;
      }
      info.els.forEach(function (el) { el.classList.add('show'); });

      if (info.countUp) {
        setTimeout(function () {
          entry.target.querySelectorAll('.stat-value').forEach(countUp);
        }, 300);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

  groups.forEach(function (g) {
    var base = g.base || 0;
    document.querySelectorAll(g.t).forEach(function (trigger) {
      var els = [], i = 0;
      g.items.forEach(function (it) {
        find(trigger, it[0]).forEach(function (el) {
          el.classList.add('reveal', 'reveal-' + it[1]);
          el.style.setProperty('--d', (base + Math.min(i, 8) * g.gap) + 'ms');
          cleanUp(el);
          els.push(el);
          i++;
        });
      });
      if (!els.length) return;

      if (g.each) {
        els.forEach(function (el) {
          el._reveal = { els: [el], gap: g.gap, base: base, batch: true };
          observer.observe(el);
        });
      } else {
        trigger._reveal = { els: els, countUp: !!g.countUp };
        observer.observe(trigger);
      }
    });
  });
})();