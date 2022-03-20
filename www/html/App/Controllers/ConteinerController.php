<?php

namespace App\Controllers;

use App\Models\DAO\ConteinerDAO;
use App\Models\Entidades\Conteiner;
use App\Models\Validacao\ConteinerValidacao;

class ConteinerController extends Controller
{
    public function index()
    {        
        $conteinerDAO = new ConteinerDAO();        
        $conteiners = $conteinerDAO->listar();

        $this->setViewParam('conteiners', $conteiners);
        
        $this->render('/conteiner/index');
    }

    public function salvar()
    {           
        $conteiner = new Conteiner();
        $conteiner->setNumeroConteiner($_POST['numeroConteiner']);
        $conteiner->setCliente($_POST['cliente']);
        $conteiner->setTipo($_POST['tipo']);
        $conteiner->setStatus($_POST['status']);
        $conteiner->setCategoria($_POST['categoria']);

        $conteinerValidacao = new ConteinerValidacao();
        $validacao = $conteinerValidacao->validar($conteiner);
        if($validacao['qtdErros'] > 0){
            echo $validacao['erros'];
        }else{
            $conteinerDAO = new ConteinerDAO();        
            $retorno = $conteinerDAO->salvar($conteiner);
            
            if($retorno['sucesso']){
                echo 'Sucesso ao incluir conteiner!';
            }else{
                echo 'Erro ao incluir conteiner!';
            }
        }
    }

    public function editar(){
        $conteiner = new Conteiner();
        $conteiner->setNumeroConteiner($_POST['numeroConteinerNovo']);
        $conteiner->setCliente($_POST['cliente']);
        $conteiner->setTipo($_POST['tipo']);
        $conteiner->setStatus($_POST['status']);
        $conteiner->setCategoria($_POST['categoria']);

        $conteinerValidacao = new ConteinerValidacao();
        $validacao = $conteinerValidacao->validar($conteiner);
        if($validacao['qtdErros'] > 0){
            echo $validacao['erros'];
        }else{
            $conteinerDAO = new ConteinerDAO();        
            $retorno = $conteinerDAO->editar($conteiner, $_POST['numeroConteinerAntigo']);
            
            if($retorno['sucesso']){
                echo 'Sucesso ao alterar conteiner!';
            }else{
                echo $retorno['erro'];
            }
        }
    }

    public function excluir()
    {
        $conteiner = new Conteiner();
        $conteiner->setNumeroConteiner($_GET['id']);

        $conteinerDAO = new ConteinerDAO();        
        $retorno = $conteinerDAO->excluir($conteiner);
        
        if($retorno['sucesso']){
            echo 'Sucesso ao excluir o conteiner!';
        }else{
            echo $retorno['erro'];
        }
    }

    public static function optionsComboBoxConteiners($itemSelecionado = null){
        $conteinerDAO = new ConteinerDAO();        
        $conteiners = $conteinerDAO->listar();

        $comboBox = '';
        foreach($conteiners as $conteiner){
            $comboBox .= "<option value=" . $conteiner['numero_conteiner'] . " "; 

            if($conteiner['numero_conteiner'] == $itemSelecionado){
                $comboBox .= 'selected';
            }
            
            $comboBox .= ">" . $conteiner['numero_conteiner'] . "</option>";
        }
        
        return $comboBox;
    }
}