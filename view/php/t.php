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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <div class="container">
    <section id="categoriesSection">
    <h1><?php echo $tipoProducto ?></h1>
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


<script>
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    $(window).on("load resize", function() {
      if (this.matchMedia("(min-width: 768px)").matches) {
        $dropdown.hover(
          function() {
            const $this = $(this);
            $this.addClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "true");
            $this.find($dropdownMenu).addClass(showClass);
          },
          function() {
            const $this = $(this);
            $this.removeClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "false");
            $this.find($dropdownMenu).removeClass(showClass);
          }
        );
      } else {
        $dropdown.off("mouseenter mouseleave");
      }
    });
  </script>


</html>