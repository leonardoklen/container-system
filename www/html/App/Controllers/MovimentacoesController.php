<?php

namespace App\Controllers;

use App\Models\DAO\ConteinerDAO;
use App\Models\DAO\MovimentacoesDAO;
use App\Models\Entidades\Movimentacoes;
use App\Models\Validacao\MovimentacoesValidacao;

class MovimentacoesController extends Controller
{
    public function index()
    {
        $conteinerDAO = new ConteinerDAO();        
        $conteiners = $conteinerDAO->listar();

        $this->setViewParam('conteiners', $conteiners);

        $movimentacoesDAO = new MovimentacoesDAO();        
        $movimentacoes = $movimentacoesDAO->listar();
        
        $this->setViewParam('movimentacoes', $movimentacoes);

        $this->render('/movimentacoes/index');
    }

    public function salvar()
    {           
        $movimentacoes = new Movimentacoes();
        $movimentacoes->setNumeroConteiner($_POST['numeroConteiner']);
        $movimentacoes->setTipo($_POST['tipo']);
        $movimentacoes->setDataInicio($_POST['dataInicio']);
        $movimentacoes->setHoraInicio($_POST['horaInicio']);
        $movimentacoes->setDataFim($_POST['dataFim']);
        $movimentacoes->setHoraFim($_POST['horaFim']);

        $movimentacoesValidacao = new MovimentacoesValidacao();
        $validacao = $movimentacoesValidacao->validar($movimentacoes);
        if($validacao['qtdErros'] > 0){
            echo $validacao['erros'];
        }else{
            $movimentacoesDAO = new MovimentacoesDAO();
            $retorno = $movimentacoesDAO->salvar($movimentacoes);
            
            if($retorno['sucesso']){
                echo 'Sucesso ao incluir movimentação!';
            }else{
                echo $retorno['erro'];
            }
        }
    }

    public function editar(){
        $movimentacoes = new Movimentacoes();
        $movimentacoes->setNumeroMovimentacao($_POST['numeroMovimentacao']);
        $movimentacoes->setNumeroConteiner($_POST['numeroConteiner']);
        $movimentacoes->setTipo($_POST['tipo']);
        $movimentacoes->setDataInicio($_POST['dataInicio']);
        $movimentacoes->setHoraInicio($_POST['horaInicio']);
        $movimentacoes->setDataFim($_POST['dataFim']);
        $movimentacoes->setHoraFim($_POST['horaFim']);

        $movimentacoesValidacao = new MovimentacoesValidacao();
        $validacao = $movimentacoesValidacao->validar($movimentacoes);
        if($validacao['qtdErros'] > 0){
            echo $validacao['erros'];
        }else{
            $movimentacoesDAO = new MovimentacoesDAO();        
            $retorno = $movimentacoesDAO->editar($movimentacoes);
            
            if($retorno['sucesso']){
                echo 'Sucesso ao alterar conteiner!';
            }else{
                echo $retorno['erro'];
            }
        }
    }

    public function excluir()
    {
        $movimentacoes = new Movimentacoes();
        $movimentacoes->setNumeroMovimentacao($_GET['id']);

        $movimentacoesDAO = new MovimentacoesDAO();        
        $retorno = $movimentacoesDAO->excluir($movimentacoes);
        
        if($retorno['sucesso']){
            echo 'Sucesso ao excluir a movimentação!';
        }else{
            echo $retorno['erro'];
        }
    }
}