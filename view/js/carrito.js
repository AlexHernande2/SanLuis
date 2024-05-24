
// Declaración de variables

const cards = document.getElementById('cards');
const templateCard = document.getElementById('template-card').content;
const items = document.getElementById('items');
const footer = document.getElementById('footer');
const templateFooter = document.getElementById('template-footer').content;
const templateCarrito = document.getElementById('template-carrito').content;
const fragment = document.createDocumentFragment();
let carrito = {};

// Evento que se ejecuta cuando el documento HTML se ha cargado completamente
document.addEventListener('DOMContentLoaded', () => {
    fetchData(); // Llama a la función fetchData para obtener los datos de los productos
    if (localStorage.getItem('carrito')) {
        carrito = JSON.parse(localStorage.getItem('carrito'));
        pintarCarrito(); // Si hay elementos en el carrito guardados en localStorage, los muestra en la interfaz
    }
});

// Evento que se dispara al hacer clic en los botones de las tarjetas de productos
cards.addEventListener('click', e => {
    addCarrito(e); // Llama a la función addCarrito para agregar un producto al carrito
});

// Evento que se dispara al hacer clic en los botones dentro del carrito (incrementar o disminuir cantidad)
items.addEventListener('click', e => {
    btnAccion(e); // Llama a la función btnAccion para ejecutar acciones en el carrito (incrementar, disminuir o eliminar producto)
});

// Función asíncrona para obtener los datos de los productos desde un archivo JSON
const fetchData = async () => {
    try {
        const res = await fetch('productos.json'); // Realiza una solicitud para obtener los datos del archivo JSON
        const data = await res.json(); // Convierte la respuesta en formato JSON
        pintarCard(data); // Llama a la función pintarCard para mostrar los productos en la interfaz
    } catch (error) {
        console.log(error); // En caso de error, muestra el error en la consola
    }
};

// Función para mostrar los productos en la interfaz
const pintarCard = data => {
    data.forEach(item => {
        // Actualiza el contenido de las tarjetas de productos con los datos de cada producto
        templateCard.querySelector('h5').textContent = item.title;
        templateCard.querySelector('p').textContent = `$${item.precio}`;
        templateCard.querySelector('img').setAttribute('src', item.thumbnailUrl);
        templateCard.querySelector('.btn-dark').dataset.id = item.id;
        const clone = templateCard.cloneNode(true); // Clona la tarjeta de producto
        fragment.appendChild(clone); // Agrega la tarjeta clonada al fragmento
    });
    cards.appendChild(fragment); // Agrega el fragmento con todas las tarjetas de productos al contenedor 'cards'
};

// Función para agregar un producto al carrito
const addCarrito = e => {
    if (e.target.classList.contains('btn-dark')) {
        setCarrito(e.target.parentElement); // Llama a la función setCarrito para agregar el producto al carrito
    }
    e.stopPropagation(); // Evita la propagación del evento
};

// Función para configurar el producto que se agrega al carrito
const setCarrito = item => {
    const producto = {
        title: item.querySelector('h5').textContent,
        precio: parseFloat(item.querySelector('p').textContent.replace('$', '')),
        id: item.querySelector('.btn-dark').dataset.id,
        cantidad: 1
    };

    if (carrito.hasOwnProperty(producto.id)) {
        producto.cantidad = carrito[producto.id].cantidad + 1;
    }

    carrito[producto.id] = { ...producto };
    pintarCarrito(); // Llama a la función pintarCarrito para mostrar el carrito actualizado en la interfaz
};

// Función para mostrar el carrito en la interfaz
const pintarCarrito = () => {
    items.innerHTML = ''; // Vacía el contenido actual del contenedor del carrito
    Object.values(carrito).forEach(producto => {
        templateCarrito.querySelector('th').textContent = producto.id;
        templateCarrito.querySelectorAll('td')[0].textContent = producto.title;
        templateCarrito.querySelectorAll('td')[1].textContent = producto.cantidad;
        templateCarrito.querySelector('.btn-info').dataset.id = producto.id;
        templateCarrito.querySelector('.btn-danger').dataset.id = producto.id;
        templateCarrito.querySelector('span').textContent = `$${producto.cantidad * producto.precio}`;
        const clone = templateCarrito.cloneNode(true); // Clona la fila del carrito
        fragment.appendChild(clone); // Agrega la fila clonada al fragmento
    });

    items.appendChild(fragment); // Agrega el fragmento con todas las filas del carrito al contenedor del carrito

    pintarFooter(); // Llama a la función pintarFooter para mostrar el pie de página del carrito
    localStorage.setItem('carrito', JSON.stringify(carrito)); // Guarda el carrito en localStorage
};

// Función para mostrar el pie de página del carrito
const pintarFooter = () => {
    footer.innerHTML = ''; // Vacía el contenido actual del pie de página del carrito
    if (Object.keys(carrito).length === 0) {
        // Si el carrito está vacío, muestra un mensaje
        footer.innerHTML = `
            <th scope="row" colspan="5">Carrito vacío - ¡comience a comprar!</th>
        `;
        return;
    }

    const nCantidad = Object.values(carrito).reduce((acc, { cantidad }) => acc + cantidad, 0);
    const nPrecio = Object.values(carrito).reduce((acc, { cantidad, precio }) => acc + cantidad * precio, 0);

    // Actualiza el contenido del pie de página con el total de productos y el precio total
    templateFooter.querySelectorAll('td')[0].textContent = nCantidad;
    templateFooter.querySelector('span').textContent = `$${nPrecio}`;

    const clone = templateFooter.cloneNode(true); // Clona el pie de página del carrito
    fragment.appendChild(clone); // Agrega el pie de página clonado al fragmento
    footer.appendChild(fragment); // Agrega el fragmento con el pie de página al contenedor del pie de página del carrito

    const btnVaciar = document.getElementById('vaciar-carrito');
    btnVaciar.addEventListener('click', () => {
        // Evento que se dispara al hacer clic en el botón para vaciar el carrito
        carrito = {}; // Vacía el carrito
        pintarCarrito(); // Vuelve a mostrar el carrito (ahora vacío) en la interfaz
    });
};

// Función para ejecutar acciones en el carrito (incrementar, disminuir o eliminar producto)
const btnAccion = e => {
    if (e.target.classList.contains('btn-info')) {
        // Si se hace clic en el botón de incrementar cantidad
        const producto = carrito[e.target.dataset.id];
        producto.cantidad++;
        carrito[e.target.dataset.id];
        producto.cantidad++;
        carrito[e.target.dataset.id] = { ...producto };
        pintarCarrito(); // Vuelve a mostrar el carrito con la cantidad actualizada
    }

    if (e.target.classList.contains('btn-danger')) {
        // Si se hace clic en el botón de disminuir cantidad
        const producto = carrito[e.target.dataset.id];
        producto.cantidad--;
        if (producto.cantidad === 0) {
            // Si la cantidad llega a cero, se elimina el producto del carrito
            delete carrito[e.target.dataset.id];
        }
        pintarCarrito(); // Vuelve a mostrar el carrito con la cantidad actualizada
    }

    e.stopPropagation(); // Evita la propagación del evento
};
