
function consulta_buscador(busqueda) {
    var parametros = { "busqueda": busqueda };
    $.ajax({
        data: parametros,
        url: '../php/busqueda.php',
        type: 'POST',
        beforeSend: function () {

        },
        success: function (data) {

            if (busqueda == '') {
                document.getElementById("card_busqueda").style.opacity = 0;
            } else {
                document.getElementById("card_busqueda").style.transition = "all 1s";
                document.getElementById("card_busqueda").style.opacity = 1;
            }

            document.getElementById("resultados_busqueda_nav").innerHTML = data;
        },
        error: function (data, error) {


        }
    })
}
//funcion para añadir productos al carrito 
function add_cart(idCliente, idProducto, index) {

    let cantidadSelec = document.getElementsByClassName("contador")
    cantidadSelec = cantidadSelec[index].innerText;
    var parametros = {
        "idProducto": idProducto,
        "idCliente": idCliente,
        "cantidadSelec": cantidadSelec
    };
    $.ajax({
        data: parametros,
        url: '../php/AgMosCarrito.php',
        type: 'POST',
        beforeSend: function () {

        },
        success: function (data) {
            console.log(idCliente)
            if (idCliente != 0) {
                document.getElementById("items").innerHTML = data;
                document.getElementById("mySidebar").style.width = "40%"
            } else {

                // document.getElementById("myModal").style.display = "block"
            }
        },
        error: function (data, error) {


        }
    })
}
//funcion ajax para ver los productos del carrito al darle al icono del carrito
function view_cart(idCliente) {
    var parametros = {
        "idCliente": idCliente
    };
    $.ajax({
        data: parametros,
        url: '../php/AgMosCarrito.php',
        type: 'POST',
        beforeSend: function () {

        },
        success: function (data) {
            if (idCliente != undefined) {
                document.getElementById("items").innerHTML = data;
            }
        },
        error: function (data, error) {


        }
    })
}

function modalPedido() {
    var correo = $('#correoElectronico').val();
    var documento = $('#documento').val();
    var nombre = $('#nombre').val();
    var telefono = $('#telefono').val();
    var direccion = $('#direccion').val();
    $.ajax({
        data: {
            "correoElectronico": correo,
            "documento": documento,
            "nombre": nombre,
            "telefono": telefono,
            "direccion": direccion
        },
        url: "modalPedido.php",
        type: "post",
        success: function (response) {
            document.getElementById('modalbody').innerHTML = "pedido realizado con exito"
            console.log(response)
            setTimeout(() => {
                window.open(response);
            }, 1300);

        }
    })
};