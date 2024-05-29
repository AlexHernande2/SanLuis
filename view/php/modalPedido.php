<?php
require '../../model/Producto.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';
require '../../controller/ProCaBaseController.php';
require '../../controller/ProCaController.php';
require '../../controller/DetallePedController.php';


use detallePedController\DetallePedController;
use proCaController\ProCaController;

session_start();
$documentoCuenta = $_SESSION["documento"];

$correo = $_POST['correoElectronico'];
$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$date = date('Y-m-d');

$proCa = new proCaController();
$productos = $proCa->ReadPro($documentoCuenta);
$detallePed = new detallePedController();
$detallePed = $detallePed->asigDetPed($documentoCuenta,$date,$productos,$documento);

$dataPed = "Nombre:".$nombre;
$dataPed .= "\n". 'documento'."\n".'correoElectronico:'.$correo;
$dataPed .= "\n".'| PRODUCTO |'.' | PRECIO UNITARIO |'.'| CANTIDAD |'.'| TOTAL |';
foreach ($productos as $producto){
 $cantidad = $producto->getCantidad();
$precioUnitario = $producto->getPrecioUnitario();
$precioTotal = $cantidad*$precioUnitario;
 $dataPed .= "\n".$producto->getNombre().'                  '.$producto->getPrecioUnitario();
 $dataPed .= '                            '.$producto->getCantidad().'          '.$precioTotal;
}



$encode = urlencode($dataPed);
echo 'https://wa.me/573108108175?text='.$encode;


;

