<?php 
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/ClienteBaseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;
session_start();

if(isset($_SESSION['documento'])){
  $documento = $_SESSION['documento'];
  $cliente = new ClienteController();
  $cliente = $cliente->readRow($documento);
  $cliente = $cliente->getNombre() ;
  $iniEdit = "editarCliente.php";
}else{
  $cliente = "inicia sesion o registrate";
  $iniEdit = "formSesion.php?inicioSesion=no";
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Se utiliza para que se ajuste al conenido de la pagina  -->
  <title>Headerpagina</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styless.css">

</head>

<body>
  <header>


    <nav class="navbar navbar-expand-md navbar-light" id="navigationBar">
      <!-- contenedor que se ajusta al 100% del ancho -->
      <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="index.php">
            <img src="../imagenes/icono empresa.png.144x144.png" width="80" alt="logo de la empresa">
          </a>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" id="buttonSearch">Search</button>
          </form>
          <ul class="navbar-nav d-flex justify-content-center align-items-center">
            <li class="nav-item">
              <img src="../imagenes/imagenUsuario.png" alt="usuario" width="50">
            
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $iniEdit?>">¡Hola! <?php echo $cliente ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../html/carrito.html">Carrito</a>
            </li>
          </ul>
         
        </div>
      </div>
    </nav>

  </header>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>