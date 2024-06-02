<?php
namespace productoController;

abstract class ProductoBaseController{
    abstract function updateProducto($id,$nombre, $cantidad, $tipoProducto, $categoria, $precioUnitario, $imagenProducto);
    abstract function readProducBuscador($nombre);
    abstract function readProductoCategori($tipoProducto);
    abstract function readRow($idProducto);
    abstract function readProducBuscador3($categoria,$producto,$subCategoria);
    abstract function createProducto($nombre,$cantidad,$tipoProducto,$categoria,$precioUnitario,$imagenProducto);
  
}