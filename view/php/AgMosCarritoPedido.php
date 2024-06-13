<?php
//clase en donde se agrega y se carga el contenido del carrito pedido
require_once '../../model/Cliente.php';
require_once '../../controller/ClienteBaseController.php';
require_once '../../controller/ClienteController.php';
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
use cliente\Cliente;
use ClienteController\ClienteController;

$idProductoAccion = $_POST['idProductoAccion'];
$cantidadAccion = $_POST['fieldInput'];
$cantidadMax = $_POST['cantMaxProd'];
$cantidadYaSelec = $_POST['cantidadYaSelec'];
$operacion = $_POST['operacion'];
$idCliente = $_POST['idCliente'];

$proCa = new proCaController();
$productoAccion = $proCa->accionProdCar($cantidadAccion, $idProductoAccion, $cantidadMax, $cantidadYaSelec, $operacion, $idCliente);

if ($productoAccion == false) {
    echo 1;
} else {
    mostrarCosas2($idCliente);
}

function mostrarCosas2($documento)
{
    if (!empty($documento)) {


        //leer productos para mostrarlos al hacer click en el icono del carrito

        $proCa = new proCaController();
        $proEnCarrito = $proCa->ReadPro($documento);
        $contador = 1;
        $conta = 0;
        $precioTotalPro = 0;
        $precioTotal = 0;

        $productoRow = new productoController();
        $cantidadProductos = [];
        //cantidad maxima de un producto
        foreach ($proEnCarrito as $producto) {
            $productoCantidadmax = $productoRow->readRow($producto->getId());
            array_push($cantidadProductos, $productoCantidadmax->getCantidad());
        }

        foreach ($proEnCarrito as $producto) {
            $productoCantidad = $producto->getCantidad();
            $precioTotalPro = $producto->getPrecioUnitario() * $producto->getCantidad();
            if ($producto->getCantidad() != 0) {
                echo '<tr>
                <td>' . $contador . '</td>
                <td><img style="height: 70px; width: 70px;" src="data:' . $producto->getExtensionImagen() . ';base64,' . base64_encode($producto->getImagen()) . '"><br>' . $producto->getNombre() . '</td>
                <td>' . $producto->getCantidad() . '</td>
                <td><button onclick="decrementincrementCounterCart2(' . $conta . ',' . $producto->getId() . ',' . $cantidadProductos[$conta] . ',' . $producto->getCantidad() . ', 0,' . $documento . ')" class="menos btn btn-danger d-inline">-</button></td>
                <td><button onclick="decrementincrementCounterCart2(' . $conta . ',' . $producto->getId() . ',' . $cantidadProductos[$conta] . ',' . $producto->getCantidad() . ', 1,' . $documento . ')" class="mas btn btn-success d-inline">+</button></td>
                <td><input value="1" type="number" oninput="validateNumber('.$conta.','.$cantidadProductos[$conta].')"  max="' . $producto->getCantidad() . '" class="numberInput" style="width:50px;"></td>                        
                <td> ' . $precioTotalPro . ' COP</td>
              </tr>';
                $contador++;
                $conta++;
                $precioTotal += $precioTotalPro;
            }

        }

        echo '<tr>
             <td>TOTAL</td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td>' . $precioTotal . ' COP</td>
         </tr>';
    } else {
        echo '<tfoot>
        <tr id="footer">
            <th scope="row" colspan="5">Carrito vacío - inicia Sesion para comenzar a comprar!</th>
        </tr>
    </tfoot>';
    }
}