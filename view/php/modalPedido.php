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

echo 'pedido realizado con exito';


;

