<?php
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$producController = new ProductoController();
$productos = $producController->readAllProductos();

if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $tipoProducto = $_POST['tipoProducto'];
    $categoria = $_POST['categoria'];
    $precioUnitario = $_POST['precioUnitario'];

    $nombreArchivo = $_FILES['imagen']['name'];
    $tipoArchivo = $_FILES['imagen']['type'];
    $tamanoArchivo = $_FILES['imagen']['size'];
    $imagenSubida = fopen($_FILES['imagen']['tmp_name'], 'r');
    $imagenProducto = fread($imagenSubida, $tamanoArchivo);

    $productoAdd = $producController->createProducto($nombre, $cantidad, $tipoProducto, $categoria, $precioUnitario, $imagenProducto);
    if ($productoAdd) {

        echo "<script><alert('agregado con exito')</script>";
        header("Refresh:1; url=indexAdmin.php");

    } else {
        echo '<h1>credenciales no validas para registrar usuario</h1>';
    }
}
