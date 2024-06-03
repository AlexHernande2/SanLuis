<?php
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$id = $_GET['id']; 

$productoController = new ProductoController();
$result = $productoController->delete($id);

if ($result) {

    echo "<script>alert('modificacion exitosa')</script>";
    header("refresh:0.5; url=indexAdmin.php");
} else {
    // Redirige a la página de productos o mostrar un mensaje de error
    echo "<script>alert('modificacion No exitosa')</script>";
    header("refresh:0.5; url=indexAdmin.php");
}
?>
