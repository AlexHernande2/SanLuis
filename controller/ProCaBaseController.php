<?php 
namespace proCaBasecontroller;

abstract class ProCaBasecontroller{
    abstract function AddCliProCar($idCliente,$idProducto,$cantidadSelec);
    abstract function ReadPro($idCliente);
    // abstract function delete();
    // abstract function readRow();
    
}