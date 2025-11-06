// navbar.js - static demo behavior
(function () {
  const menuToggle = document.getElementById('menuToggle');
  const navLinks = document.getElementById('navLinks');
  const searchForm = document.getElementById('searchForm');
  const searchInput = document.getElementById('searchInput');

  // Toggle mobile menu
  menuToggle.addEventListener('click', function () {
    const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
    menuToggle.setAttribute('aria-expanded', String(!expanded));
    navLinks.classList.toggle('open');
    menuToggle.querySelector('.menuIcon').textContent = navLinks.classList.contains('open') ? '✖' : '☰';
  });

  // Close menu when clicking a nav link
  navLinks.addEventListener('click', function (e) {
    if (e.target.tagName === 'A') {
      navLinks.classList.remove('open');
      menuToggle.setAttribute('aria-expanded', 'false');
      menuToggle.querySelector('.menuIcon').textContent = '☰';
    }
  });

  // Basic search handler (similar to your React console.log)
  searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
    console.log('Search:', searchInput.value.trim());
    // For real site: redirect to search results or perform action:
    // window.location.href = '/search?q=' + encodeURIComponent(searchInput.value.trim());
  });

  // Accessibility: close menu on ESC
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      navLinks.classList.remove('open');
      menuToggle.setAttribute('aria-expanded', 'false');
      menuToggle.querySelector('.menuIcon').textContent = '☰';
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  //go to top
  const goToTopBtn = document.querySelector('.gototop');

  if (goToTopBtn) {
    goToTopBtn.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
  // footer year
  const yearElements = document.querySelectorAll('.currentYear');
  const currentYear = new Date().getFullYear();

  yearElements.forEach(el => {
    el.textContent = currentYear;
  });

});

