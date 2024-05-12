<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/ClienteBaseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;

session_start();

if (isset($_SESSION['documento'])) {
  $documento = $_SESSION['documento'];
  $cliente = new ClienteController();
  $cliente = $cliente->readRow($documento);
  $cliente = $cliente->getNombre();
  $iniEdit = "editarCliente.php";
} else {
  $cliente = "inicia sesion o registrate";
  $iniEdit = "formSesion.php?inicioSesion=no";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>