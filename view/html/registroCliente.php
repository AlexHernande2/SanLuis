<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/baseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;
var_dump($_POST) ;
$null = "null";
$Cliente = new Cliente();
$Cliente->setDocumento($_POST['documento']);
$Cliente->setNombre($_POST['nombre']);
$Cliente->setTelefono($_POST['telefono']);
$Cliente->setCorreoElectronico($_POST['correoElectronico']);


$ClienteController = new ClienteController();
$resultado = $ClienteController->create($Cliente);
if ($resultado) {
    echo '<h1>Cliente registrado</h1>';
} else {
    echo '<h1>No se pudo registrar el Cliente</h1>';
}
echo '<a href="../index.php">Volver al inicio</a>';