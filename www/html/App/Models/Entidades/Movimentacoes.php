<?php

namespace App\Models\Entidades;

class Movimentacoes
{
    private $numero_movimentacao;
    private $numero_conteiner;
    private $tipo;
    private $dataInicio;
    private $dataFim;
    private $horaInicio;
    private $horaFim;

    public function getNumeroMovimentacao()
    {
        return $this->numero_movimentacao;
    }

    public function setNumeroMovimentacao($numero_movimentacao)
    {
        $this->numero_movimentacao = $numero_movimentacao;
    }

    public function getNumeroConteiner()
    {
        return $this->numero_conteiner;
    }

    public function setNumeroConteiner($numero_conteiner)
    {
        $this->numero_conteiner = $numero_conteiner;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;
    }

    public function getDataFim()
    {
        return $this->dataFim;
    }

    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;
    }

    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;
    }

    public function getHoraFim()
    {
        return $this->horaFim;
    }

    public function setHoraFim($horaFim)
    {
        $this->horaFim = $horaFim;
    }
}
