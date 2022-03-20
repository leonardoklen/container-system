<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
</head>


<body>    
    <nav class="navbar navbar-expand-lg navbar-light bg-dark mb-4">
      <div class="container">
        <a class="navbar-brand text-white" href="<?php echo 'http://' . APP_HOST ?>">Sistema de Conteiners</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link ms-3 text-white" aria-current="page" href="<?php echo 'http://' . APP_HOST . '/conteiner/index' ?>">Conteiner</a>
            <a class="nav-link ms-3 text-white" aria-current="page" href="<?php echo 'http://' . APP_HOST . '/movimentacoes/index'?>">Movimentações</a>
            <a class="nav-link ms-3 text-white" aria-current="page" href="<?php echo 'http://' . APP_HOST . '/relatorios/index' ?>">Relatório</a>            
          </div>
        </div>
      </div>
    </nav>
    