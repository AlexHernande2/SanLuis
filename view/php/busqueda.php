<?php 
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$productoController = new ProductoController();
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
                <th scope="row"><img  class="img-fluid" height="60px"  width="50px" src="data:'.$producto->getExtensionImagen().';base64,'.base64_encode($producto->getImagen()).'">
                <br>'.$producto->getNombre().'</th>
                <td>placeholderDescripcion</td>
                <td>'.$producto->getPrecioUnitario().'</td>
            </tr>
        </tbody>
   
    ';

}
echo ' </table>';
