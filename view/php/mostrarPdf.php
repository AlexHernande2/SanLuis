<?php
require_once '../../vendor/autoload.php';
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$productoController = new ProductoController();
$id = $_GET['id'];
$pdf = $productoController->readPdf($id);


header('Content-Type: application/pdf');
echo $pdf;

