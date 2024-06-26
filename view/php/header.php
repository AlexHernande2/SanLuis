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
// <a class="dropdown-item" href="../php/pedido.php">Pedido</a>
// <a class="dropdown-item" href="formSesion.php">Editar</a>
if (isset($_SESSION['documento'])) {
  $documento = $_SESSION['documento'];
  $cliente = new ClienteController();
  $Cliente = $cliente->readRow($documento);
  $cliente = $Cliente->getNombre();
  $iniEdit = "#";
  $dropdown =
    '
  <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
   
  
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="index.php?des=si">Salir</a>
  </div>
  ';
  $nav = "nav-link dropdown-toggle";
} else {
  $documento = "";
  $cliente = "inicia sesion o registrate";
  $Cliente = new Cliente();
  $iniEdit = "formSesion.php?inicioSesion=no";
  $dropdown = "";
  $nav = "nav-link";
}


if (isset($_GET['des'])) {
  session_destroy();
  header('Location:index.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Se utiliza para que se ajuste al contenido de la página -->
  <title>Headerpagina</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/styless.css">
  <link rel="stylesheet" href="../css/header.css">

  
</head>
<body>

  <header>
    <!-- Barra de navegacion o parte principal de la imagen -->
    <!-- Abre la etiqueta de navegación con las clases de Bootstrap para un navbar -->
    <nav class="navbar navbar-expand-md navbar-light " id="navigationBar">
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
            <li class="nav-item space-right">
              <!-- Imagen del usuario con su ruta y dimensiones -->
              <img src="../imagenes/imagenUsuario.png" alt="usuario" width="50">
            </li>

            <!-- Elemento de navegación para mostrar el nombre del usuario -->
            <li class="nav-item dropdown" id="navSaludousuario">
              <a class="<?php echo $nav ?>" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?php echo $iniEdit ?>">¡Hola!
                <?php echo $cliente ?></a>
              <?php echo $dropdown ?>
            </li>
            <!-- Elemento de navegación para el carrito -->
            <li class="nav-item">
              <!-- Botón para abrir el carrito -->
              <button onclick="view_cart(<?php echo $documento ?>)" class="nav-link btn btn-link" id="cartButton"><img width="30px" height="50px" src="../imagenes/cart.svg" alt=""></button>
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
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=vegetales">Vegetales</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=fruta">Fruta</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=carnes y aves">Carne y Aves</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=lacteos y huevos">Lácteos y Huevos </a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=panaderia">Panadería</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=pastas">Pasta y Granos</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=cereales">Cereales</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>
              <li> <a class="dropdown-header ">Bebidas</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=Té">Té</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=Cafe">Café</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=bebidas sin alcohol">Bebidas sin Alcohol</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=Cerveza">Cerveza</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=Vino">Vino</a></li>
              <li>
                <!-- Divide parte del menu  -->
                <hr class="dropdown-divider">
              </li>
              <li> <a class="dropdown-header ">Limpieza y Hogar</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=Casa y Cocina">Casa y Cocina</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li> <a class="dropdown-header ">Cuidado Personal</a></li>
              <li><a class="dropdown-item" href="./productos.php?tipoProducto=Higiene Personal">Higiene Personal</a></li>
              <li><a class="dropdown-item" href="#">Productos para Bebes</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>




    <!--  -->

    <!-- Menú lateral -->
    <div class="sidebar" style=" scrollbar-width: none;"id="mySidebar">
      <a href="javascript:void(0)" class="closebtn">×</a>
      <table class="table">
        <thead>
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Valor unit</th>
              <th scope="col">Valor total</th>
              <th scope="col">quitar</th>
              <th scope="col">agregar</th>
              <th scope="col"></th>
         
            </tr>
          </thead>
        </thead>
        <tbody id="itemsAgMosCarrito1">

        </tbody>
        <tfoot>
          <tr id="footer">

            <th scope="row" colspan="5">

              <a href="../php/carrito.php" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ir al carrito</a>
          </tr>
        </tfoot>
      </table>


      <!-- Puedes agregar más elementos aquí -->
    </div>
  </header>

 
  <script src="../js/busqueda.js"></script>
  <script src="../js/header.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../js/sumRes.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>