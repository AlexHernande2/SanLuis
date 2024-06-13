<?php
require '../../model/Producto.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';
require '../../controller/ProCaBaseController.php';
require '../../controller/ProCaController.php';
require '../../controller/DetallePedController.php';
require_once '../../vendor/autoload.php';

use detallePedController\DetallePedController;
use proCaController\ProCaController;

use producto\Producto;
use productoController\ProductoController;

$productoController = new ProductoController();

session_start();
$documentoCuenta = $_SESSION["documento"];

$correo = $_POST['correoElectronico'];
$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$date = date('d-m-Y');
$proCa = new proCaController();
$productos = $proCa->ReadPro($documentoCuenta);
?>


<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="../css/tablaProd.css">
</head>

<body>
    <div class="invoice">
        <div class="header">
            <img style="height:80px;"
                src="https://imagenes.elpais.com/resizer/v2/Y3W6QUFBBZLLTALRW6NBRPZ2RA.jpg?auth=d68f18251117888479d8fdc3210796bc86d9d3f41719da72c2877bcafc3504ea&width=414"
                alt="Company Logo">
            <div style="margin-left:30%; margin-top:-18%;" class="company-details">
                <h1>Distribuidora San Luis</h1>
                <p>Dirección: cra. 15 #18-68, Tunja, boyaca</p>
                <p>CONTACTO:3108108175</p>
            </div>
        </div>
        <div class="invoice-details">
            <p><strong>CLIENTE:</strong> <?php echo $nombre ?></p>
            <p><strong>CONTACTO:</strong> <?php echo $telefono ?></p>
            <p><strong>FECHA:</strong> <?php echo $date?></p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>P/U</th>
                    <th>P/T</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contadorSiProd = 0;
                $totalProds = 0;
                foreach ($productos as $producto) {
                    if ($producto->getCantidad() != 0) {
                        $cantTotProd = $producto->getPrecioUnitario() * $producto->getCantidad();
                        echo '<tr>';
                        echo '<td>' . $producto->getNombre() . '</td>';
                        echo '<td>' . $producto->getCantidad() . '</td>';
                        echo '<td>' . $producto->getPrecioUnitario() . '</td>';
                        echo '<td>' . $cantTotProd. '</td>';
                        echo '</tr>';
                        $contadorSiProd++;
                         $totalProds += $cantTotProd;
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="total">
            <p><strong>TOTAL</strong> <?php echo $totalProds.' COP'?></p>
        </div>
        <div class="footer">
            <p>Este no es un comprobante fiscal</p>
        </div>
    </div>
</body>

</html>

<?php $html = ob_get_clean(); ?>

<?php
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$pdfContent = $mpdf->Output('', 'S');
$pdf = $productoController->pdf($pdfContent);

?>




<?php


if ($contadorSiProd == 0) {
    $noProd = "noProductos";
    echo $noProd;
} else if (empty($correo) || empty($documento) || empty($nombre) || empty($telefono) || empty($direccion)) {
    $noData = "no datos";
    echo $noData;
} else {
    $proCa = $proCa->deleteCartProds($documentoCuenta);
    echo 'https://wa.me/573108108175?text=Pedido%20entrante%20de%20'.$nombre.'%3A%20http%3A%2F%2Flocalhost%2FSanLuis%2Fview%2Fphp%2Fmostrarpdf.php%3Fid%3D
' . $pdf . '';
}
?>