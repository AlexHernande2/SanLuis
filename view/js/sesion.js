 document.addEventListener('DOMContentLoaded', function() {
    const footerContainer = document.getElementById('footer-container');
    const footerHtmlFile = 'footer.html'; // Ruta 
    const xhr = new XMLHttpRequest(); // Crear una nueva instancia de XMLHttpRequest
    xhr.open('GET', footerHtmlFile, true);
    xhr.onreadystatechange = function() {
       if (xhr.readyState === 4 && xhr.status === 200) {
          footerContainer.innerHTML = xhr.responseText;
       }
    };
    xhr.send();
 });


 