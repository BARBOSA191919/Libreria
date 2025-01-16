document.addEventListener("DOMContentLoaded", () => {
  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(
    document.querySelectorAll(".navbar-burger"),
    0
  );

  // Add a click event on each of them
  $navbarBurgers.forEach((el) => {
    el.addEventListener("click", () => {
      // Get the target from the "data-target" attribute
      const target = el.dataset.target;
      const $target = document.getElementById(target);

      // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
      el.classList.toggle("is-active");
      $target.classList.toggle("is-active");
    });
  });
});

//Funcion para el siderbar
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const contentArea = document.getElementById("contentArea");
  sidebar.classList.toggle("expanded");
  contentArea.classList.toggle("shifted");
}

function showContent(sectionId) {
  // Ocultar todas las secciones
  document.querySelectorAll(".content-section").forEach((section) => {
    section.classList.remove("active");
  });

  // Mostrar la sección seleccionada
  document.getElementById(sectionId).classList.add("active");
}

// Mostrar la página de inicio por defecto
showContent("inicio");