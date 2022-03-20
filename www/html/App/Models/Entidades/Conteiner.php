<?php

namespace App\Models\Entidades;

class Conteiner
{
    private $numero_conteiner;
    private $cliente;
    private $tipo;
    private $status;
    private $categoria;

    public function getNumeroConteiner()
    {
        return $this->numero_conteiner;
    }

    public function setNumeroConteiner($numero_conteiner)
    {
        $this->numero_conteiner = $numero_conteiner;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
}
