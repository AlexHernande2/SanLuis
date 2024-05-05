<?php
namespace clienteController;

use baseControler\BaseController;
use conexionDb\ConexionDbController;
use cliente\Cliente;

class ClienteController extends BaseController
{
    function create($cliente)
    {
        $sql = 'insert into cliente ';
        $sql .= '(Documento,nombre,contacto,CorreoElectronico,direccion) values ';
        $sql .= '(';
        $sql .= $cliente->getDocumento() . ',';
        $sql .= '"' . $cliente->getNombre() . '",';
        $sql .= '"' . $cliente->getTelefono() . '",';
        $sql .= '"' . $cliente->getCorreoElectronico() . '",';
        $sql .= '"' . $cliente->getDireccion() . '"';
        $sql .= ')';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $conexiondb->close();
        return $resultadoSQL;
    }
}