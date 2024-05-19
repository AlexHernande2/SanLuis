<?php
namespace proCaController;

use conexionDb\ConexionDbController;
use proCaBasecontroller\ProCaBasecontroller;
use producto\Producto;

class ProCaController extends ProCaBasecontroller
{
    function AddCliProCar($idCliente, $idProducto,$cantidadSelec)
    {
        //INSERT INTO productocarrito (carrito_id, producto_id, cantidad) 
        // VALUES (2, 5, 1) 
        // ON DUPLICATE KEY UPDATE cantidad = cantidad + 1;

        //consulto el numero de carrito del cliente
        $sql = 'select id from carrito where cliente_id = ' . $idCliente;
        $conexiondb = new ConexionDbController();
        $idCarrito = $conexiondb->execSQL($sql);
        $registro = $idCarrito->fetch_assoc();
        $idCarrito = $registro['id'];

        //consulto si en producto carrito ya esa el producto
        $sql = 'select * from productocarrito where ';
        $sql .= 'carrito_id = '.$idCarrito.' and producto_id = '.$idProducto;
        $resultadoExistencia = $conexiondb->execSQL($sql);
        $registroExs = $resultadoExistencia->fetch_assoc();

        if(!isset($registroExs['carrito_id'])){
            //si no existe lo agrego
            $sql = 'insert into productocarrito (carrito_id,producto_id,cantidad)';
            $sql .= 'VALUES ('.$idCarrito.','.$idProducto.','.$cantidadSelec.')';
            $resultadoSQL = $conexiondb->execSQL($sql);
        }else{
            //si existe actualizo el campo cantidad agregando solo la cantidad que desea el cliente
            $sql = 'update productocarrito set cantidad = cantidad + '.$cantidadSelec.' where carrito_id = '.$idCarrito.' and producto_id = '.$idProducto;
            $resultadoSQL = $conexiondb->execSQL($sql);
        }
     
        return $resultadoSQL;

    }
    function ReadPro($idCliente)
    {
        //busco el carrito que le pertenece al cliente
        $sql = 'select id from carrito where cliente_id = ' . $idCliente;
        $conexiondb = new ConexionDbController();
        $idCarrito = $conexiondb->execSQL($sql);
        $idCarrito = $idCarrito->fetch_assoc();
        $idCarrito = $idCarrito['id'];

        //almaceno los id de los productos que se encuentran en el carrito 
        $sql = 'select producto_id,cantidad from productocarrito where carrito_id = '. $idCarrito;
        $idsProd = $conexiondb->execSQL($sql);
        $productoCarrito = [];
        while($registro = $idsProd->fetch_assoc()){
            //con los id almacenados se recorren uno a uno para saber sus atributos
            $sql = 'select * from producto where id = '.$registro['producto_id'];
            $resultadoSQL = $conexiondb->execSQL($sql);
            $resultadoSQL = $resultadoSQL->fetch_assoc();
            $producto = new Producto();
            $producto->setId($resultadoSQL['id']);
            $producto->setNombre($resultadoSQL['nombre']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setPrecioUnitario($resultadoSQL['precioUnitario']);
            $producto->setImagen($resultadoSQL['imagenProducto']);
            $producto->setExtensionImagen($resultadoSQL['extensionImagen']);

            //al ser un producto o mas , se almacena un array todos los productos que se tengan
            array_push($productoCarrito, $producto);
        }
       return $productoCarrito;
    }
}