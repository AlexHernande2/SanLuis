<?php

namespace clienteController;

abstract class ClienteBaseController
{
    abstract function create($cliente);
    abstract function readClienteValid($documento,$correoElectronico);
    abstract function readRow($documento);
    // abstract function delete();
    // abstract function readRow();
    
}