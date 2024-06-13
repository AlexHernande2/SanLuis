<?php
include 'header.php';
require '../../model/Producto.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';
require '../../controller/ProCaBaseController.php';
require '../../controller/ProCaController.php';

use producto\Producto;
use productoController\ProductoController;
use proCaBasecontroller\ProCaBasecontroller;
use proCaController\ProCaController;


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
                            <th scope="col">Acción sum</th>
                            <th scope="col">Acción res</th>
                            <th scope="col"></th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody id="items2">
                        <?php
                        if (!empty($documento)) {


                            //leer productos para mostrarlos al hacer click en el icono del carrito
                        
                            $proCa = new proCaController();
                            $proEnCarrito = $proCa->ReadPro($documento);
                            $contador = 1;
                            $conta = 0;
                            $precioTotalPro = 0;
                            $precioTotal = 0;

                            $productoRow = new productoController();
                            $cantidadProductos = [];
                            //cantidad maxima de un producto
                            foreach ($proEnCarrito as $producto) {
                                $productoCantidadmax = $productoRow->readRow($producto->getId());
                                array_push($cantidadProductos, $productoCantidadmax->getCantidad());
                            }

                            foreach ($proEnCarrito as $producto) {
                                if ($producto->getCantidad() != 0) {
                                $precioTotalPro = $producto->getPrecioUnitario() * $producto->getCantidad();
                                echo '<tr>
                                    <td>' . $contador . '</td>
                                    <td><img style="height: 70px; width: 70px;" src="data:' . $producto->getExtensionImagen() . ';base64,' . base64_encode($producto->getImagen()) . '"><br>' . $producto->getNombre() . '</td>
                                    <td>' . $producto->getCantidad() . '</td>
                                    <td><button onclick="decrementincrementCounterCart2(' . $conta . ',' . $producto->getId() . ',' . $cantidadProductos[$conta] . ',' . $producto->getCantidad() . ', 0,' . $documento . ')" class="menos btn btn-danger d-inline">-</button></td>
                                    <td><button onclick="decrementincrementCounterCart2(' . $conta . ',' . $producto->getId() . ',' . $cantidadProductos[$conta] . ',' . $producto->getCantidad() . ', 1,' . $documento . ')" class="mas btn btn-success d-inline">+</button></td>
                                    <td><input value="1" type="number" oninput="validateNumber('.$conta.','.$cantidadProductos[$conta].')" max="' . $producto->getCantidad() . '" class="numberInput" style="width:50px;"></td>                        
                                    <td> ' . $precioTotalPro . ' COP</td>
                                  </tr>';
                                $contador++;
                                $conta++;
                                $precioTotal += $precioTotalPro;
                            }
                        }
                            echo '<tr>
                                 <td>TOTAL</td>
                                 <td></td>
                                 <td></td>
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
                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <!-- modal ADVERTENCIA -->
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">ADVERTENCIA</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div id="ModalBodyAdv" class="modal-body">
                                No puedes agregar mas unidades de este producto
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- formulario del pedido o resumen del pedido -->
                <form id="form">

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
                        <input name="documento" required id="documento" <?php echo $style ?> class="form-control"
                            value="<?php echo $Cliente->getDocumento() ?>">
                        <!-- Campo de entrada de texto para el documento con tipo dinámico -->
                    </div>
                    <div class="mb-3">
                        <!-- Grupo de formulario con margen inferior -->
                        <label name="nombre" class="form-label">Nombre</label>
                        <!-- Etiqueta del campo de nombre con estilo dinámico -->
                        <input type="text" <?php echo $style ?> required id="nombre" name="nombre" class="form-control"
                            value="<?php echo $Cliente->getNombre() ?>">
                        <!-- Campo de entrada de texto para el nombre con estilo dinámico -->
                    </div>
                    <div class="mb-3">
                        <!-- Grupo de formulario con margen inferior -->
                        <label name="telefono" class="form-label">Teléfono</label>
                        <!-- Etiqueta del campo de teléfono con estilo dinámico -->
                        <input type="number" required <?php echo $style ?> id="telefono" name="telefono" class="form-control"
                            value="<?php echo $Cliente->getTelefono() ?>">
                        <!-- Campo de entrada de número para el teléfono con estilo dinámico -->
                    </div>
                    <div class="mb-3">
                        <!-- Grupo de formulario con margen inferior -->
                        <label name="direccion" class="form-label">Dirección</label>
                        <!-- Etiqueta del campo de dirección con estilo dinámico -->
                        <input type="text" required <?php echo $style ?> name="direccion" id="direccion" class="form-control"
                            value="<?php echo $Cliente->getDireccion() ?>">
                        <!-- Campo de entrada de texto para la dirección con estilo dinámico -->
                    </div>
                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <td id="totPag">Total a pagar: <?php echo $precioTotal . ' COP' ?></td>
                                <!-- Aca debe ir el precio -->
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">

                                    <button onclick="modalPedido()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Finalizar compra
                                    </button>
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title fs-5" id="staticBackdropLabel">Pedido</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body" id="modalbody">

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" id="buttonPedido" class="btn btn-danger"
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
        <script src="../js/busqueda.js"></script>
        <script src="../js/carrito.js"></script>
        <script src="../js/index.js"></script>
        <script src="../js/sumRes.js"></script>
        <script src="../js/initHF.js"></script>


</body>

</html>