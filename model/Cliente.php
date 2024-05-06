<?php 
namespace cliente;

class Cliente
{
    private $documento;
    private $nombre;
    private $telefono;
    private $correoElectronico;
    private $direccion;

    public function getDocumento()
    {
        return $this->documento;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function setDocumento($value)
    {
        $this->documento = $value;
    }
    public function setNombre($value)
    {
        $this->nombre = $value;
    }
    public function setTelefono($value)
    {
        $this->telefono = $value;
    }
    public function setCorreoElectronico($value)
    {
        $this->correoElectronico = $value;
    }
    public function setDireccion($value)
    {
        $this->direccion = $value;
    }
    
}