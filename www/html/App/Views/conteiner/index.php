<div class="container">
    <form>

        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <input type="text" class="form-control" id="cliente" name="cliente" aria-describedby="Nome do Cliente">
        </div>

        <div class="mb-3">
            <label for="numeroConteiner" class="form-label">Número do Conteiner</label>
            <input type="text" class="form-control" id="numeroConteiner" name="numeroConteiner" placeholder="É necessário seguir a regra de 4 letras e 7 números para preencher o campo. Exemplo: AAAA0000000.">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select id="tipo" name="tipo" class="form-select">
                <option selected disabled>Selecione</option>
                <option value=20>20</option>
                <option value=40>40</option>
            </select>      
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option selected disabled>Selecione</option>
                <option value="Cheio">Cheio</option>
                <option value="Vazio">Vazio</option>
            </select>      
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select id="categoria" name="categoria" class="form-select">
                <option selected disabled>Selecione</option>
                <option value="Importação">Importação</option>
                <option value="Exportação">Exportação</option>
            </select>      
        </div>
        
        <button type="button" class="btn btn-success" onclick="enviarPost('/conteiner/salvar', 'conteiner')">Enviar</button>
        <button type="reset" class="btn btn-danger">Limpar</button>
        
        <table class="table table-striped mt-4 border border-solid text-center">
          <thead>
            <tr>
              <th scope="col" class="col-md-2">Nº Conteiner</th>
              <th scope="col" class="col-md-3">Cliente</th>             
              <th scope="col" class="col-md-1">Tipo</th>
              <th scope="col" class="col-md-1">Status</th>
              <th scope="col" class="col-md-2">Categoria</th>
              <th scope="col" class="col-md-2">Ação</th>
            </tr>
          </thead>
          <tbody>            
            <?php
                if($this->getViewVar()['conteiners']->rowCount()){      
                    $index = 1;

                    foreach($this->getViewVar()['conteiners'] as $conteiner){
                        echo '<tr>';
                            echo '<th scope="row"><input type="text" value="' . $conteiner['numero_conteiner'] . '" class="text-center form-control" id="numeroConteiner' . $index . '"></th>';
                            echo '<td><input type="text" value="' . $conteiner['cliente'] . '" class="text-center form-control" id="cliente' . $index . '"></td>';
                            echo '<td>
                                    <select id="tipo' . $index . '" class="form-select text-center">
                                        <option value=20 '; if($conteiner['tipo'] == 20){echo 'selected';} echo '>20</option>
                                        <option value=40 '; if($conteiner['tipo'] == 40){echo 'selected';} echo '>40</option>
                                    </select>   
                                 </td>';
                            echo '<td>
                                    <select id="status' . $index . '" class="form-select text-center">
                                        <option value="Cheio" '; if($conteiner['status'] == 'Cheio'){echo 'selected';} echo '>Cheio</option>
                                        <option value="Vazio" '; if($conteiner['status'] == 'Vazio'){echo 'selected';} echo '>Vazio</option>
                                    </select>  
                                 </td>';
                            echo '<td>
                                    <select id="categoria' . $index . '" class="form-select text-center">
                                        <option value="Importação" '; if($conteiner['categoria'] == 'Importação'){echo 'selected';} echo '>Importação</option>
                                        <option value="Exportação" '; if($conteiner['categoria'] == 'Exportação'){echo 'selected';} echo '>Exportação</option>
                                    </select></td>';
                            echo '<td> 
                                    <button class="btn btn-primary" onclick="enviarPost(\'/conteiner/editar\', \'conteiner\', '.$index.', \'' . $conteiner['numero_conteiner'] . '\')">Alterar</button>
                                    <button class="btn btn-danger" onclick="enviarGet(\'/conteiner/excluir\', \'' . $conteiner['numero_conteiner'] . '\')">Excluir</button>                                    
                                 </td>';
                        echo '</tr>';
                        
                        $index ++;
                    }    
                }else{
                    echo '<tr><td colspan="6" class="text-primary"><b>Não há conteiners cadastrados para exibir. Cadastre um :)</b></td></tr>';
                }                
            ?>
          </tbody>
        </table>

    </form>
</div>