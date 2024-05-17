<?php
namespace producto;

class Producto{
    private $id;
    private	$nombre;
    private $descripcion;
    private $cantidad;
    private $tipoProducto;	
    private $categoria;	
    private $precioUnitario;
    private $imagen;
    private $extensionImagen;
    function getId(){
        return $this->id;
    }
    function getNombre(){
        return $this->nombre;   
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    function getCantidad(){
        return $this->cantidad;
    }
    function getTipoProducto(){
        return $this->tipoProducto;
    }
    function getCategoria(){
        return $this->categoria;
    }
    function getPrecioUnitario(){
        return $this->precioUnitario;
    }
    function getImagen(){
        return $this->imagen;
    }
    function getExtensionImagen(){
        return $this->extensionImagen;
    }

    function setId($value){
        $this->id = $value;
    }
    function setNombre($value){
        $this->nombre = $value;
    }
    function setDescripcion($value){
        $this->descripcion = $value;
    }
    function setCantidad($value){
        $this->cantidad = $value;
    }
    function setTipoProducto($value){
        $this->tipoProducto = $value;
    }
    function setCategoria($value){
        $this->categoria = $value;
    }
    function setPrecioUnitario($value){
        $this->precioUnitario = $value;
    }
    function setImagen($value){
        $this->imagen = $value;
    }
    function setExtensionImagen($value){
        $this->extensionImagen = $value;
    }

}