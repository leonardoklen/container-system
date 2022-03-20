<?php
use App\Controllers\ConteinerController;

?>
<div class="container">
    <form>
        <div class="mb-3">
            <label for="movimentacaoNumeroConteiner" class="form-label">Número do Conteiner</label>
            <select id="movimentacaoNumeroConteiner" class="form-select">
                <option selected disabled>Selecione</option>
                <?php        
                    echo ConteinerController::optionsComboBoxConteiners();                
                ?>
            </select>  
        </div>

        <div class="mb-3">
            <label for="tipoMovimentacao" class="form-label">Tipo de Movimentação</label>
            <select id="tipoMovimentacao" class="form-select">
                <option selected disabled>Selecione</option>
                <option value="Embarque">Embarque</option>
                <option value="Descarga">Descarga</option>
                <option value="Gate in">Gate in</option>
                <option value="Gate out">Gate out</option>
                <option value="Reposicionamento">Reposicionamento</option>
                <option value="Pesagem">Pesagem</option>
                <option value="Scanner">Scanner</option>
            </select>      
        </div>

        <div class="mb-3">
            <div class="row">                
                <div class="col-md-6">    
                    <label for="dataInicio" class="form-label">Data Início</label>
                    <input type="date" class="form-control " id="dataInicio">
                </div>
                <div class="col-md-6"> 
                    <label for="horaInicio" class="form-label">Hora Início</label>   
                    <input type="text" class="form-control col-md-6" id="horaInicio">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">                
                <div class="col-md-6">    
                    <label for="dataFim" class="form-label">Data Fim</label>
                    <input type="date" class="form-control " id="dataFim">
                </div>
                <div class="col-md-6"> 
                    <label for="horaFim" class="form-label">Hora Fim</label>   
                    <input type="text" class="form-control col-md-6" id="horaFim">
                </div>
            </div>
        </div>
        
        <button type="button" class="btn btn-success" onclick="enviarPost('/movimentacoes/salvar', 'movimentacoes')">Enviar</button>
        <button type="reset" class="btn btn-danger">Limpar</button>
        
        <table class="table table-striped mt-4 border border-solid text-center">
          <thead>
            <tr>
              <th scope="col" class="col-md-1">Nº Movimentação</th>
              <th scope="col" class="col-md-2">Nº Conteiner</th>
              <th scope="col" class="col-md-2">Tipo de Movimentação</th>
              <th scope="col" class="col-md-1">Data Início</th>
              <th scope="col" class="col-md-1">Hora Início</th>
              <th scope="col" class="col-md-1">Data Fim</th>
              <th scope="col" class="col-md-1">Hora Fim</th>
              <th scope="col" class="col-md-3">Ação</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                if($this->getViewVar()['movimentacoes']->rowCount()){      
                    $index = 1;

                    foreach($this->getViewVar()['movimentacoes'] as $movimentacao){
                        echo '<tr>';
                            echo '<th scope="row">' . $movimentacao['numero_movimentacao'] . '</th>';
                            echo '<td>
                                    <select id="movimentacaoNumeroConteiner' . $index . '" class="form-select text-center">';
                                        echo ConteinerController::optionsComboBoxConteiners($movimentacao['numero_conteiner']);
                                    echo '</select>   
                                 </td>';
                            echo '<td>
                                    <select id="tipoMovimentacao' . $index . '" class="form-select text-center">
                                        <option value="Embarque" '; if($movimentacao['tipo'] == 'Embarque'){echo 'selected';} echo '>Embarque</option>
                                        <option value="Descarga" '; if($movimentacao['tipo'] == 'Descarga'){echo 'selected';} echo '>Descarga</option>
                                        <option value="Gate in" '; if($movimentacao['tipo'] == 'Gate in'){echo 'selected';} echo '>Gate in</option>
                                        <option value="Gate out" '; if($movimentacao['tipo'] == 'Gate out'){echo 'selected';} echo '>Gate out</option>
                                        <option value="Reposicionamento" '; if($movimentacao['tipo'] == 'Reposicionamento'){echo 'selected';} echo '>Reposicionamento</option>
                                        <option value="Pesagem" '; if($movimentacao['tipo'] == 'Pesagem'){echo 'selected';} echo '>Pesagem</option>
                                        <option value="Scanner" '; if($movimentacao['tipo'] == 'Scanner'){echo 'selected';} echo '>Scanner</option>
                                    </select>   
                                 </td>';
                            echo '<td><input type="date" class="form-control text-center" id="dataInicio' . $index . '" value="' . $movimentacao['data_inicio'] . '"></td>';
                            echo '<td><input type="text" class="form-control text-center" id="horaInicio' . $index . '" value="' . $movimentacao['hora_inicio'] . '"></td>';
                            echo '<td><input type="date" class="form-control text-center" id="dataFim' . $index . '" value="' . $movimentacao['data_fim'] . '"></td>';
                            echo '<td><input type="text" class="form-control text-center" id="horaFim' . $index . '" value="' . $movimentacao['hora_fim'] . '"></td>';
                            echo '<td>
                                    <button class="btn btn-primary" onclick="enviarPost(\'/movimentacoes/editar\', \'movimentacoes\', '.$index.', \'' . $movimentacao['numero_movimentacao'] . '\')">Alterar</button>
                                    <button class="btn btn-danger" onclick="enviarGet(\'/movimentacoes/excluir\', \'' . $movimentacao['numero_movimentacao'] . '\')">Excluir</button>   
                                 </td>';
                        echo '</tr>';

                        $index ++;
                    }
                }else{
                    echo '<tr><td colspan="8" class="text-primary"><b>Não há movimentações cadastradas para exibir. Cadastre uma :)</b></td></tr>';
                }    
              ?>            
          </tbody>
        </table>

    </form>
</div>