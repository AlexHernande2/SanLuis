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
  } else {
    $iniRegis = "registroCliente.php?inicioSes=no";
    $iniOregis = "REGISTRO";
    $btn = "Registrar";
    $tieneCuenta = 'ya tienes cuenta?<a href="formSesion.php?inicioSesion=si" id="linkInicio"  >inicia sesion</a>';
    $ocultar = "";
    $password = "Documento";
    $type = "Number";
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
  <!-- Define el conjunto de caracteres como UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Establece el viewport para que el diseño sea responsive -->
  <title>Document</title>
  <!-- Título de la página -->
  <link rel="stylesheet" href="../css/sesion.css">
  <link rel="stylesheet" href="../css/formSesion.css">
  <!-- Enlace a la hoja de estilo CSS personalizada -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Enlace a la hoja de estilo de Bootstrap -->
</head>

<body>
  <header>
  <?php include 'header.php' ; ?>
  </header>
  <!-- Contenedor para el encabezado -->

  <main>
    <div class="container" id="formularioDiv">
      <!-- Contenedor Bootstrap con ID "f" -->
      <form id="Registrar" action="<?php echo $iniRegis ?>" method="POST">
        <!-- Formulario con ID "Registrar" que usa el método POST y una acción dinámica -->
        <div class="text-center">
          <!-- Div centrado con texto dinámico -->
          <?php echo $iniOregis ?>
        </div>
        <div class="mb-3">
          <!-- Grupo de formulario con margen inferior -->
          <label name="correoElectronico" class="form-label">Email</label>
          <!-- Etiqueta del campo de correo electrónico -->
          <input type="text" name="correoElectronico" class="form-control" value="">
          <!-- Campo de entrada de texto para el correo electrónico -->
        </div>
        <div class="mb-3">
          <!-- Grupo de formulario con margen inferior -->
          <label class="form-label"><?php echo $password ?></label>
          <!-- Etiqueta del campo de contraseña con texto dinámico -->
          <input type="<?php echo $type ?>" name="documento" class="form-control" value="" >
          <!-- Campo de entrada de texto para el documento con tipo dinámico -->
        </div>
        <div class="mb-3">
          <!-- Grupo de formulario con margen inferior -->
          <label class="form-label" style="<?php echo $ocultar ?>">Nombre</label>
          <!-- Etiqueta del campo de nombre con estilo dinámico -->
          <input type="text" name="nombre" style="<?php echo $ocultar ?>" class="form-control" value="" >
          <!-- Campo de entrada de texto para el nombre con estilo dinámico -->
        </div>
        <div class="mb-3">
          <!-- Grupo de formulario con margen inferior -->
          <label name="telefono" style="<?php echo $ocultar ?>" class="form-label">Teléfono</label>
          <!-- Etiqueta del campo de teléfono con estilo dinámico -->
          <input type="number" name="telefono" style="<?php echo $ocultar ?>" class="form-control" value="" >
          <!-- Campo de entrada de número para el teléfono con estilo dinámico -->
        </div>
        <div class="mb-3">
          <!-- Grupo de formulario con margen inferior -->
          <label class="label" name="correoElectronico" style="<?php echo $ocultar ?>" class="form-label">Dirección</label>
          <!-- Etiqueta del campo de dirección con estilo dinámico -->
          <input type="text" name="direccion" class="form-control" style="<?php echo $ocultar ?>" value="">
          <!-- Campo de entrada de texto para la dirección con estilo dinámico -->
        </div>
        <div class="text-center">
          <!-- Div centrado con texto dinámico -->
          <?php echo $tieneCuenta ?>
        </div>
        <div class="d-flex justify-content-center" id="divBoton">
          <button type="submit" class="btn btn-success" ><?php echo $btn ?></button>
          <!-- Botón de envío del formulario -->
        </div>
      </form>
    </div>
  </main>



  <footer id="footerSes">
    <div id="footer-container"></div>
  </footer>
  <script src="../js/sesion.js"></script>
  <script src="../js/initHF.js"></script>

</body>

</html>