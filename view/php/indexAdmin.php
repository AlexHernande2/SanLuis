<?php

require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';  

use producto\Producto;
use productoController\ProductoController;

$producController = new ProductoController();
$productos = $producController->readAllProductos();


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

        <nav id="navbar-example2" class="navbar bg-body-tertiary px-3 mb-3 fixed-top">
            <a class="navbar-brand" href="#">Navegacion</a>
            <l class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading1">Modificar o Eliminar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading2">Agregar Producto</a>
                </li>

                </ul>
        </nav>
    </header>

    <main>

        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
            data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
            <h4 id="scrollspyHeading1">Modificar o Eliminar
                sdas
            </h4>
            <h1 style=" text-align: center; padding:10px;margin-top: 25px;">Modficar o Eliminar</h1>
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
                        <input class="form-control mb-2" type="search" placeholder="Buscar por Nombre producto"
                            id="buscar2" name="buscar"
                            onkeyup="consulta_buscador_admin($('#buscar').val(),$('#buscar2').val(),$('#buscar3').val())"
                            aria-label="Search">
                    </div>
                    <div class="col">
                        <label for="buscar"><br></label>
                        <input class="form-control mb-2" type="search" placeholder="Buscar por Subcategoria"
                            id="buscar3" name="buscar"
                            onkeyup="consulta_buscador_admin($('#buscar').val(),$('#buscar2').val(),$('#buscar3').val())"
                            aria-label="Search">
                    </div>
                </div>
            </div>

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
                        <th scope="row">' . $cont . '</th>
                        <td><img style="height: 40px;" src="data:;base64,' . base64_encode($producto->getImagen()) . '"></td>
                        <td>' . $producto->getNombre() . '</td>
                        <td>' . $producto->getCantidad() . '</td>
                        <td>' . $producto->getCategoria() . '</td>
                        <td>' . $producto->getTipoProducto() . '</td>
                        <td>' . $producto->getPrecioUnitario() . '</td>
                        <td><button data-bs-toggle="modal" data-bs-target="#myModal" onclick=modalModificarProd(' . $producto->getId() . ',"si") class="btn btn-primary" ><img style="height: 20px;" src="../imagenes/modificarProd.png"></button></td>
                        <td><button data-bs-toggle="modal" data-bs-target="#myModal" onclick=modalModificarProd(' . $producto->getId() . ',"no") class="btn btn-danger" ><img style="height: 20px;" src="../imagenes/modificarProd.png"></button></td>
                    </tr>';
                            $cont++;
                        } ?>
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">PRODUCTO</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body" id="modalbodyAdmin">

                                    </div>

                                    <!-- Modal footer -->
                                    <div id="modEl" class="modal-footer">

                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </tbody>
                </table>
            </div>

            <h4 id="scrollspyHeading2"></h4>
            <h1 style=" text-align: center;">AGREGAR PRODUCTO</h1>
              
            <form action="agregarProd.php" method="POST" enctype="multipart/form-data" class="container py-4">
                <div class="row mb-3">
                    <div class="col">
                        <input name="nombre" type="text" class="form-control" placeholder="Nombre del producto"
                            aria-label="Nombre">
                    </div>
                    <div class="col">
                        <input name="cantidad" type="number" class="form-control" placeholder="Cantidad"
                            aria-label="Cantidad">
                    </div>
                    <div class="col">
                        <input name="tipoProducto" type="text" class="form-control" placeholder="Tipo de producto"
                            aria-label="Tipo de producto">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input name="categoria" type="text" class="form-control" placeholder="Categoría"
                            aria-label="Categoría">
                    </div>
                    <div class="col">
                        <input name="precioUnitario" type="number" class="form-control" placeholder="Precio unitario"
                            aria-label="Precio unitario">
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input name="imagen" type="file" class="form-control" id="formFile">
                            <label class="input-group-text" for="formFile">Subir imagen</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="col-3 btn btn-primary">Guardar</button>
                </div>
            </form>

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