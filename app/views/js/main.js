<<<<<<< HEAD
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
=======
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
>>>>>>> 0581fbafd9367251b0cb8c65dc9b7cf79480dc82
  });
});

<<<<<<< HEAD
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

=======
>>>>>>> 0581fbafd9367251b0cb8c65dc9b7cf79480dc82
  // Mostrar la sección seleccionada
  document.getElementById(sectionId).classList.add("active");
}

// Mostrar la página de inicio por defecto
showContent("inicio");
<<<<<<< HEAD
=======

/* --------------------------------------------------------------------------------------------------*/
// Funcion para cargar contenido
function cargarContenido(archivo, elementoId) {
  const elemento = document.getElementById(elementoId);

  // Agregar el spinner de carga
  elemento.innerHTML = `
    <div class="loading-spinner">
      <div class="spinner"></div>
      <p>Cargando contenido...</p>
    </div>
  `;

  console.log("Cargando spinner en:", elementoId);
  console.log(elemento.innerHTML);

  fetch(`./public/pages/${archivo}`)
    .then((response) => {
      if (!response.ok)
        throw new Error(`HTTP error! status: ${response.status}`);
      return response.text();
    })
    .then((html) => {
      elemento.innerHTML = html;
    })
    .catch((error) => {
      console.error(`Error al cargar ${archivo}:`, error);
      elemento.innerHTML = `
        <div class="error-message">
          Error al cargar el contenido. Por favor, intente más tarde.
        </div>
      `;
    });
}

//uso
cargarContenido("clientes.html", "cliente-content");
>>>>>>> 0581fbafd9367251b0cb8c65dc9b7cf79480dc82
