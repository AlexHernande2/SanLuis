<?php
require '../../model/Cliente.php';
require '../../controller/conexionDbController.php';
require '../../controller/ClienteBaseController.php';
require '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;


session_start();

if(isset($_GET['des'])){
  unset($_SESSION['documento']);
  session_destroy();
}


if (isset($_SESSION['documento'])) {
  $documento = $_SESSION['documento'];
  $cliente = new ClienteController();
  $cliente = $cliente->readRow($documento);
  $cliente = $cliente->getNombre();
  $iniEdit = "#";
  $dropdown =
    '
  <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="index.php?des=si">Salir</a>
  </div>
  ';
  $nav = "nav-link dropdown-toggle";
} else {
  $cliente = "inicia sesion o registrate";
  $iniEdit = "formSesion.php?inicioSesion=no";
  $dropdown = "";
  $nav = "nav-link";
}


if(isset($_GET['des'])){
  session_destroy();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/styless.css">

</head>

<body>
<header>
    <?php echo var_dump($_SESSION); ?>
    <nav class="navbar navbar-expand-md navbar-light" id="navigationBar">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="index.php">
            <img src="../imagenes/icono empresa.png.144x144.png" width="80" alt="logo de la empresa">
          </a>

          <form class="d-flex flex-column position-relative" method="POST" role="search">
            <div class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" id="buscar" name="buscar"
                onkeyup="consulta_buscador($('#buscar').val())" aria-label="Search">
              <button class="btn btn-outline-success" type="submit" id="buttonSearch">Search</button>
            </div>

            <!-- card_busqueda dentro del formulario pero después de los elementos de búsqueda -->
            <div class="card_busqueda position-absolute top-100  translate-middle-x" id="card_busqueda"
              style="opacity: 0; z-index: 999; left:120px;">
              <div class="card shadow-sm p-2">
                <div class="container m-0 p-0" id="resultados_busqueda_nav">

                </div>
              </div>
            </div>
          </form>


          <ul class="navbar-nav d-flex justify-content-center align-items-center">
            <li class="nav-item">
              <img src="../imagenes/imagenUsuario.png" alt="usuario" width="50">
            </li>
            <li class="nav-item dropdown">
              <a class="<?php echo $nav ?>" id="navbarDropdown1" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" href="<?php echo $iniEdit ?>">¡Hola!
                <?php echo $cliente ?></a>
              <?php echo $dropdown ?>
            </li>
            <li class="nav-item">
              <button class="nav-link btn btn-link" id="cartButton">Carrito</button>
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