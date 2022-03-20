<?php

namespace App\Models\DAO;

use App\Models\Entidades\Conteiner;

class ConteinerDAO extends BaseDAO
{
    public function listar($numeroConteiner = null)
    {
        if($numeroConteiner){
            return $this->select("
                select * from conteiner where numero_conteiner = $numeroConteiner
            ");
        }

        return $this->select("
            select * from conteiner order by data_hora_inclusao desc
        ");
    }

    public function salvar(Conteiner $conteiner)
    {
        try {
            $numero_conteiner = $conteiner->getNumeroConteiner();
            $cliente = $conteiner->getCliente();
            $tipo = $conteiner->getTipo();
            $status = $conteiner->getStatus();
            $categoria = $conteiner->getCategoria();

            $this->insert(
                'conteiner',
                ":numero_conteiner, :cliente, :tipo, :status, :categoria",
                [
                    ':numero_conteiner' => $numero_conteiner,
                    ':cliente' => $cliente,
                    ':tipo' => $tipo,
                    ':status' => $status,
                    ':categoria' => $categoria,
                ]
            );
            
            return ['sucesso' => 1];
        } catch (\Exception $e) {
            return ['sucesso' => 0, 'erro' => $e->getMessage()];
        }
    }

    public function editar(Conteiner $conteiner, $numeroConteinerAntigo)
    {
        try {
            $numero_conteiner = $conteiner->getNumeroConteiner();
            $cliente = $conteiner->getCliente();
            $tipo = $conteiner->getTipo();
            $status = $conteiner->getStatus();
            $categoria = $conteiner->getCategoria();

            $this->update(
                'conteiner',
                "numero_conteiner = :numero_conteiner, cliente = :cliente, tipo = :tipo, status = :status, categoria = :categoria",
                [
                    ':numero_conteiner' => $numero_conteiner,
                    ':cliente' => $cliente,
                    ':tipo' => $tipo,
                    ':status' => $status,
                    ':categoria' => $categoria,
                ],
                "numero_conteiner = '$numeroConteinerAntigo'"
            );
            
            return ['sucesso' => 1];
        } catch (\Exception $e) {
            if($e->getCode() === '23000'){
                return ['sucesso' => 0, 'erro' => 'Não é possível alterar o número do conteiner pois existe movimentações vinculadas a ele ou já existe algum conteiner com esse número.'];
            }
            return ['sucesso' => 0, 'erro' => $e->getMessage()];
        }
    }

    public function excluir(Conteiner $conteiner)
    {
        try {
            $numero_conteiner = $conteiner->getNumeroConteiner();
            $numero_conteiner = "'$numero_conteiner'";

            $this->delete('conteiner', 'numero_conteiner', $numero_conteiner);
            
            return ['sucesso' => 1];
        } catch (\Exception $e) {            
            if($e->getCode() === '23000'){
                return ['sucesso' => 0, 'erro' => 'Não é possível excluir o conteiner pois existe movimentações vinculadas a ele.'];
            }
            return ['sucesso' => 0, 'erro' => $e->getMessage()];
        }
    }
}
