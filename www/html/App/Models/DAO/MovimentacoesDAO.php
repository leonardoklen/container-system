<?php

namespace App\Models\DAO;

use App\Models\Entidades\Movimentacoes;

class MovimentacoesDAO extends BaseDAO
{
    public function listar($numeroConteiner = null)
    {
        if($numeroConteiner){
            return $this->select("
                select * from movimentacoes where numero_conteiner = $numeroConteiner
            ");
        }

        return $this->select("
            select * from movimentacoes order by data_hora_inclusao desc
        ");
    }

    public function salvar(Movimentacoes $movimentacoes)
    {
        try {
            $numero_conteiner = $movimentacoes->getNumeroConteiner();
            $tipo = $movimentacoes->getTipo();
            $dataInicio = $movimentacoes->getDataInicio();
            $horaInicio = $movimentacoes->getHoraInicio();
            $dataFim = $movimentacoes->getDataFim();
            $horaFim = $movimentacoes->getHoraFim();

            $this->insert(
                'movimentacoes',
                ":numero_conteiner, :tipo, :data_inicio, :hora_inicio, :data_fim, :hora_fim",
                [
                    ':numero_conteiner' => $numero_conteiner,
                    ':tipo' => $tipo,
                    ':data_inicio' => $dataInicio,
                    ':hora_inicio' => $horaInicio,
                    ':data_fim' => $dataFim,
                    ':hora_fim' => $horaFim,
                ]
            );
            
            return ['sucesso' => 1];
        } catch (\Exception $e) {
            return ['sucesso' => 0, 'erro' => $e->getMessage()];
        }
    }

    public function editar(Movimentacoes $movimentacao)
    {
        try {
            $numeroMovimentacao = $movimentacao->getNumeroMovimentacao();
            $numero_conteiner = $movimentacao->getNumeroConteiner();
            $tipo = $movimentacao->getTipo();
            $dataInicio = $movimentacao->getDataInicio();
            $horaInicio = $movimentacao->getHoraInicio();
            $dataFim = $movimentacao->getDataFim();
            $horaFim = $movimentacao->getHoraFim();

            $this->update(
                'movimentacoes',
                "numero_conteiner = :numero_conteiner, tipo = :tipo, data_inicio = :data_inicio, hora_inicio = :hora_inicio, data_fim = :data_fim, hora_fim = :hora_fim",
                [
                    ':numero_conteiner' => $numero_conteiner,
                    ':tipo' => $tipo,
                    ':data_inicio' => $dataInicio,
                    ':hora_inicio' => $horaInicio,
                    ':data_fim' => $dataFim,
                    ':hora_fim' => $horaFim,
                ],
                "numero_movimentacao = $numeroMovimentacao"
            );
            
            return ['sucesso' => 1];
        } catch (\Exception $e) {
            if($e->getCode() === '23000'){
                return ['sucesso' => 0, 'erro' => 'Não é possível alterar o número do conteiner pois existe movimentações vinculadas a ele ou já existe algum conteiner com esse número.'];
            }
            return ['sucesso' => 0, 'erro' => $e->getMessage()];
        }
    }

    public function excluir(Movimentacoes $movimentacao)
    {
        try {
            $numero_movimentacao = $movimentacao->getNumeroMovimentacao();

            $this->delete('movimentacoes', 'numero_movimentacao', $numero_movimentacao);
            
            return ['sucesso' => 1];
        } catch (\Exception $e) {
            return ['sucesso' => 0, 'erro' => $e->getMessage()];
        }
    }
}
