<?php
include 'header.php';
require '../../model/Producto.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';
require '../../controller/ProCaBaseController.php';
require '../../controller/ProCaController.php';
use proCaController\ProCaController;

var_dump(empty($documento));
if (empty($documento)) {
    $style = 'disabled';
} else {
    $style = '';

}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Carrito</h1>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody id="items">
                        <?php
                        if (!empty($documento)) {


                            //leer productos para mostrarlos al hacer click en el icono del carrito
                        
                            $proCa = new proCaController();
                            $proEnCarrito = $proCa->ReadPro($documento);
                            $contador = 1;
                            $precioTotalPro = 0;
                            $precioTotal = 0;
                            foreach ($proEnCarrito as $producto) {
                                $precioTotalPro = $producto->getPrecioUnitario() * $producto->getCantidad();
                                echo '<tr>
                                    <td>' . $contador . '</td>
                                    <td><img style="height: 70px; width: 70px;" src="data:' . $producto->getExtensionImagen() . ';base64,' . base64_encode($producto->getImagen()) . '"><br>' . $producto->getNombre() . '</td>
                                    <td>' . $producto->getCantidad() . '</td>
                                    <td> sumar restar</td>
                                    <td> ' . $precioTotalPro . ' COP</td>
                                  </tr>';
                                $contador++;
                                $precioTotal += $precioTotalPro;
                            }

                            echo '<tr>
                                 <td>TOTAL</td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td>' . $precioTotal . ' COP</td>
                             </tr>';
                        } else {
                            echo '<tfoot>
                            <tr id="footer">
                                <th scope="row" colspan="5">Carrito vacío - inicia Sesion para comenzar a comprar!</th>
                            </tr>
                        </tfoot>';
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">

                <!-- formulario del pedido o resumen del pedido -->
                <form id="form" >

                    <h2>Resumen del pedido:</h2>
                    <div class="mb-3">
                        <!-- Grupo de formulario con margen inferior -->
                        <label name="correoElectronico" class="form-label">Email</label>
                        <!-- Etiqueta del campo de correo electrónico -->
                        <input type="text" id="correoElectronico" <?php echo $style ?> name="correoElectronico"
                            class="form-control" value="<?php echo $Cliente->getCorreoElectronico() ?>">
                        <!-- Campo de entrada de texto para el correo electrónico -->
                    </div>
                    <div class="mb-3">
                        <!-- Grupo de formulario con margen inferior -->
                        <label name="documento" class="form-label">documento</label>
                        <!-- Etiqueta del campo de contraseña con texto dinámico -->
                        <input name="documento" id="documento" <?php echo $style ?> class="form-control"
                            value="<?php echo $Cliente->getDocumento() ?>">
                        <!-- Campo de entrada de texto para el documento con tipo dinámico -->
                    </div>
                    <div class="mb-3">
                        <!-- Grupo de formulario con margen inferior -->
                        <label name="nombre" class="form-label">Nombre</label>
                        <!-- Etiqueta del campo de nombre con estilo dinámico -->
                        <input type="text" <?php echo $style ?> id="nombre" name="nombre" class="form-control"
                            value="<?php echo $Cliente->getNombre() ?>">
                        <!-- Campo de entrada de texto para el nombre con estilo dinámico -->
                    </div>
                    <div class="mb-3">
                        <!-- Grupo de formulario con margen inferior -->
                        <label name="telefono" class="form-label">Teléfono</label>
                        <!-- Etiqueta del campo de teléfono con estilo dinámico -->
                        <input type="number" <?php echo $style ?> id="telefono" name="telefono" class="form-control"
                            value="<?php echo $Cliente->getTelefono() ?>">
                        <!-- Campo de entrada de número para el teléfono con estilo dinámico -->
                    </div>
                    <div class="mb-3">
                        <!-- Grupo de formulario con margen inferior -->
                        <label name="direccion" class="form-label">Dirección</label>
                        <!-- Etiqueta del campo de dirección con estilo dinámico -->
                        <input type="text" <?php echo $style ?> name="direccion" id="direccion" class="form-control"
                            value="<?php echo $Cliente->getDireccion() ?>">
                        <!-- Campo de entrada de texto para la dirección con estilo dinámico -->
                    </div>
                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <td>Total a pagar:</td>
                                <!-- Aca debe ir el precio -->
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">

                                    <button onclick="modalPedido()" type="button" class="btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#myModal">
                                        Finalizar compra
                                    </button>
                                    <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Modal Heading</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body" id="modalbody">

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>



            </div>
        </div>

        <footer>
            <div style="margin-left:-25%;margin-right: -15.25%;" id="footer-container"></div>
        </footer>
        <script>
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
                    success: function (response,response2) {
                        document.getElementById('modalbody').innerHTML = response
                        console.log(response)
                        // setTimeout(() => {
                        //     window.open('https://api.whatsapp.com/send?phone=573108108175&text=ramiro');
                        // }, 1300);
                       
                    }
                })
            };
        </script>

        <script src="../js/carrito.js"></script>
        <script src="../js/index.js"></script>
       
        <script src="../js/initHF.js"></script>
    
    
</body>

</html>