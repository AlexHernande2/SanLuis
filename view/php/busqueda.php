<?php
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$productoController = new ProductoController();
if (!empty($_POST['admin'])) {
    $categoria = $_POST['busqueda'];
    $producto = $_POST['busqueda2'];
    $subCategoria = $_POST['busqueda3'];
    $productos = $productoController->readProducBuscador3($categoria, $producto, $subCategoria);
    $cont = 1;
    foreach ($productos as $producto) {
        echo ' 
        
                    <tr style="text-align:center;">
                        <th scope="row">' . $cont . '</th>
                        <td><img style="height: 40px;" src="data:' . $producto->getExtensionImagen() . ';base64,' . base64_encode($producto->getImagen()) . '"></td>
                        <td>' . $producto->getNombre() . '</td>
                        <td>' . $producto->getCantidad() . '</td>
                        <td>' . $producto->getCategoria() . '</td>
                        <td>' . $producto->getTipoProducto() . '</td>
                        <td>' . $producto->getPrecioUnitario() . '</td>
                        <td><button  class="btn btn-primary" ><img style="height: 20px;" src="../imagenes/modificarProd.png"></button></td>
                        <td><button class="btn btn-danger" ><img style="height: 20px;" src="../imagenes/modificarProd.png"></button></td>
                    </tr>';
        $cont++;
    }
} else {
    $productos = $productoController->readProducBuscador($_POST['busqueda']);
    echo '
<table class="table">
<thead>
    <tr>
        <th>Producto</th>
        <th>Descripcion</th>
        <th>Precio</th>
    </tr>
</thead>
';
    foreach ($productos as $producto) {
        echo
            '
    
       
        <tbody>
            <tr>
                <th scope="row"><img  class="img-fluid" height="60px"  width="50px" src="data:' . $producto->getExtensionImagen() . ';base64,' . base64_encode($producto->getImagen()) . '">
                <br>' . $producto->getNombre() . '</th>
                <td>placeholderDescripcion</td>
                <td>' . $producto->getPrecioUnitario() . '</td>
            </tr>
        </tbody>
   
    ';

    }
    echo ' </table>';
}