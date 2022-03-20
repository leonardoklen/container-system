<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Conteiner;

class ConteinerValidacao extends Validacao
{
    public function validar(Conteiner $conteiner){
        $this->validarCampos($conteiner);

        return $this->formatarRetorno();
    }

    private function validarCampos(Conteiner $conteiner){
        if(empty($conteiner->getNumeroConteiner())){
            $this->addErros('campo "Número do Conteiner" não pode ser vazio');
        }

        if(strlen($conteiner->getNumeroConteiner()) != 11){
            $this->addErros('campo "Número do Conteiner" precisa ter 11 caracteres');
        }

        if(empty($conteiner->getCliente())){
            $this->addErros('campo "Cliente" não pode ser vazio');
        }

        if(empty($conteiner->getTipo())){
            $this->addErros('campo "Tipo" não pode ser vazio');
        }

        if(empty($conteiner->getStatus())){
            $this->addErros('campo "Status" não pode ser vazio');
        }

        if(empty($conteiner->getCategoria())){
            $this->addErros('campo "Categoria" não pode ser vazio');
        }
    }

    private function formatarRetorno(){
        $qtdErros = count($this->getErros());
        $erros = 'Verificar: ';

        foreach($this->getErros() as $erro){
            $erros .= $erro . ', ';
        }

        $erros = substr($erros, 0, -2);
        $erros .= '.';

        return ['qtdErros' => $qtdErros, 'erros' => $erros];
    }
}
