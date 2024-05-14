<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/ClienteBaseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;

$cliente = new Cliente();
$header = include 'header.php';
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
<header>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Aquí se ejecutará cuando el DOM esté completamente cargado
            <?php
            // Imprime la variable de PHP usando JavaScript
            echo $header;
            ?>
         // Muestra la variable en la consola del navegador
            // Puedes manipular la variable como desees aquí en JavaScript
        });
    </script>
  </header>
  <!-- Contenedor para el encabezado -->

  <main>
    <form id="Registrar" action="<?php echo $iniRegis?>" method="POST">
    <div class="text-center">
        <?php echo $iniOregis ?>
      </div>
      <div class="mb-3">
        <label name="correoElectronico" class="form-label">Email</label>
        <input type="text" name="correoElectronico" class="form-control" value="">
      </div>
      <div class="mb-3">
        <label class="form-label"><?php echo $password ?> </label>
        <input type="<?php echo $type?>" name="documento" class="form-control" value="">
      </div>
      <div class="mb-3">
        <label class="form-label" style="<?php echo $ocultar?>">Nombre</label>
        <input type="text" name="nombre" style="<?php echo $ocultar?>" class="form-control" value="">
      </div>
      <div class="mb-3">
        <label name="telefono" style="<?php echo $ocultar?>" class="form-label">telefono</label>
        <input type="number" name="telefono" style="<?php echo $ocultar?>" class="form-control" value="" >
      </div>
      <div class="mb-3">
        <label name="correoElectronico" style="<?php echo $ocultar?>" class="form-label">direccion</label>
        <input type="text" name="direccion" class="form-control" style="<?php echo $ocultar?>" value="">
      </div>
      <div class="text-center">
        <?php   echo $tieneCuenta ?>
      </div>
      <button type="submit" class="btn btn-primary">registrar</button>
    </form>
  </main>


  <header>



  <footer id="footerSes">
    <div id="footer-container"></div>
  </footer>
  <script src="../js/sesion.js"></script>
  <script src="../js/initHF.js"></script>

</body>

</html>
