<?php
namespace productoController;
use producto\Producto;
use productoController\ProductoBaseController;
use conexionDb\ConexionDbController;

class ProductoController extends ProductoBaseController{
    function readProductoCategori($tipoProducto){
        $sql = 'select tipoProducto from cliente';
        $sql .= 'where tipoProducto="'.$tipoProducto.'"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $productosValid = [];
        while($registro = $resultadoSQL->fetch_assoc()){
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagen']);
         
            array_push($productosValid, $producto);


        }
        $conexiondb->close();
    
    }
}