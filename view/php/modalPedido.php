<?php
require '../../model/Producto.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';
require '../../controller/ProCaBaseController.php';
require '../../controller/ProCaController.php';
require '../../controller/DetallePedController.php';


use detallePedController\DetallePedController;
use proCaController\ProCaController;

session_start();
$documentoCuenta = $_SESSION["documento"];

$correo = $_POST['correoElectronico'];
$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$date = date('Y-m-d');
$proCa = new proCaController();
$productos = $proCa->ReadPro($documentoCuenta);


$dataPed = "Nombre:" . $nombre;
$dataPed .= "\n" . 'documento' . "\n" . 'correoElectronico:' . $correo . "\n";
$dataPed .= '*EL PEDIDO ES EL SIGUIENTE:*'."\n"."\n";
$contadorSiProd = 0;
foreach ($productos as $producto) {
    if($producto->getCantidad()!=0){
        $cantidad = $producto->getCantidad();
        $precioUnitario = $producto->getPrecioUnitario();
        $precioTotal = $cantidad * $precioUnitario;
        $dataPed .='Producto: '. $producto->getNombre() . '| PrecioUnitario: ' . $producto->getPrecioUnitario();
        $dataPed .= '| CantidadProducto: ' . $producto->getCantidad() . '| TOTAL:' . $precioTotal."\n"."\n";
        $contadorSiProd++;
    } 
    
   
}


$proCa = $proCa->deleteCartProds($documentoCuenta);







$encode = urlencode($dataPed);
if($contadorSiProd == 0){
    echo "noProductos";
}else{
    echo 'https://wa.me/573108108175?text=' . $encode; 
}





;

