<?php

namespace clienteController;

abstract class ClienteBaseController
{
    abstract function create($cliente);
    abstract function readClienteValid($documento,$CorreoElectronico);
    abstract function readRow($documento);
    // abstract function delete();
    // abstract function readRow();
    
}