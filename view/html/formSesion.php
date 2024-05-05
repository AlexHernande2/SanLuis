<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/baseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;
$cliente = new Cliente();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/sesion.css">
</head>

<body>

  <!-- Contenedor para el encabezado -->
  <header>
    <div id="header-container"></div>
  </header>

  <main>
    <form id="Registrar" action="registroCliente.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Documento</label>
        <input type="number" name="documento" class="form-control" value="<?php $cliente->getDocumento()?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?php $cliente->getNombre()?>">
      </div>
      <div class="mb-3">
        <label name="telefono" class="form-label">telefono</label>
        <input type="number" name="telefono" class="form-control" value="<?php $cliente->getTelefono()?>" >
      </div>
      <div class="mb-3">
        <label name="correoElectronico" class="form-label">Email</label>
        <input type="text" name="correoElectronico" class="form-control" value="<?php $cliente->getCorreoElectronico()?>">
      </div>
      <div class="mb-3">
        <label name="correoElectronico" class="form-label">direccion</label>
        <input type="text" name="direccion" class="form-control" value="<?php $cliente->getDireccion()?>">
      </div>
      <button type="submit" class="btn btn-primary">registrar</button>
    </form>
  </main>





  <footer>
    <div id="footer-container"></div>
  </footer>
  <script src="../js/sesion.js"></script>



</body>

</html>
