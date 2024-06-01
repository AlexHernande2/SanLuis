<?php

require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$productos = new ProductoController();
$productos = $productos->readAllProductos();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/styless.css">
    <link rel="stylesheet" href="../css/indexAdmin.css">
</head>

<body>
    <header>
        <!-- Barra de navegacion o parte principal de la imagen -->
        <!-- Abre la etiqueta de navegación con las clases de Bootstrap para un navbar -->
        <nav class="navbar   navbar-expand-md navbar-light " id="navigationBar" style="background-color: #e3f2fd;">
            <!-- Contenedor fluido para el contenido del navbar -->
            <div class="container-fluid">
                <!-- Botón del navbar para dispositivos pequeños -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <!-- Icono del botón del navbar -->
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Contenido colapsable del navbar -->
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <!-- Enlace de la marca del navbar -->
                    <a class="navbar-brand" href="./indexAdmin.php">
                        <!-- Imagen de la marca con su ruta y dimensiones -->
                        <img src="../imagenes/icono empresa.png.144x144.png" width="80" alt="logo de la empresa">
                    </a>
                    <!-- Formulario de búsqueda con un campo de entrada y un botón -->
                    <form class="d-flex flex-column position-relative" method="POST" role="search">
                        <div class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" id="buscar"
                                name="buscar" onkeyup="consulta_buscador($('#buscar').val())" aria-label="Search">
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
                            <button onclick="view_cart(<?php echo $documento ?>)" class="nav-link btn btn-link"
                                id="cartButton"><img width="30px" height="50px" src="../imagenes/cart.svg"
                                    alt=""></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <main>
        <div class="container text-center">
            <div class="row align-items-end">
                <div class="col">
                    <label for="buscar"><br></label>
                    <input class="form-control mb-2" type="search" placeholder="Buscar por categoria" id="buscar1"
                        name="buscar"
                        onkeyup="consulta_buscador_admin($('#buscar1').val(),$('#buscar2').val(),$('#buscar3').val())"
                        aria-label="Search">
                </div>
                <div class="col">
                    <label for="buscar"><br></label>
                    <input class="form-control mb-2" type="search" placeholder="Buscar por Nombre producto" id="buscar2"
                        name="buscar"
                        onkeyup="consulta_buscador_admin($('#buscar').val(),$('#buscar2').val(),$('#buscar3').val())"
                        aria-label="Search">
                </div>
                <div class="col">
                    <label for="buscar"><br></label>
                    <input class="form-control mb-2" type="search" placeholder="Buscar por Subcategoria" id="buscar3"
                        name="buscar"
                        onkeyup="consulta_buscador_admin($('#buscar').val(),$('#buscar2').val(),$('#buscar3').val())"
                        aria-label="Search">
                </div>
            </div>
        </div>


        <!-- <div class="cod-container" id="tableAgregProduc">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">tipoProducto</th>
                        <th scope="col">categoria</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>

        </div> -->

        <!--  -->
        <div style="margin-left:1%; margin-right:1%;" class="cod-container" id="tableAllProductos">
            <table id="table" class="table">
                <thead>
                    <tr style="text-align:center;">
                        <th scope="col">#</th>
                        <th scope="col">imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">categoria</th>
                        <th scope="col">tipo Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Modificar</th>
                        <th scope="col">Eliminar</th>

                    </tr>
                </thead>
                <tbody id="bodyAdmin">
                <?php
                $cont = 1;
                foreach ($productos as $producto) {
                    echo ' 
        
                    <tr style="text-align:center;">
                        <th scope="row">'.$cont.'</th>
                        <td><img style="height: 40px;" src="data:' . $producto->getExtensionImagen() . ';base64,' . base64_encode($producto->getImagen()) . '"></td>
                        <td>'.$producto->getNombre().'</td>
                        <td>'.$producto->getCantidad().'</td>
                        <td>'.$producto->getCategoria().'</td>
                        <td>'.$producto->getTipoProducto().'</td>
                        <td>'.$producto->getPrecioUnitario().'</td>
                        <td><button  class="btn btn-primary" ><img style="height: 20px;" src="../imagenes/modificarProd.png"></button></td>
                        <td><button class="btn btn-danger" ><img style="height: 20px;" src="../imagenes/modificarProd.png"></button></td>
                    </tr>';
                $cont++;
                } ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <div id="footer-container"></div>
    </footer>


    <script src="../js/busqueda.js"></script>
    <script src="../js/header.js"></script>
    <script src="../js/busqueda.js"></script>
    <script src="../js/initHF.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


</body>

</html>