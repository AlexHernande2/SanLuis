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
    function readClienteValid($documento, $correoElectronico)
    {
        session_start();
        $_SESSION['documento'] = $documento;
        $sql = 'select * from cliente ';
        $sql .= 'where Documento="' . $documento . '" and ';
        $sql .= 'correoElectronico="' . $correoElectronico.'"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $row_cnt = $resultadoSQL->num_rows;
        if($row_cnt == 1){
            header('location:index.php');
        }else{
            echo "campos vacios o datos incorrectos";
        }
        $conexiondb->close();
        return $resultadoSQL;
    }
    function readRow($documento){
        $sql = 'select * from cliente ';
        $sql .= 'where Documento="'.$documento.'"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $cliente = new Cliente();
        while($registro = $resultadoSQL->fetch_assoc()){
            $cliente->setDocumento($registro['Documento']);
            $cliente->setNombre($registro['nombre']);
            $cliente->setTelefono($registro['contacto']);
            $cliente->setCorreoElectronico($registro['CorreoElectronico']);
            $cliente->setDireccion($registro['direccion']);
        }
        $conexiondb->close();
        return $cliente;
    }
}