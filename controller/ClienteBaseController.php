<?php

namespace clienteController;

abstract class ClienteBaseController
{
    abstract function create($cliente);
    abstract function readClienteValid($documento,$CorreoElectronico);
    abstract function readRow($documento);
    abstract function readValidAdmin($correo,$contraseña);
    // abstract function delete();
    // abstract function readRow();
    
}