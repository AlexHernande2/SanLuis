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

/* Funcion que sorve para cuando se le pasa el cursor sobre un menu desplegable se desplegue sola*/
const $dropdown = $(".dropdown");
const $dropdownToggle = $(".dropdown-toggle");
const $dropdownMenu = $(".dropdown-menu");
const showClass = "show";
$(window).on("load resize", function() {
    if (this.matchMedia("(min-width: 768px)").matches) {
        $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
        );
    } else {
        $dropdown.off("mouseenter mouseleave");
    }
});

