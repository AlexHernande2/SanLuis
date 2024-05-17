<?php
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;
//se atrapa el tipo de producto seleccionado
$tipoProducto = $_GET['tipoProducto'];
$productoController = new ProductoController();
//consulta de que productos de ese tipo se encuentran en la base de datos
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
<header>
<?php include 'header.php'; ?>
  </header>
    <main>
    <div class="container">
    <section id="categoriesSection">
    <h1><?php echo $tipoProducto ?></h1>
        <?php
        //contador paea saltos
        $cont = 1;
        //contador para saber index de cara card
        $conta = 0;
        foreach ($productoValid as $producto) {
            //cada cuatro loops se genera un salto 
            if($cont%4 == 0){
                echo '<div class="row row-cols-1 row-cols-md-4 g-4">';
                $cont = $cont+1;
            }
            //plantilla para generar las cartas con sus productos
            echo '<div class="col">';
            echo '<div class="card">';
            echo '<img style="height: 200px;" src="data:'.$producto->getExtensionImagen().';base64,'.base64_encode($producto->getImagen()).'" class="card-img-top" alt="brocoli">';
            echo '<div class="card-body">';
            echo '<a id="tit">';
            echo '<h5 class="card-title" id="tit">' . $producto->getNombre() . '</h5>';
            echo '</a>';
            echo '<button onclick="decrementCounter('.$conta.')" class="menos btn btn-danger">-</button>';
            echo '<span max ="'.$producto->getCantidad() .'" class="contador">1</span>';
            echo '<button onclick="incrementCounter('.$conta.')" class="mas btn btn-success">+</button>';
            echo '<button style="margin-left: 5px;" class="btn btn-primary"><img src="../imagenes/cart.svg" alt=""></button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $conta++;
        } ?>
        </div>
    </main>
</body>


     <script src="../js/header.js"></script>
   
</html>