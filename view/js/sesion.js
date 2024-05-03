document.addEventListener('DOMContentLoaded', function() {
    const headerContainer = document.getElementById('header-container');
    const headerHtmlFile = 'header.html'; // Ruta corregida
    const xhr = new XMLHttpRequest(); // Crear una nueva instancia de XMLHttpRequest
    xhr.open('GET', headerHtmlFile, true);
    xhr.onreadystatechange = function() {
       if (xhr.readyState === 4 && xhr.status === 200) {
          headerContainer.innerHTML = xhr.responseText;
       }
    };
    xhr.send();
 });