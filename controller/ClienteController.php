<?php
namespace clienteController;

use clienteController\ClienteBaseController;
use conexionDb\ConexionDbController;
use cliente\Cliente;

class ClienteController extends ClienteBaseController
{
    function create($cliente)
    {
        $documento = $cliente->getDocumento();

        // Verificar si el cliente ya existe
        if ($this->clienteExists($documento)) {
            // Cliente ya existe, mostrar mensaje de error o redireccionar
            echo "<script>alert('Error: El cliente con documento $documento ya existe.');</script>";
            return false;
        }

        // Si el cliente no existe, proceder con la inserción
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
        
        //al cliente registrado automaticamente se le asigna un carrito 
        $sql = 'insert into carrito (cliente_id) values ';
        $sql .= ' ('.$documento.')';
        $resultadoSQL = $conexiondb->execSQL($sql);
        // También, asegúrate de manejar el caso de error al ejecutar la consulta SQL

        $conexiondb->close();
        return $resultadoSQL;
    }

    function clienteExists($documento)
    {
        /*Para verificar si el cliente esta registrado x el documento si lo esta devuelve un true y si el contador es mayor q 0 significa lo mismo que esta registrado */
        $sql = 'select count(*) as count from cliente where Documento = ' . $documento;
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $row = $resultadoSQL->fetch_assoc();
        $count = $row['count'];
        $conexiondb->close();
        return $count > 0;
    }


    /** */
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
    function readValidCliente($correo, $contraseña) {
        $sql = 'SELECT * FROM cliente ';
        $sql .= 'WHERE CorreoElectronico = "' . $correo . '" AND ';
        $sql .= 'Contraseña = "' . $contraseña . '"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $row_cont = $resultadoSQL->num_rows;
        if ($row_cont != 0) {
            header('Location: index.php');
        } else {
            // Credenciales no válidas, mostrar alerta
            echo '<script>alert("Credenciales no válidas, por favor inténtelo de nuevo.");</script>';
            header('Refresh: 1; URL=formSesion.php?inicioSesion=si');
        }
        $conexiondb->close();
        return $resultadoSQL;
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
