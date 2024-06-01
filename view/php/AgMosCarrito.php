<!-- clase en donde se agrega y se carga el contenido del carrito -->
<?php
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';
require '../../controller/ProCaBaseController.php';
require '../../controller/ProCaController.php';

use producto\Producto;
use productoController\ProductoController;
use proCaBasecontroller\ProCaBasecontroller;
use proCaController\ProCaController;


    if (isset($_POST['idProducto'])) {
        // agregar a producto carrito y leer productos para mostrarlos  
        $idCliente = $_POST['idCliente'];
        $idProducto = $_POST['idProducto'];
        $cantidadSelec = $_POST['cantidadSelec'];
        $proCa = new proCaController();
        $proca = $proCa->AddCliProCar($idCliente, $idProducto, $cantidadSelec);
    } else {
        //leer productos para mostrarlos al hacer click en el icono del carrito
        $idCliente = $_POST['idCliente'];
        $proCa = new proCaController();
    }
    //traer cantidad total y comparar por medio de un contador si este se excede en el limite de productos que hay en existencia 
//el comentario anterior no explica ninguna parte del codigo, solo da una idea para implementar algo
    $proEnCarrito = $proCa->ReadPro($idCliente);
    //se muestran todos los productos que se encuentran en el carrito del cliente
    foreach ($proEnCarrito as $producto) {
        echo '<tr>
            <td><img style="height: 70px; width: 70px;" src="data:' . $producto->getExtensionImagen() . ';base64,' . base64_encode($producto->getImagen()) . '"><br>' . $producto->getNombre() . '</td>
            <td>' . $producto->getCantidad() . '</td>
            <td> ' . $producto->getPrecioUnitario() . ' COP</td>
            <td> ' . $producto->getPrecioUnitario() * $producto->getCantidad() . ' COP</td>
          </tr>';
    }

