
function consulta_buscador(busqueda) {
    var parametros = { "busqueda": busqueda };
    $.ajax({
        data: parametros,
        url: '../html/busqueda.php',
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
function add_cart(idCliente,idProducto,index) {
    let cantidadSelec = document.getElementsByClassName("contador")
    cantidadSelec = cantidadSelec[index].innerText;
    var parametros = { 
        "idProducto": idProducto,
        "idCliente" : idCliente,
        "cantidadSelec" : cantidadSelec
    };
    $.ajax({
        data: parametros,
        url: '../html/AgMosCarrito.php',
        type: 'POST',
        beforeSend: function () {

        },
        success: function (data) {
            console.log(cantidadSelec)
            document.getElementById("items").innerHTML = data;
            document.getElementById("mySidebar").style.width = "40%"
        },
        error: function (data, error) {


        }
    })
}
//funcion ajax para ver los productos del carrito al darle al icono del carrito
function view_cart(idCliente){
    var parametros = { 
        "idCliente":idCliente
    };
    $.ajax({
        data: parametros,
        url: '../html/AgMosCarrito.php',
        type: 'POST',
        beforeSend: function () {
            
        },
        success: function (data) {
            if(idCliente != undefined){
            document.getElementById("items").innerHTML = data;
            }
        },
        error: function (data, error) {


        }
    })
}
