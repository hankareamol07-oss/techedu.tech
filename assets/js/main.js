(() => {
  const $ = (s, c = document) => c.querySelector(s), $$ = (s, c = document) => [...c.querySelectorAll(s)];
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const fine = matchMedia('(pointer: fine)').matches;

  // loader
  const hideLoader = () => $('#loader')?.classList.add('done');
  addEventListener('load', () => setTimeout(hideLoader, 250));
  setTimeout(hideLoader, 2500);

  // split hero headline into words
  $$('.split').forEach(el => {
    let d = 0;
    const walk = n => [...n.childNodes].forEach(c => {
      if (c.nodeType === 3) {
        const frag = document.createDocumentFragment();
        c.textContent.split(/(\s+)/).forEach(w => {
          if (!w.trim()) { frag.append(w); return; }
          const s = document.createElement('span'); s.className = 'split-word'; s.textContent = w;
          s.style.animationDelay = (0.3 + d++ * 0.09) + 's'; frag.append(s);
        });
        c.replaceWith(frag);
      } else if (c.nodeType === 1 && !c.classList.contains('typed') && c.tagName !== 'BR') walk(c);
      else if (c.nodeType === 1 && c.classList.contains('typed')) { c.classList.add('split-word'); c.style.animationDelay = (0.3 + d++ * 0.09) + 's'; }
    });
    walk(el);
  });

  // typing effect
  const ty = $('.typed');
  if (ty && !reduce) {
    const words = JSON.parse(ty.dataset.words); let wi = 0, ci = words[0].length, del = true;
    const tick = () => {
      const w = words[wi];
      ty.textContent = w.slice(0, ci);
      if (del) { ci--; if (ci < 0) { del = false; wi = (wi + 1) % words.length; ci = 0; } }
      else { ci++; if (ci > words[wi].length) { del = true; return setTimeout(tick, 1800); } }
      setTimeout(tick, del ? 45 : 90);
    };
    setTimeout(tick, 2600);
  }

  // reveal on scroll + counters
  const io = new IntersectionObserver(es => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in');
    $$('.count', e.target).forEach(countUp);
    io.unobserve(e.target);
  }), { threshold: .15, rootMargin: '0px 0px -40px 0px' });
  $$('.rv').forEach(el => io.observe(el));
  function countUp(el) {
    const to = +el.dataset.to, dur = 1800, t0 = performance.now();
    const step = t => { const p = Math.min((t - t0) / dur, 1); el.textContent = Math.round(to * (1 - Math.pow(1 - p, 3))); if (p < 1) requestAnimationFrame(step); };
    requestAnimationFrame(step);
  }

  // nav state, progress, active link, back-to-top
  const nav = $('#nav'), prog = $('#progress'), top = $('#totop');
  const links = $$('.menu a[href^="#"]');
  const secs = links.map(a => $(a.getAttribute('href'))).filter(Boolean);
  const onScroll = () => {
    const y = scrollY, h = document.documentElement.scrollHeight - innerHeight;
    nav.classList.toggle('scrolled', y > 30);
    prog.style.width = (h > 0 ? y / h * 100 : 0) + '%';
    top.classList.toggle('show', y > 700);
    let cur = ''; secs.forEach(s => { if (s.offsetTop - 140 <= y) cur = '#' + s.id; });
    links.forEach(a => a.classList.toggle('active', a.getAttribute('href') === cur));
  };
  addEventListener('scroll', onScroll, { passive: true }); onScroll();
  top.addEventListener('click', () => scrollTo({ top: 0, behavior: 'smooth' }));

  // mobile menu
  const menu = $('#menu');
  $('#burger').addEventListener('click', () => menu.classList.toggle('open'));
  links.forEach(a => a.addEventListener('click', () => menu.classList.remove('open')));

  // portfolio filter
  const grid = $('#workGrid');
  $$('#filters button').forEach(b => b.addEventListener('click', () => {
    $$('#filters button').forEach(x => x.classList.toggle('on', x === b));
    const f = b.dataset.f;
    $$('.pj', grid).forEach((c, i) => {
      const show = f === 'all' || c.dataset.type === f;
      c.classList.toggle('hide', !show);
      c.classList.toggle('wide', show && f === 'all' && i === 0);
      if (show) { c.classList.remove('in'); c.style.transitionDelay = (i % 3) * .08 + 's'; requestAnimationFrame(() => requestAnimationFrame(() => c.classList.add('in'))); }
    });
  }));

  // pricing → preselect service
  $$('[data-plan]').forEach(a => a.addEventListener('click', () => {
    const sel = $('#service'); const v = a.dataset.plan + ' package';
    [...sel.options].forEach(o => { if (o.text === v) sel.value = v; });
  }));

  if (fine && !reduce) {
    // cursor glow
    const g = $('#glow');
    addEventListener('mousemove', e => { g.style.left = e.clientX + 'px'; g.style.top = e.clientY + 'px'; });
    // 3D tilt
    $$('.tilt').forEach(c => {
      c.addEventListener('mousemove', e => {
        const r = c.getBoundingClientRect(), x = (e.clientX - r.left) / r.width - .5, y = (e.clientY - r.top) / r.height - .5;
        c.style.transform = `perspective(900px) rotateX(${-y * 7}deg) rotateY(${x * 9}deg) translateY(-6px)`;
      });
      c.addEventListener('mouseleave', () => c.style.transform = '');
    });
    // hero parallax
    const stage = $('#stage');
    stage && addEventListener('mousemove', e => {
      const x = e.clientX / innerWidth - .5, y = e.clientY / innerHeight - .5;
      $$('[data-depth]', stage).forEach(el => { const d = +el.dataset.depth; el.style.translate = `${-x * d}px ${-y * d}px`; });
    });
  }

  // particle network background
  const cv = $('#bgfx');
  if (cv && !reduce) {
    const ctx = cv.getContext('2d'); let W, H, pts;
    const init = () => {
      W = cv.width = innerWidth; H = cv.height = innerHeight;
      const n = Math.min(70, Math.floor(W * H / 22000));
      pts = Array.from({ length: n }, () => ({ x: Math.random() * W, y: Math.random() * H, vx: (Math.random() - .5) * .35, vy: (Math.random() - .5) * .35 }));
    };
    const draw = () => {
      ctx.clearRect(0, 0, W, H);
      for (let i = 0; i < pts.length; i++) {
        const p = pts[i]; p.x += p.vx; p.y += p.vy;
        if (p.x < 0 || p.x > W) p.vx *= -1; if (p.y < 0 || p.y > H) p.vy *= -1;
        ctx.fillStyle = 'rgba(150,160,255,.55)'; ctx.beginPath(); ctx.arc(p.x, p.y, 1.4, 0, 7); ctx.fill();
        for (let j = i + 1; j < pts.length; j++) {
          const q = pts[j], d = Math.hypot(p.x - q.x, p.y - q.y);
          if (d < 130) { ctx.strokeStyle = `rgba(108,92,255,${.18 * (1 - d / 130)})`; ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(q.x, q.y); ctx.stroke(); }
        }
      }
      requestAnimationFrame(draw);
    };
    addEventListener('resize', init); init(); draw();
  }

  // contact form (AJAX for both PHP and static/FormSubmit)
  const form = $('#contactForm'), msg = $('#formMsg');
  form?.addEventListener('submit', async ev => {
    ev.preventDefault();
    const btn = form.querySelector('button[type=submit]'), old = btn.innerHTML;
    btn.disabled = true; btn.textContent = 'Sending…';
    msg.className = 'form-msg';
    try {
      const res = await fetch(form.dataset.ajax, { method: 'POST', body: new FormData(form), headers: { Accept: 'application/json' } });
      const j = await res.json().catch(() => ({}));
      if (!res.ok || j.success === false || j.success === 'false') throw new Error(j.message || 'Failed');
      msg.className = 'form-msg ok'; msg.textContent = 'Thanks! Your message has been sent. I will reply within 24 hours.';
      form.reset();
    } catch (e) {
      msg.className = 'form-msg err'; msg.textContent = (e.message && e.message !== 'Failed' ? e.message + ' ' : '') + 'Could not send right now. Please email me directly.';
    } finally { btn.disabled = false; btn.innerHTML = old; }
  });
})();
