<?php
namespace proCaController;

use conexionDb\ConexionDbController;
use proCaBasecontroller\ProCaBasecontroller;
use producto\Producto;

class ProCaController extends ProCaBasecontroller
{
    function AddCliProCar($idCliente, $idProducto, $cantidadSelec)
    {
        //consulto el numero de carrito del cliente
        $sql = 'select id from carrito where cliente_id = ' . $idCliente;
        $conexiondb = new ConexionDbController();
        $idCarrito = $conexiondb->execSQL($sql);
        $registro = $idCarrito->fetch_assoc();
        $idCarrito = $registro['id'];

        //consulto si en producto carrito ya esa el producto
        $sql = 'select * from productocarrito where ';
        $sql .= 'carrito_id = ' . $idCarrito . ' and producto_id = ' . $idProducto;
        $resultadoExistencia = $conexiondb->execSQL($sql);
        $registroExs = $resultadoExistencia->fetch_assoc();

        //consulto cantidad del carrito 
   
        //consulto cantidad total del producto
        $sql = 'select cantidad from producto where id = ' . $idProducto . '';
        $resultadoCantPer = $conexiondb->execSQL($sql);
        $resultadoCantPer = $resultadoCantPer->fetch_assoc();
        $resultadoCantPer = $resultadoCantPer['cantidad'];


        if (!isset($registroExs['carrito_id'])) {
            //si no existe lo agrego
            $sql = 'insert into productocarrito (carrito_id,producto_id,cantidad)';
            $sql .= 'VALUES (' . $idCarrito . ',' . $idProducto . ',' . $cantidadSelec . ')';
            $resultadoSQL = $conexiondb->execSQL($sql);
        } else {
            $registroCantidad = $registroExs['cantidad'];
            if ($registroCantidad + $cantidadSelec > $resultadoCantPer) {

                return $resultadoSQL = false;

            } else {
                //si existe actualizo el campo cantidad agregando solo la cantidad que desea el cliente
                $sql = 'update productocarrito set cantidad = cantidad + ' . $cantidadSelec . ' where carrito_id = ' . $idCarrito . ' and producto_id = ' . $idProducto;
                $resultadoSQL = $conexiondb->execSQL($sql);

            }
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
        $sql = 'select producto_id,cantidad from productocarrito where carrito_id = ' . $idCarrito;
  
        $idsProd = $conexiondb->execSQL($sql);
        $productoCarrito = [];
        while ($registro = $idsProd->fetch_assoc()) {
            //con los id almacenados se recorren uno a uno para saber sus atributos
            $sql = 'select * from producto where id = ' . $registro['producto_id'];
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
        $conexiondb->close();
        return $productoCarrito;
    }
    function accionProdCar($cantidadAccion,$idProductoAccion,$cantidadMax,$cantidadYaSelec,$operacion,$idCliente){
        $sql = 'select id from carrito where cliente_id = ' . $idCliente;
        $conexiondb = new ConexionDbController();
        $idCarrito = $conexiondb->execSQL($sql);
        $registro = $idCarrito->fetch_assoc();
        $idCarrito = $registro['id'];

        //suma
        if($operacion == 1){
            $cantidadTotalAccion = $cantidadAccion + $cantidadYaSelec;
          
            if($cantidadTotalAccion >$cantidadMax){
                return false;
            }else{
               
                $sql = 'update productocarrito ';
                $sql .= 'set cantidad = '.$cantidadTotalAccion.' ';
                $sql .= 'where carrito_id = '.$idCarrito.' and producto_id = '.$idProductoAccion.'';

               
                $resultadoSQL = $conexiondb->execSQL($sql);
                return $resultadoSQL;
            }
        }
        //resta
        if($operacion == 0){
            $cantidadTotalAccion = $cantidadYaSelec - $cantidadAccion;
            if($cantidadTotalAccion>=0){
                $sql = 'update productocarrito ';
                $sql .= 'set cantidad = '.$cantidadTotalAccion.' ';
                $sql .= 'where carrito_id = '.$idCarrito.' and producto_id = '.$idProductoAccion.'';
    
                $resultadoSQL = $conexiondb->execSQL($sql);
                return $resultadoSQL;
            }
        }
   

        
    }
    function deleteCartProds($documentoCuenta){
        $sql = 'select id from carrito where cliente_id = ' . $documentoCuenta;
        $conexiondb = new ConexionDbController();
        $idCarrito = $conexiondb->execSQL($sql);
        $idCarrito = $idCarrito->fetch_assoc();
        $idCarrito = $idCarrito['id'];
        //select * from productocarrito where carrito_id = 2
        $sql = 'select * from productocarrito where carrito_id = '.$idCarrito.'';
        $carritoProds = $conexiondb->execSQL($sql);
        
        while ($registro = $carritoProds->fetch_assoc()) {
            $sql = 'select cantidad from producto where id = '.$registro['producto_id'].'';
            $resultadoCantProd = $conexiondb->execSQL($sql);
            $resultadoCantProd = $resultadoCantProd->fetch_assoc();
            $resultadoCantProd = $resultadoCantProd['cantidad'];
   
            $sql = 'update producto ';
            $sql .= 'SET cantidad = '.$resultadoCantProd - $registro['cantidad'].' where id = '.$registro['producto_id'].'';
            $conexiondb->execSQL($sql);
           
        }
        $sql = 'select cantidad from productocarrito ';
        $sql .= 'where carrito_id = carrito';

        $sql = 'DELETE FROM productocarrito WHERE carrito_id = '.$idCarrito.'';
        $resultradoSQL = $conexiondb->execSQL($sql);
        return $resultradoSQL;
    
    }
}