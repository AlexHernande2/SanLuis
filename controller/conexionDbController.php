<?php 
namespace conexionDb;

use mysqli;

class ConexionDbController
{
    private $server_db = '127.0.0.1';
    private $user_db = 'root';
    private $pwd_db = '';
    private $name_db = 'sanluis';
    private $conex;

    function __construct()
    {
        $this->conex = new mysqli($this->server_db, $this->user_db, $this->pwd_db, $this->name_db);
    }

    function execSQL($sql)
    {
        return $this->conex->query($sql);
    }

    function close()
    {
        $this->conex->close();
    }

    function validarConexion()
    {
        return $this->conex->connect_error;
    }
}