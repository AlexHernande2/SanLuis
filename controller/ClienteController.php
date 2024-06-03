<?php
namespace clienteController;

use clienteController\ClienteBaseController;
use conexionDb\ConexionDbController;
use cliente\Cliente;

class ClienteController extends ClienteBaseController
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
        $sql = 'insert into carrito (cliente_id) values ('.$cliente->getDocumento().')';
        $resultadoSQL2 = $conexiondb->execSQL($sql);
        $conexiondb->close();
        return $resultadoSQL;
    }
    function readClienteValid($documento, $CorreoElectronico)
    {
        $sql = 'select * from cliente ';
        $sql .= 'where Documento = ' . $documento . ' and ';
        $sql .= 'CorreoElectronico = "' . $CorreoElectronico.'"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $row_cont = $resultadoSQL->num_rows;
        if ($row_cont != 0) {
            session_start();
            $_SESSION['documento'] = $documento;
            header('location:index.php');
        }else{
            $resultadoSQL = false; 
            header('Refresh: 1; URL=formSesion.php?inicioSesion=si');
        
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
    function readValidAdmin($correo,$contraseña){
        $sql = 'select * from administrador ';
        $sql .= 'where correoElectronico = "' . $correo . '" and ';
        $sql .= 'contraseña = "' . $contraseña.'"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $row_cont = $resultadoSQL->num_rows;
        if ($row_cont != 0) {
            header('location:indexAdmin.php');
        }else{
            $resultadoSQL = false; 
            header('Refresh: 1; URL=formSesion.php?inicioSesion=si');
        
        }
        $conexiondb->close();
        return $resultadoSQL;
    }
}
