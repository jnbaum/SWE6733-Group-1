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

function openModal() {
  const modal = document.getElementById("customModal");
  modal.style.display = "flex";
}


function closeModal() {
    document.getElementById("customModal").style.display = "none";
}

// Optional: close modal if user clicks outside the content
window.onclick = function(event) {
    const modal = document.getElementById("customModal");
    if (event.target === modal) {
        closeModal();
    }
};

function submitAdventure() {
  const type = document.getElementById('myDropdown2').value;
  const skill = document.getElementById('myDropdown3').value;
  const attitude = document.getElementById('myDropdown4').value;

  // TODO: Replace with actual DB/API logic
  console.log("Adventure submitted:", { type, skill, attitude });

  closeModal(); // Optional: Close modal after submit
}