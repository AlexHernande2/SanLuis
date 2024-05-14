<?php
require_once '../../model/Cliente.php';
require_once '../../controller/conexionDbController.php';
require_once '../../controller/ClienteBaseController.php';
require_once '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;

session_start();

if (isset($_GET['des'])) {
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


if (isset($_GET['des'])) {
  session_destroy();
  header('Location:index.php');
}else{

}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Se utiliza para que se ajuste al contenido de la página -->
  <title>Headerpagina</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/styless.css">

  <style>
    /* Estilos para el menú lateral */
    .sidebar {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      right: 0;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidebar a {
      padding: 10px 15px;
      text-decoration: none;
      font-size: 25px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }

    .sidebar a:hover {
      color: #f1f1f1;
    }

    .sidebar .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }
  </style>

</head>

<body>
  <header>
    <?php echo var_dump($_SESSION); ?>

    <!-- Abre la etiqueta de navegación con las clases de Bootstrap para un navbar -->
    <nav class="navbar navbar-expand-md navbar-light" id="navigationBar">
      <!-- Contenedor fluido para el contenido del navbar -->
      <div class="container-fluid">
        <!-- Botón del navbar para dispositivos pequeños -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <!-- Icono del botón del navbar -->
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Contenido colapsable del navbar -->
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <!-- Enlace de la marca del navbar -->
          <a class="navbar-brand" href="index.php">
            <!-- Imagen de la marca con su ruta y dimensiones -->
            <img src="../imagenes/icono empresa.png.144x144.png" width="80" alt="logo de la empresa">
          </a>
          <!-- Formulario de búsqueda con un campo de entrada y un botón -->
          <form class="d-flex flex-column position-relative" method="POST" role="search">
            <div class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" id="buscar" name="buscar" onkeyup="consulta_buscador($('#buscar').val())" aria-label="Search">
              <button class="btn btn-outline-success" type="submit" id="buttonSearch">Search</button>
            </div>

            <!-- card_busqueda dentro del formulario pero después de los elementos de búsqueda -->
            <div class="card_busqueda position-absolute top-100  translate-middle-x" id="card_busqueda" style="opacity: 0; z-index: 999; left:120px;">
              <div class="card shadow-sm p-2">
                <div class="container m-0 p-0" id="resultados_busqueda_nav">

                </div>
              </div>
            </div>
          </form>


          <!-- Lista de elementos de navegación del navbar -->
          <ul class="navbar-nav d-flex justify-content-center align-items-center">
            <!-- Elemento de navegación para mostrar la imagen del usuario -->
            <li class="nav-item">
              <!-- Imagen del usuario con su ruta y dimensiones -->
              <img src="../imagenes/imagenUsuario.png" alt="usuario" width="50">
            </li>
            <!-- Elemento de navegación para mostrar el nombre del usuario -->
            <li class="nav-item dropdown">
              <a class="<?php echo $nav ?>" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?php echo $iniEdit ?>">¡Hola!
                <?php echo $cliente ?></a>
              <?php echo $dropdown ?>
            </li>
            <!-- Elemento de navegación para el carrito -->
            <li class="nav-item">
              <!-- Botón para abrir el carrito -->
              <button class="nav-link btn btn-link" id="cartButton">Carrito</button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--  -->

    <!-- Barra de las categorias -->
    <nav class="navbar navbar-expand-lg  " id="menuDesplegable">
      <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Todas las categorias
            </a>
            <ul class="dropdown-menu dropdown-menu-scroll">
              <li><a class="dropdown-item" href="index.php">Inicio</a></li>
              <li><a class="dropdown-header ">Comida</a></li>
              <li><a class="dropdown-item" href="./vegetales.html">Vegetales</a></li>
              <li><a class="dropdown-item" href="./vegetales.php?tipoProducto=vegetales">Vegetales</a></li>
              <li><a class="dropdown-item" href="./fruta.html">Fruta</a></li>
              <li><a class="dropdown-item" href="./carnes.html">Carne y Aves</a></li>
              <li><a class="dropdown-item" href="./lacteos.html">Lácteos y Huevos </a></li>
              <li><a class="dropdown-item" href="./panaderia.html">Panadería</a></li>
              <li><a class="dropdown-item" href="./pastas.html">Pasta y Granos</a></li>
              <li><a class="dropdown-item" href="./vegetales.php?tipoProducto=cereales">Cereales</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>
              <li> <a class="dropdown-header ">Bebidas</a></li>
              <li><a class="dropdown-item" href="#">Té</a></li>
              <li><a class="dropdown-item" href="#">Café</a></li>
              <li><a class="dropdown-item" href="#">Bebidas sin Alcohol</a></li>
              <li><a class="dropdown-item" href="#">Cerveza</a></li>
              <li><a class="dropdown-item" href="#">Vino</a></li>
              <li>
                <!-- Divide parte del menu  -->
                <hr class="dropdown-divider">
              </li>
              <li> <a class="dropdown-header ">Limpieza y Hogar</a></li>
              <li><a class="dropdown-item" href="#">Casa y Cocina</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li> <a class="dropdown-header ">Cuidado Personal</a></li>
              <li><a class="dropdown-item" href="#">Higiene Personal</a></li>
              <li><a class="dropdown-item" href="#">Productos para Bebes</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>




    <!--  -->

    <!-- Menú lateral -->
    <div class="sidebar" id="mySidebar">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <a href="#">Producto 1</a>
      <a href="#">Producto 2</a>
      <a href="#">Producto 3</a>
      <!-- Puedes agregar más elementos aquí -->
    </div>
  </header>



  <script src="../js/header.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../js/busqueda.js"></script>


</body>

</html>