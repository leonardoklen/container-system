<?php

namespace App\Models\DAO;

class RelatoriosDAO extends BaseDAO
{
    public function listarMovimentacoesAgrupadasPorClienteTipo($cliente = null)
    {
        if($cliente){            
            return $this->select("
                select 
                    *, 
                    count(tb.tipo) as qtd 
                from (
                    select 
                        c.cliente,
                        m.tipo
                    from 
                        movimentacoes m 
                        left join conteiner c on c.numero_conteiner = m.numero_conteiner 
                    where c.cliente = '$cliente'
                    ) tb	
                group by 2, 1
            ");
        }

        return $this->select("
            select 
                *, 
                count(tb.tipo) as qtd 
            from (
                select 
                    c.cliente,
                    m.tipo
                from 
                    movimentacoes m 
                    left join conteiner c on c.numero_conteiner = m.numero_conteiner 
                ) tb	
            group by 2, 1
        ");
    }

    public function listarClientes(){
        return $this->select("
            select cliente from conteiner group by 1 order by 1 asc
        ");
    }

    public function listarQtdImportacaoExportacao($categoria){
        return $this->select("
            select 
            	count(m.numero_movimentacao) as qtd 
            from 
            	movimentacoes m 
            	left join conteiner c on m.numero_conteiner = c.numero_conteiner 
            where 
            	c.categoria = '$categoria' group by c.categoria 
        ")->fetchColumn();
    }
}
