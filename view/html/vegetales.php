<?php
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$tipoProducto = $_GET['tipoProducto'];
$productoController = new ProductoController();
$productoValid = $productoController->readProductoCategori($tipoProducto);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/categorias.css">
</head>

<body>
    <main>
    <div class="container">
    <section id="categoriesSection">
    <h1>Vegetales</h1>
        <?php
        $cont = 1;
        foreach ($productoValid as $producto) {
            if($cont%4 == 1){
            echo '<div class="row row-cols-1 row-cols-md-4 g-4">';
            $cont = $cont+1;
        }
            echo '<div class="col">';
            echo '<div class="card">';
            echo '<img style="height: 200px;" src="data:'.$producto->getExtensionImagen().';base64,'.base64_encode($producto->getImagen()).'" class="card-img-top" alt="brocoli">';
            echo '<div class="card-body">';
            echo '<a id="tit">';
            echo '<h5 class="card-title" id="tit">' . $producto->getNombre() . '</h5>';
            echo '</a>';
            echo '<a href="#" class="btn btn-primary">Go somewhere</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } ?>
        </div>
    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</html>