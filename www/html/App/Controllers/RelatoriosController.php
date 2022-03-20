<?php

namespace App\Controllers;

use App\Models\DAO\RelatoriosDAO;

class RelatoriosController extends Controller
{
    public function index()
    {
        $this->render('/relatorios/index');
    }

    public static function listarMovimentacoesAgrupadoPorClienteETipoMovimentacao($cliente){
        $relatoriosDAO = new RelatoriosDAO();

        return $relatoriosDAO->listarMovimentacoesAgrupadasPorClienteTipo($cliente);
    }

    public static function listarClientes(){
        $relatoriosDAO = new RelatoriosDAO();

        return $relatoriosDAO->listarClientes();
    }

    public static function listarQtdImportacaoExportacao($categoria){
        $relatoriosDAO = new RelatoriosDAO();

        return $relatoriosDAO->listarQtdImportacaoExportacao($categoria);
    }
}