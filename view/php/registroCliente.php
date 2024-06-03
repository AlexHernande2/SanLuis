<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/ClienteBaseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;


$index = "index.php";
$inicioSesion = $_GET["inicioSes"];
if ($inicioSesion == "si") {
    $documento = $_POST["documento"];
    $CorreoElectronico = $_POST["correoElectronico"];
    $ClienteController = new ClienteController();
    $resultado = $ClienteController->readClienteValid($documento, $CorreoElectronico);

    if ($resultado == true) {
        echo '<h1>inicio de sesion exitoso</h1>';
    } else {
        echo '<script>alert("No se pudo iniciar sesión dato erróneos");</script>';
    }
    echo '<a href="index.php">Volver al inicio</a>';
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
        echo '<h1>usuario registrado</h1>';
        header('Refresh: 1; URL=formSesion.php?inicioSesion=no');  
    } else {
        echo '<script>alert("Credenciales no válidas, por favor inténtelo de nuevo.");</script>';
        header('Refresh: 1; URL=formSesion.php?inicioSesion=no');
    }
  
}