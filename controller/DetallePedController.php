<?php
namespace detallePedController;

require 'DetallePedBaseController.php';
require 'conexionDbController.php';

use conexionDb\ConexionDbController;
use detallePedBaseController\DetallePedBaseController;
use producto\Producto;

class DetallePedController extends DetallePedBaseController
{
    function asigDetPed($documentoCuenta, $date, $productos,$documento)
    {
        $sql = 'select cliente_id,numPed from pedido ';
        $sql .= 'where cliente_id = ' . $documentoCuenta;
        $conexionDb = new ConexionDbController();
        $resultadoSQL = $conexionDb->execSQL($sql);
        $registroExs = $resultadoSQL->fetch_assoc();
 
        //asignacion de numero de pedido al cliente al no existir
        if (!isset($registroExs['cliente_id'])) {
            //si no existe lo agrego
            $sql = 'insert into pedido (cliente_id,fecha,numPed)';
            $sql .= 'values(' . $documentoCuenta . ',"' . $date . '",1)';
            $resultadoSQL = $conexionDb->execSQL($sql);
            $numPed = 1;
        } else {
            //si existe actualizo el campo cantidad agregando solo la cantidad que desea el cliente
            $sql = 'update pedido set numPed = numPed + 1';
            $resultadoSQL = $conexionDb->execSQL($sql);
            $numPed = $registroExs['numPed'] + 1;
        }
        
        $producto = new Producto();

        foreach ($productos as $producto) {

            $sql = 'insert into detallepedido (numPed_ped,producto_id,cantidad,precioTotal,clienteid_Ped)';
            $sql .= 'values (' . $numPed . ',' . $producto->getId() . ',' . $producto->getCantidad() . ',' . $producto->getPrecioUnitario() * $producto->getCantidad() .','.$documento.')';
            $resultadoSQL = $conexionDb->execSQL($sql);
        }
        $conexionDb->close();
        return $resultadoSQL;
    }
}