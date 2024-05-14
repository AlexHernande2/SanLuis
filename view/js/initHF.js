// Espera a que se cargue completamente el DOM antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function () {
    // Obtiene una referencia al contenedor del encabezado por su ID
    const headerContainer = document.getElementById('header-container');
    // Especifica la ruta del archivo HTML que contiene el encabezado
    const headerHtmlFile = 'header.php'; // Ruta 
    // Crea una nueva instancia de XMLHttpRequest para realizar la solicitud HTTP
    const xhr = new XMLHttpRequest();
    // Abre una conexión HTTP GET asíncrona hacia el archivo HTML del encabezado
    xhr.open('GET', headerHtmlFile, true);
    // Define una función para manejar el cambio de estado de la solicitud
    xhr.onreadystatechange = function () {
        // Verifica si la solicitud se ha completado y si el código de estado es 200 (OK)
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Si la solicitud es exitosa, actualiza el contenido del contenedor del encabezado
            headerContainer.innerHTML = xhr.responseText;
        }
    };
    // Envía la solicitud HTTP
    xhr.send();



    // Carga el pie de página
    const footerContainer = document.getElementById('footer-container');
    const footerHtmlFile = 'footer.html';
    const footerXhr = new XMLHttpRequest();
    footerXhr.open('GET', footerHtmlFile, true);
    footerXhr.onreadystatechange = function () {
        if (footerXhr.readyState === 4 && footerXhr.status === 200) {
            footerContainer.innerHTML = footerXhr.responseText;
        }
    };
    footerXhr.send();
});

//dsd


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


