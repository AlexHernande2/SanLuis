 // Variables globales para controlar el carrusel
 let currentIndex = 1;
 let intervalId;

 // Función para avanzar al siguiente elemento del carrusel
 function nextSlide() {
   const currentSlide = document.getElementById(`itemCarrusel-${currentIndex}`);
   const nextIndex = currentIndex === 3 ? 1 : currentIndex + 1;
   const nextSlide = document.getElementById(`itemCarrusel-${nextIndex}`);
   currentSlide.style.display = 'none';
   nextSlide.style.display = 'block';
   currentIndex = nextIndex;
 }

 // Función para iniciar la transición automática
 function startAutoSlide() {
   intervalId = setInterval(nextSlide, 5000); // Cambia de imagen cada 3 segundos
 }

 // Iniciar la transición automática al cargar la página
 startAutoSlide();

 // Detener la transición automática cuando el usuario interactúa con el carrusel
 const carruselItems = document.querySelectorAll('.itemCarrusel');
 carruselItems.forEach(item => {
   item.addEventListener('mouseenter', () => {
     clearInterval(intervalId);
   });
   item.addEventListener('mouseleave', startAutoSlide);
 });
 