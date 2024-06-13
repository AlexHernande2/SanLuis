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
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <link rel="stylesheet" href="../css/categorias.css">
</head>

<body>

  <header>
    <?php include 'header.php'; ?>
  </header>
  <main>
    <div class="container">
      <section style="padding-bottom:2%;" id="categoriesSection">



        <h1 id="tipoProd"><?php echo $tipoProducto ?></h1>
        <?php
        //contador para saltos
        $cont = 1;
        //contador para saber index de cara card
        $conta = 0;
        if (empty($documento)) {
          $documento = 0;
          $styleModal = 'data-bs-toggle="modal" data-bs-target="#myModal"';
        } else {
          $styleModal = '';
        }
        foreach ($productoValid as $producto) {
          //cada cuatro loops se genera un salto 
          if ($cont == 1 || $cont % 4 == 0) {
            echo '<div class="row row-cols-1 row-cols-md-4 g-4">';
            $cont = $cont + 1;
          }



          //plantilla para generar las cartas con sus productos
          echo '<div class="col">';
          echo '<div class="card" id="' . $producto->getId() . '">';
          echo '<img style="height: 200px;" src="data:;base64,' . base64_encode($producto->getImagen()) . '" class="card-img-top" alt="brocoli">';
          echo '<div class="card-body">';
          echo '<a id="tit">';
          echo '<h5 class="card-title" id="tit">' . $producto->getNombre() . '</h5>';
          echo '</a>';
          echo '<button onclick="decrementCounter(' . $conta . ')" class="menos btn btn-danger">-</button>';
          echo '<span max ="' . $producto->getCantidad() . '" class="contador">1</span>';
          echo '<button onclick="incrementCounter(' . $conta . ')" class="mas btn btn-success">+</button>';
          echo '<button  ' . $styleModal . '  type="button" onclick="add_cart(' . $documento . ',' . $producto->getId() . ',' . $conta . ',' . $producto->getCantidad() .')" style="margin-left: 5px;" class="btn btn-primary"><img src="../imagenes/cart.svg" alt=""></button>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          $conta++;
        } ?>

    </div>
  </main>
  <footer>
    <div id="footer-container"></div>
  </footer>
  <!-- modal   -->
  <div class="modal fade" id="myModal" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">AVISO</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" id="modalbody">necesitas iniciar sesion para agregar productos</div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">seguir navegando</button>
          <a id="linkIniSes"><button class="btn btn-primary">ir a inicio sesion</button></a>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">ADVERTENCIA</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="ModalBodyAdv" class="modal-body">
          No puedes agregar mas unidades de este producto
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/initHF.js"></script>
  <script src="../js/header.js"></script>
  <script src="../js/sumRes.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>


</html>