
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


function consulta_buscador_admin(busqueda, busqueda2, busqueda3) {
    admin = "si"

    busqueda = $('#buscar1').val()
    busqueda2 = $('#buscar2').val()
    busqueda3 = $('#buscar3').val()

    var parametros = {
        "busqueda": busqueda,
        "busqueda2": busqueda2,
        "busqueda3": busqueda3,
        "admin": admin
    };
    $.ajax({
        data: parametros,
        url: '../php/busqueda.php',
        type: 'POST',
        beforeSend: function () {

        },
        success: function (data) {


            document.getElementById("bodyAdmin").innerHTML = data;
        },
        error: function (data, error) {


        }
    })
}

//funcion para añadir productos al carrito 

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
                document.getElementById("itemsAgMosCarrito1").innerHTML = data;
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
            Response = response.trim();
            if (Response == "noProductos") {
                document.getElementById('modalbody').innerHTML = "no tienes productos en el carrito"
             
            } else if (Response == "no datos") {
                document.getElementById('modalbody').innerHTML = "faltan incluir datos del cliente"
                console.log(Response)
            }
            else {
                document.getElementById('modalbody').innerHTML = "pedido realizado con exito"
                document.getElementById('buttonPedido').setAttribute("onclick","window.location.href = 'carrito.php'")
                document.getElementById('equisPed').setAttribute("onclick","window.location.href = 'carrito.php'")
                setTimeout(() => {
                    window.open(Response);
                }, 500);
            }
        }
    })
};


function add_cart(idCliente, idProducto, index , total) {

    let cantidadSelec = document.getElementsByClassName("contador");
    cantidadSelec = cantidadSelec[index].innerText;
   
  
    var parametros = {
        "idProducto": idProducto,
        "idCliente": idCliente,
        "cantidadSelec": cantidadSelec
    };

    $.ajax({
        data: parametros,
        url: 'AgMosCarrito.php',
        type: 'POST',
        success: function (data) {
            console.log(idCliente);
            if (idCliente != 0) {
                if (data == 1) {
                    console.log(data)
                    $('#exampleModal').modal('show');
                    $('#ModalBodyAdv').text("No se pueden agregar mas unidades de las "+total+" que se encuentran en existencia");
                    console.log('entre a la condicion');
                } else {
                    $('#itemsAgMosCarrito1').html(data);
                    // actualizarParteEspecifica(idCliente);
                    document.getElementById("mySidebar").style.width = "40%"
                    // Actualizar solo una parte específica de la página

                }
            }else{
                let tipoProd = document.getElementById('tipoProd').innerText;
                document.getElementById('linkIniSes').setAttribute('href',"formSesion.php?inicioSesion=si&section="+idProducto+"&tipoProducto="+tipoProd) 
            }
        }
    });
}

function actualizarParteEspecifica(idCliente) {

    const data = {
        "idCliente": idCliente
    }
    $.ajax({
        data: data,
        url: 'AgMosCarrito.php',
        type: 'POST',
        success: function (data) {
             document.getElementById("mySidebar").style.width = "40%"
            $('#itemsAgMosCarrito1').html(data); // Actualizar otra sección de la página con el contenido obtenido
        }
    });
}

function decrementincrementCounterCart(conta, idProducto, cantMaxProd, cantidadYaSelec, operacion, idClienteAcc) {
    let input = document.getElementsByClassName('numberInput')
    fieldInput = input[conta].value
    $idcliente = idClienteAcc
    console.log(conta)
    console.log(idProducto)
    console.log(cantMaxProd)
    console.log(cantidadYaSelec)
    console.log(operacion)
    console.log(idClienteAcc)

    $.ajax({
        data: {
            "idProductoAccion": idProducto,
            "cantMaxProd": cantMaxProd,
            "fieldInput": fieldInput,
            "cantidadYaSelec": cantidadYaSelec,
            "operacion": operacion,
            "idCliente": idClienteAcc
        },
        url: "../php/AgMosCarrito.php",
        type: "post",

        success: function (data) {

            if (data == 1) {
                $('#exampleModal').modal('show');
                $('#ModalBodyAdv').text("No se pueden agregar mas unidades de las "+cantMaxProd+" que se encuentran en existencia");
                console.log('entre a la condicion')
            } else {
                console.log(data)
                document.getElementById("itemsAgMosCarrito1").innerHTML = data;
             
                

            }


        }
    })
}

function decrementincrementCounterCart2(conta, idProducto, cantMaxProd, cantidadYaSelec, operacion, idClienteAcc,precioUni) {
    let input = document.getElementsByClassName('numberInput')
    fieldInput = input[conta].value
    $idcliente = idClienteAcc
    total = document.getElementById('totAnt').innerText
    total = parseInt(total);

    $.ajax({
        data: {
            "idProductoAccion": idProducto,
            "cantMaxProd": cantMaxProd,
            "fieldInput": fieldInput,
            "cantidadYaSelec": cantidadYaSelec,
            "operacion": operacion,
            "idCliente": idClienteAcc
        },
        url: "AgMosCarritoPedido.php",
        type: "post",

        success: function (data) {

            if (data == 1) {
                $('#exampleModal').modal('show');
                $('#ModalBodyAdv').text("No se pueden agregar mas unidades de las "+cantMaxProd+" que se encuentran en existencia");
                console.log('entre a la condicion')
            } else {
              
                document.getElementById("items2").innerHTML = data;
                if(operacion == 1){
                    TotalPag = (fieldInput*precioUni)+total
                    document.getElementById('totPag').innerText = 'Total a pagar: '+TotalPag+' COP';
                }else if(operacion==0){
                    TotalPag = total-(fieldInput*precioUni);
                document.getElementById('totPag').innerText = 'Total a pagar: '+TotalPag+' COP';
                }
            }


        }
    })
}

function validateNumber(index, maxValue) {
    let input = document.getElementsByClassName('numberInput')
    fieldT = input[index]
    field = input[index].value

    var value = parseFloat(field);

    if (value < 0) {
        fieldT.value = 0;
    } else if (value > maxValue) {
        fieldT.value = maxValue;
    }
}


function modalModificarProd(id, modEl) {
    let idProducto = id;
    console.log(modEl);
    var parametros = {
        "id": id,
        "modEl":modEl
    }
    $.ajax({
        data: parametros,
        url: "modalModificarProducto.php",
        type: "post",
        success: function (response) {
            document.getElementById("modalbodyAdmin").innerHTML = response;
            if (modEl == "no") {
                document.getElementById("modEl").innerHTML = '<button form="DeleteForm" type="submit" class="col-3 btn btn-danger">ELIMINAR</button>';
            } else {
                document.getElementById("modEl").innerHTML = '<button form="CreateForm" type="submit" class="col-3 btn btn-primary">MODIFICAR</button>';
            }
        }
    });
}



