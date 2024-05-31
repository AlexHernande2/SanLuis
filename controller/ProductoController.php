<?php
namespace productoController;
use producto\Producto;
use productoController\ProductoBaseController;
use conexionDb\ConexionDbController;

class ProductoController extends ProductoBaseController{
    function readProductoCategori($tipoProducto){
        $sql = 'select * from producto ';
        $sql .= 'where tipoProducto="'.$tipoProducto.'"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $productosValid = [];
        while($registro = $resultadoSQL->fetch_assoc()){
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagenProducto']);
            $producto->setExtensionImagen($registro['extensionImagen']);

            array_push($productosValid, $producto);


        }
        $conexiondb->close();
        return $productosValid;
    }
    function readProducBuscador($nombre){
        $sql = 'select * from producto ';
        $sql .= 'WHERE nombre LIKE "%'.$nombre.'%"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $productos = [];
        while($registro = $resultadoSQL->fetch_assoc()){
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagenProducto']);
            $producto->setExtensionImagen($registro['extensionImagen']);

            array_push($productos, $producto);


        }
        $conexiondb->close();
        return $productos;
    }
    function readRow($idProducto){
        $sql = 'select * from producto ';
        $sql .= 'WHERE id = '.$idProducto;
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        while($registro = $resultadoSQL->fetch_assoc()){
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagenProducto']);
            $producto->setExtensionImagen($registro['extensionImagen']);
        }
        $conexiondb->close();
        return $producto;
    }

    
/* */
 // Nuevo método para obtener todos los productos
 function readAllProductos() {
    $sql = 'SELECT * FROM producto';
    $conexiondb = new ConexionDbController();
    $resultadoSQL = $conexiondb->execSQL($sql);
    $productos = [];
    while ($registro = $resultadoSQL->fetch_assoc()) {
        $producto = new Producto();
        $producto->setId($registro['id']);
        $producto->setNombre($registro['nombre']);
        $producto->setDescripcion($registro['descripcion']);
        $producto->setCantidad($registro['cantidad']);
        $producto->setTipoProducto($registro['tipoProducto']);
        $producto->setCategoria($registro['categoria']);
        $producto->setPrecioUnitario($registro['precioUnitario']);
        $producto->setImagen($registro['imagenProducto']);
        $producto->setExtensionImagen($registro['extensionImagen']);
        array_push($productos, $producto);
    }
    $conexiondb->close();
    return $productos;
}



/* */


}