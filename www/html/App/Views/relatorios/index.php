<?php

use App\Controllers\RelatoriosController;

?>

<div class="container">
    <?php 
        $clientes = RelatoriosController::listarClientes();

        if(!$clientes->rowCount()){
            echo '<div class="row text-center text-primary bg-light border border-solid mb-4"><b>Não há informações para exibir.</b></div>';
        }

        foreach($clientes as $cliente){
    ?>
            <h4>Cliente: <?php echo $cliente['cliente']?></h4>
            <table class="table table-striped mb-4 border border-solid text-center">                
                <thead>
                    <tr>
                        <th scope="col" class="col-md-6">Tipo de Movimentação</th>
                        <th scope="col" class="col-md-6">Total</th>
                    </tr>
                </thead>
                
                <tbody>                    
            <?php
                $movimentacoes = RelatoriosController::listarMovimentacoesAgrupadoPorClienteETipoMovimentacao($cliente['cliente']);

                if($clientes->rowCount() && !$movimentacoes->rowCount()){
                    echo '<td colspan=2 class="text-center text-primary"><b>Não há informações para exibir.</b></td>';
                }

                foreach($movimentacoes as $movimentacao){
            ?>            
                <tr>    
                    <td><?php echo $movimentacao['tipo']?></td>
                    <td><?php echo $movimentacao['qtd']?></td> 
                </tr>                                                                 
            <?php
                }
            ?>                    
                </tbody> 
            </table> 
            <?php
        }

        $qtdExportacao = RelatoriosController::listarQtdImportacaoExportacao('Exportação');
        $qtdImportacao = RelatoriosController::listarQtdImportacaoExportacao('Importação');
    ?>

    <div class="row">
        <div class="col-md-6">
            <ul class="pagination justify-content-center">
              <li class="page-item"><a class="page-link text-dark">Importação</a></li>
              <li class="page-item"><a class="page-link text-primary"><?php echo $qtdImportacao ? $qtdImportacao : 0?></a></li>
            </ul>
        </div>

        <div class="col-md-6 ">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link text-dark">Exportação</a></li>
                <li class="page-item"><a class="page-link text-primary"><?php echo $qtdExportacao ? $qtdExportacao : 0?></a></li>
            </ul>
        </div>

        <div class="row text-center">
            <p><b>Obs:</b> a importação e exportação fiquei em dúvida. Peguei a quantidade de movimentação de cada conteiner de acordo com a categoria. Espero que esteja certo :D</p>
        </div>
    </div>
</div>