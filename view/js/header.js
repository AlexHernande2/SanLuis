  // Obtiene una referencia al botón de carrito
  var cartButton = document.getElementById('cartButton');
  // Obtiene una referencia al menú lateral
  var sidebar = document.getElementById('mySidebar');


// Espera a que el documento esté completamente cargado
document.addEventListener("DOMContentLoaded", function() {
  // Obtiene una referencia al botón de carrito
  var cartButton = document.getElementById('cartButton');
  // Obtiene una referencia al menú lateral
  var sidebar = document.getElementById('mySidebar');

  // Agrega un event listener al botón de carrito
  cartButton.addEventListener('click', function() {
      // Muestra el menú lateral cambiando el ancho a 50%
      sidebar.style.width = '40%';
  });

  // Función para cerrar el menú lateral
  function closeNav() {
      sidebar.style.width = '0';
  }

  // Agrega un event listener al botón de cerrar en el menú lateral
  document.querySelector('.closebtn').addEventListener('click', closeNav);
});


// // Convertir el conjunto a un array para poder trabajar con él
// const arrayOfIds = Array.from(uniqueIds);

// // Imprimir los IDs en la consola
// console.log(arrayOfIds);
