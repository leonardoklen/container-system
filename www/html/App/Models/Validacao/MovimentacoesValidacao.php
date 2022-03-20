<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Movimentacoes;

class MovimentacoesValidacao extends Validacao
{
    public function validar(Movimentacoes $movimentacoes){
        $this->validarCampos($movimentacoes);

        return $this->formatarRetorno();
    }

    private function validarCampos(Movimentacoes $movimentacoes){
        if(empty($movimentacoes->getNumeroConteiner())){
            $this->addErros('campo "Número do Conteiner" não pode ser vazio');
        }

        if(empty($movimentacoes->getTipo())){
            $this->addErros('campo "Tipo de Movimentação" não pode ser vazio');
        }

        if(empty($movimentacoes->getDataInicio())){
            $this->addErros('campo "Data Início" não pode ser vazio');
        }

        if(empty($movimentacoes->getHoraInicio())){
            $this->addErros('campo "Hora Início" não pode ser vazio');
        }

        if(empty($movimentacoes->getDataFim())){
            $this->addErros('campo "Data Fim" não pode ser vazio');
        }

        if(empty($movimentacoes->getHoraFim())){
            $this->addErros('campo "Hora Fim" não pode ser vazio');
        }

        if(strtotime($movimentacoes->getDataInicio()) > strtotime($movimentacoes->getDataFim())){
            $this->addErros('"Data Início" deve ser menor ou igual a "Data Fim"');
        }

        if(strtotime($movimentacoes->getDataInicio()) === strtotime($movimentacoes->getDataFim())){
            if(strtotime($movimentacoes->getHoraInicio()) >= strtotime($movimentacoes->getHoraFim())){
                $this->addErros('para "Data Início" e "Data Fim" no mesmo dia, a "Hora Início" deve ser menor que a "Hora Fim"');
            }
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
