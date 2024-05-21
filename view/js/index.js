// Espera a que se cargue completamente el DOM antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function () {

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



