  // Obtiene una referencia al botón de carrito
  var cartButton = document.getElementById('cartButton');
  // Obtiene una referencia al menú lateral
  var sidebar = document.getElementById('mySidebar');


// Espera a que el documento esté completamente cargado
document.addEventListener("DOMContentLoaded", function() {
  
    // Agrega un event listener al botón de carrito
    cartButton.addEventListener('click', function() {
      // Muestra el menú lateral cambiando el ancho a 250px
      sidebar.style.width = '250px';
    });
    // Función para cerrar el menú lateral
    function closeNav() {
      sidebar.style.width = '0';
    }
    // Agrega un event listener al botón de cerrar en el menú lateral
    document.querySelector('.closebtn').addEventListener('click', closeNav);
  });
  
  // Obtener todos los elementos del DOM
const allElements = document.querySelectorAll('*');

// Crear un conjunto para almacenar los IDs únicos
const uniqueIds = new Set();

// Iterar sobre todos los elementos y agregar sus IDs al conjunto
allElements.forEach(element => {
    const id = element.id;
    if (id) {
        uniqueIds.add(id);
    }
});

// Convertir el conjunto a un array para poder trabajar con él
const arrayOfIds = Array.from(uniqueIds);

// Imprimir los IDs en la consola
console.log(arrayOfIds);
