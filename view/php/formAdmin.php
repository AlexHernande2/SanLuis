<?php
require_once '../../model/Cliente.php';
require_once '../../controller/conexionDbController.php';
require_once '../../controller/ClienteBaseController.php';
require_once '../../controller/ClienteController.php';

use cliente\Cliente;
use ClienteController\ClienteController;
$adminCont = new ClienteController();

if(!empty($_POST['correoElectronico'])&& !empty($_POST['contraseña'])){
    $correo = $_POST['correoElectronico'];
    $contraseña = $_POST['contraseña'];
    $admin = $adminCont->readValidAdmin($correo,$contraseña);
if($admin){
    header('location:indexAdmin.php');
}
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
    <link rel="stylesheet" href="../css/formAdmin.css">
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
                    <form  class="d-flex flex-column position-relative" method="POST" role="search">
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
                            <!-- <a class="<?php echo $nav ?>" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?php echo $iniEdit ?>">¡Hola!
                                <?php echo $cliente ?></a>
                            <?php echo $dropdown ?> -->
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

    </header>
    <main>

        <div class="cod-container" id="divForm">
            <div class="form-header">
                <img src="../imagenes/admin.png" alt="Logo de CodigoMasters">
                <h1>Login<span>Administrador</span></h1>
            </div>

            <div class="form-content">
                <form action="formAdmin.php" method="POST" class="cod-form">
                    <div class="form-title">
                        <h3>Iniciar Sesión</h3>
                    </div>

                    <div class="input-group">
                        <input type="email" class="form-input" name="correoElectronico" id="correo">
                        <label class="label" for="correoElectronico">Correo</label>
                    </div>

                    <div class="input-group">
                        <input type="password" class="form-input" name="contraseña" id="pass">
                        <label class="label" for="contraseña">Contraseña</label>
                    </div>

                    <div class="input-group">
                        <input type="submit" class="form-input" value="Iniciar Sesión">
                    </div>

                </form>
            </div>



    </main>

    <footer>
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