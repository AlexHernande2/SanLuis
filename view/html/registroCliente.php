<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/baseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;


$index = "index.php";
$inicioSesion = $_GET["inicioSes"];
if ($inicioSesion == "si") {
    $documento = $_POST["documento"];
    $correoElectronico = $_POST["correoElectronico"];
    $ClienteController = new ClienteController();
    $resultado = $ClienteController->readClienteValid($documento, $correoElectronico);
} else {
    $Cliente = new Cliente();
    $Cliente->setDocumento($_POST['documento']);
    $Cliente->setNombre($_POST['nombre']);
    $Cliente->setTelefono($_POST['telefono']);
    $Cliente->setCorreoElectronico($_POST['correoElectronico']);
    $Cliente->setdireccion($_POST['direccion']);

    $ClienteController = new ClienteController();
    $resultado = $ClienteController->create($Cliente);
    if ($resultado) {
        echo '<h1>Cliente registrado</h1>';
    } else {
        echo '<h1>No se pudo registrar el Cliente</h1>';
    }
    echo '<a href="../index.php">Volver al inicio</a>';
}