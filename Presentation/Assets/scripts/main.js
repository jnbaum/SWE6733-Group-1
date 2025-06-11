document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.getElementById('menuToggle');
  const navMenu = document.getElementById('menu');

  toggle.addEventListener('click', function () {
    toggle.classList.toggle('open');
    navMenu.classList.toggle('open');
  });


  document.addEventListener('click', function (event) {
    const isClickInsideMenu = navMenu.contains(event.target);
    const isClickOnToggle = toggle.contains(event.target);

    if (!isClickInsideMenu && !isClickOnToggle && navMenu.classList.contains('open')) {
      navMenu.classList.remove('open');
      toggle.classList.remove('open');
    }
  });
});
