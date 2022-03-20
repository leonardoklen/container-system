<?php

namespace App\Models\Validacao;

class Validacao
{
    private $erros = [];

    public function addErros($erro){
        array_push($this->erros, $erro);
    }

    public function getErros(){
        return $this->erros;
    }
}
