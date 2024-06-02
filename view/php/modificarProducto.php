<?php
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$id = $_GET['id'];
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$cantidad = $_POST['cantidad'];
$tipoProducto = $_POST['tipoProducto'];
$precioUnitario = $_POST['precioUnitario'];

if(!empty($_FILES['imagen']['name'])){
$nombreArchivo = $_FILES['imagen']['name'];
$tipoArchivo = $_FILES['imagen']['type'];
$tamanoArchivo = $_FILES['imagen']['size'];
$imagenSubida = fopen($_FILES['imagen']['tmp_name'], 'r');
$imagenProducto = fread($imagenSubida, $tamanoArchivo);
}else{
    $imagenProducto="";
}
$producController = new ProductoController();
$productos = $producController->updateProducto($id,$nombre,$cantidad,$tipoProducto,$categoria,$precioUnitario,$imagenProducto);

if ($productos) {
    echo "<script>alert('modificacion exitosa')</script>";
    header("refresh:0.5; url=indexAdmin.php");
}