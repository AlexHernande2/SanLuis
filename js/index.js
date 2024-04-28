const carrusel = document.getElementById('carruselImagenes');
const imagenes = carrusel.getElementsByTagName('img');
let indice = 0;

// Ocultar todas las imágenes excepto la primera
for (let i = 1; i < imagenes.length; i++) {
    imagenes[i].style.display = 'none';
}

// Función para cambiar la imagen
function cambiarImagen() {
    // Ocultar imagen actual
    imagenes[indice].style.display = 'none';
    // Calcular el índice de la próxima imagen
    indice = (indice + 1) % imagenes.length;
    // Muestra la proxima imagen
    imagenes[indice].style.display = 'block';
   
}
setInterval(cambiarImagen, 3000);

