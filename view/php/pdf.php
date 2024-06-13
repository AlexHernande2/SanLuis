<?php
require_once '../../vendor/autoload.php';
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$productoController = new ProductoController();


?>
<?php ob_start();?>
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
            <img style="height:80px;" src="https://imagenes.elpais.com/resizer/v2/Y3W6QUFBBZLLTALRW6NBRPZ2RA.jpg?auth=d68f18251117888479d8fdc3210796bc86d9d3f41719da72c2877bcafc3504ea&width=414" alt="Company Logo">
            <div style="margin-left:30%; margin-top:-18%;" class="company-details">
                <h1>Distribuidora San Luis</h1>
                <p>Dirección: cra. 15 #18-68, Tunja, boyaca</p>
                <p>CONTACTO:3108108175</p>
            </div>
        </div>
        <div class="invoice-details">
            <p><strong>CLIENTE:</strong> Publico en general</p>
            <p><strong>FOLIO:</strong> 535</p>
            <p><strong>FECHA:</strong> 04/02/23</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>P/U</th>
                  
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Atún dorado agua</td>
                    <td>3</td>
                    <td>$ 12.00</td>
                    
                </tr>
            </tbody>
        </table>
        <div class="total">
            <p><strong>TOTAL</strong> $ 334.00</p>
        </div>
        <div class="footer">
            <p>Este no es un comprobante fiscal</p>
        </div>
    </div>
</body>
</html>
<?php $html = ob_get_clean();?>

<?php
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$pdfContent = $mpdf->Output('', 'S');
// $pdf = $productoController->pdf($pdfContent);

?>