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
