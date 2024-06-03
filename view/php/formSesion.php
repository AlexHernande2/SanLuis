<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/ClienteBaseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;

$cliente = new Cliente();

if (empty($documento)) {
  $inicioSesion = $_GET['inicioSesion'];
  if ($inicioSesion == "si") {
    $iniRegis = "registroCliente.php?inicioSes=si";
    $iniOregis = "INICIAR SESION";
    $btn = "iniciar sesion";
    $tieneCuenta = 'no tienes cuenta <a href="formSesion.php?inicioSesion=no" id="linkRegistro"  >registrate</a>';
    $ocultar = "display: none;";
    $password = "Contraseña";
    $type = "password";
    $required = "";
  } else {
    $iniRegis = "registroCliente.php?inicioSes=no";
    $iniOregis = "REGISTRO";
    $btn = "Registrar";
    $tieneCuenta = 'ya tienes cuenta?<a href="formSesion.php?inicioSesion=si" id="linkInicio"  >inicia sesion</a>';
    $ocultar = "";
    $password = "Documento";
    $type = "Number";
    $required = "required";
  }
} else {
  $iniOregis = "EDITAR CAMPOS";
  $tieneCuenta = '';
  $password = "Documento";
  $btn = "Editar campos";
  var_dump(empty($documento));
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/styless.css">
  <link rel="stylesheet" href="../css/formSesion.css">
</head>

<body>
  <header>
    <?php include 'header.php'; ?>
  </header>
  
  <main>
    <div class="cod-container" id="divForm">
      <div class="form-header">
        <img src="../imagenes/admin.png" alt="Logo de CodigoMasters">
      </div>

      <div class="form-content">
        <form id="Registrar" action="<?php echo $iniRegis ?>" method="POST" class="cod-form">
          <div class="form-title">
            <h3><?php echo $iniOregis ?></h3>
          </div>

          <div class="input-group">
            <input type="email" required name="correoElectronico" class="form-input" id="correo" placeholder="Email">
           
          </div>

          <div class="input-group">
            <input type="<?php echo $type ?>" required name="documento" class="form-input" id="documento" placeholder="<?php echo $password ?>" min="0">
           
          </div>

          <div class="input-group" style="<?php echo $ocultar ?>">
            <input type="text" name="nombre" <?php echo $required ?> class="form-input" id="nombre" placeholder="Nombre">
            
          </div>

          <div class="input-group" style="<?php echo $ocultar ?>">
            <input type="number" name="telefono" <?php echo $required ?> class="form-input" id="telefono" placeholder="Teléfono" min="0">
          </div>

          <div class="input-group" style="<?php echo $ocultar ?>">
            <input type="text" <?php echo $required ?> name="direccion" class="form-input" id="direccion" placeholder="Dirección">
        
          </div>

          <div class="text-center">
            <?php echo $tieneCuenta ?>
          </div>

          <div class="text-center">Eres admin
            <a href="../php/formAdmin.php">Inicia sesión</a>
          </div>

          <div class="d-flex justify-content-center" id="divBoton">
            <input type="submit" class="form-input" value="<?php echo $btn ?>">
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer id="footerSes">
    <div id="footer-container"></div>
  </footer>

  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/busqueda.js"></script>
  <script src="../js/header.js"></script>
  <script src="../js/formAdmin.js"></script>
  <script src="../js/initHF.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
