 
<?php
//clase en donde se agrega y se carga el contenido del carrito
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


if (!empty($_POST['idProducto']) ) {
    // agregar a producto carrito y leer productos para mostrarlos  
    $idCliente = $_POST['idCliente'];
    $idProducto = $_POST['idProducto'];
    $cantidadSelec = $_POST['cantidadSelec'];
  
    $productoRow = new productoController();
    
    $productoRow = $productoRow->readRow($idProducto);
    $proCa = new proCaController();
    $proEnCarrito = $proCa->ReadPro($idCliente);
    $procar = $proCa->AddCliProCar($idCliente, $idProducto, $cantidadSelec);
   
    if ($procar == false) {
         echo 1;
    
    } else if($procar!= false){
        $proEnCarrito = $proCa->ReadPro($idCliente);
    
        mostrarCosas($idCliente, $proCa, $proEnCarrito);
    }
    
        // mostrarCosas($idCliente, $procar, $proEnCarrito);
    
} else {
    //leer productos para mostrarlos al hacer click en el icono del carrito
    //empty = true si llega vacio
    
    if(!empty($_POST['cantMaxProd'])){
        
        $idProductoAccion = $_POST['idProductoAccion'];
        $cantidadAccion = $_POST['fieldInput'];
        $cantidadMax = $_POST['cantMaxProd'];
        $cantidadYaSelec = $_POST['cantidadYaSelec'];
        $operacion = $_POST['operacion'];
        $idCliente = $_POST['idCliente'];

        $proCa = new proCaController();
        $productoAccion = $proCa->accionProdCar($cantidadAccion,$idProductoAccion,$cantidadMax,$cantidadYaSelec,$operacion,$idCliente); 
      
        if ($productoAccion == false) {
            echo 1;
       } else if($productoAccion != false) {
        $proEnCarrito = $proCa->ReadPro($idCliente);
    
         mostrarCosas($idCliente, $proCa, $proEnCarrito);
       }

    }else{
      
        $idCliente = $_POST['idCliente'];
        $proCa = new proCaController();
        $proEnCarrito = $proCa->ReadPro($idCliente);
         mostrarCosas($idCliente, $proCa, $proEnCarrito);
    
    }
}








function mostrarCosas($idCliente, $proCa, $proEnCarrito)
{
  
    $productoRow = new productoController();
    $cantidadProductos = [];
    //cantidad maxima de un producto
    foreach ($proEnCarrito as $producto) {
        $productoCantidadmax = $productoRow->readRow($producto->getId()); 
        array_push($cantidadProductos,$productoCantidadmax->getCantidad());
    }
   
    //se muestran todos los productos que se encuentran en el carrito del cliente
    $conta = 0;
    $cont = 0;

    //1 significa suma y 0 resta
    foreach ($proEnCarrito as $producto) {
      if($producto->getCantidad()!=0){
        echo '<tr>
        <td><img style="height: 70px; width: 70px;" src="data:' . $producto->getExtensionImagen() . ';base64,' . base64_encode($producto->getImagen()) . '"><br>' . $producto->getNombre() . '</td>
        <td>' . $producto->getCantidad() . '</td>
        <td> ' . $producto->getPrecioUnitario() . ' COP</td>
        <td> ' . $producto->getPrecioUnitario() * $producto->getCantidad() . ' COP</td>
        <td><button onclick="decrementincrementCounterCart('.$conta.','.$producto->getId().','.$cantidadProductos[$cont].','.$producto->getCantidad().', 0,'.$idCliente.')" class="menos btn btn-danger d-inline">-</button></td>
        <td><button onclick="decrementincrementCounterCart('.$conta.','.$producto->getId().','.$cantidadProductos[$cont].','.$producto->getCantidad().', 1,'.$idCliente.')" class="mas btn btn-success d-inline">+</button></td>
        <td><input value="0" type="number" oninput="validateNumber('.$conta.','.$cantidadProductos[$cont].')" max="'.$producto->getCantidad().'" class="numberInput" style="width:50px;"></td>
      </tr>';
      $conta++;
      $cont++;
      }
            
        
      
          
    }
}
