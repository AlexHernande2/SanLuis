<?php

namespace baseControler;

abstract class BaseController
{
    abstract function create($cliente);
    abstract function readClienteValid($documento,$correoElectronico);
    abstract function readRow($documento);
    // abstract function delete();
    // abstract function readRow();
    
}