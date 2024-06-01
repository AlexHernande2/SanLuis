<?php
namespace productoController;

abstract class ProductoBaseController{
    abstract function readProducBuscador($nombre);
    abstract function readProductoCategori($tipoProducto);
    abstract function readRow($idProducto);
    abstract function readProducBuscador3($categoria,$producto,$subCategoria);
  
}