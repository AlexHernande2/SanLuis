<?php
include 'header.php';
require '../../model/Producto.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';
require '../../controller/ProCaBaseController.php';
require '../../controller/ProCaController.php';


use proCaController\ProCaController;

//leer productos para mostrarlos al hacer click en el icono del carrito
if (!isset($documento)) {
    $proCa = new proCaController();
    $proEnCarrito = $proCa->ReadPro($documento);
}
var_dump(isset($documento));
//se muestran todos los productos que se encuentran en el carrito del cliente

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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acción</th>
                    <th scope="col">Total <?php $holaaa ?></th>
                </tr>
            </thead>
            <tbody id="items">
                <?php
                if (!isset($documento)) {
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

                }else{
                    echo '<tfoot>
                    <tr id="footer">
                        <th scope="row" colspan="5">Carrito vacío - comience a comprar!</th>
                    </tr>
                </tfoot>';
                } ?>
            </tbody>
        </table>



        <footer>
            <div style="margin-left:-25%;margin-right: -15.25%;" id="footer-container"></div>
        </footer>


        <script src="../js/carrito.js"></script>
        <script src="../js/index.js"></script>
        <script>
            const $dropdown = $(".dropdown");
            const $dropdownToggle = $(".dropdown-toggle");
            const $dropdownMenu = $(".dropdown-menu");
            const showClass = "show";
            $(window).on("load resize", function () {
                if (this.matchMedia("(min-width: 768px)").matches) {
                    $dropdown.hover(
                        function () {
                            const $this = $(this);
                            $this.addClass(showClass);
                            $this.find($dropdownToggle).attr("aria-expanded", "true");
                            $this.find($dropdownMenu).addClass(showClass);
                        },
                        function () {
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
        </script>
</body>

</html>