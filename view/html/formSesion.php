<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/baseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;
$cliente = new Cliente();
$inicioSesion = $_GET['inicioSesion'];
if($inicioSesion == "si"){
  $iniRegis = "registroCliente.php?inicioSes=si&";
  $iniOregis = "INICIAR SESION";
  $tieneCuenta = 'no tienes cuenta <a href="formSesion.php?inicioSesion=no">registrate</a>';
  $ocultar = "display: none;";
  $password = "Contraseña";
  $type = "password";
}else{
  $iniRegis = "registroCliente.php?inicioSes=no&";
  $iniOregis = "REGISTRO";
  $tieneCuenta = 'ya tienes cuenta?<a href="formSesion.php?inicioSesion=si">inicia sesion</a>';
  $ocultar = "";
  $password = "Documento";
  $type = "Number";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/sesion.css">
  <link rel>
</head>

<body>

  <!-- Contenedor para el encabezado -->
  <header>
    <div id="header-container"></div>
  </header>

  <main>
    <form id="Registrar" action="<?php echo $iniRegis?>" method="POST">
    <div class="text-center">
        <?php echo $iniOregis ?>
      </div>
      <div class="mb-3">
        <label name="correoElectronico" class="form-label">Email</label>
        <input type="text" name="correoElectronico" class="form-control" value="<?php $cliente->getCorreoElectronico()?>">
      </div>
      <div class="mb-3">
        <label class="form-label"><?php echo $password ?> </label>
        <input type="<?php echo $type?>" name="documento" class="form-control" value="<?php $cliente->getDocumento()?>">
      </div>
      <div class="mb-3">
        <label class="form-label" style="<?php echo $ocultar?>">Nombre</label>
        <input type="text" name="nombre" style="<?php echo $ocultar?>" class="form-control" value="<?php $cliente->getNombre()?>">
      </div>
      <div class="mb-3">
        <label name="telefono" style="<?php echo $ocultar?>" class="form-label">telefono</label>
        <input type="number" name="telefono" style="<?php echo $ocultar?>" class="form-control" value="<?php $cliente->getTelefono()?>" >
      </div>
      <div class="mb-3">
        <label name="correoElectronico" style="<?php echo $ocultar?>" class="form-label">direccion</label>
        <input type="text" name="direccion" class="form-control" style="<?php echo $ocultar?>" value="<?php $cliente->getDireccion()?>">
      </div>
      <div class="text-center">
        <?php   echo $tieneCuenta ?>
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
