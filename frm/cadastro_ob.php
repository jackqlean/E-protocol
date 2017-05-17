<?php
session_start();
require_once "check.php";
?>
<!DOCTYPE HTML>
 <html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Cadastro de obrigações</title>

    <meta name="description" content="">
    <meta name="author" content="Jaquison Quintao Leandro">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
    <!-- Bootstrap -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
          
</head>
<body>

<!-- Barra de navegação -->
    <div>
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra-navegacao">
            <span class="sr-only">Alternar menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a href="#" class="navbar-brand">E-Protocol v1.0</a>
          </div>
        <div class="collapse navbar-collapse" id="barra-navegacao">
        <ul class="nav navbar-nav navbar-right">
       
       
        <li><a href="../index.php">Home</a>  </li>
       
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
            <li><a href="cadastro_req.php">Requerentes</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="cadastro_proc.php">Processos</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="cadastro_ob.php">Obrigações</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="cadastro_setor.php">Setores</a></li>
          </ul>
        </li> 
       
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Atendimento<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
            <li><a href="#">Editar</a>  </li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Logout</a>  </li>
          </ul>
        </li> 
        
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatorios<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
            <li><a href="#">Editar</a>  </li>
            <li><a href="#">Logout</a>  </li>
          </ul>
        </li>
        
        <li><a href="#">Sobre</a>  </li>
        <li><a href="../op/logout.php">Sair</a>  </li>

        </ul>
        </div>

        </div>
      </nav>
    </div>
<!-- Fim da barra de navegação -->

<div class="page-header">
        <h1>Cadastro de Obrigações</h1>
</div>

<form name="cadastro" id="cadastro" method="POST" action="../op/cadastrar_ob.php" >
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtTitulo">Título</label>  
  <div class="col-md-5">
  <input id="txtTitulo" name="txtTitulo" type="text" value="" placeholder="Digite o título" class="form-control input-md" required="">
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtTipo">Tipo</label>
  <div class="col-md-5">
     <select name="txtTipo" id="txtTipo" class="form-control">
        <option>Selecione...</option>
        <option value="D">Documento</option>
        <option value="G">Guia</option>
    </select>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnEnviar"></label>
  <div class="col-md-8">
    <button type="submit" id="btnEnviar" name="btnEnviar" class="btn btn-primary">Confirmar</button>
    <button type="reset" id="btnCancelar" name="btnCancelar" class="btn btn-warning">Cancelar</button>
    <input type="button" id="btnFechar" name="btnFechar" value="Fechar" class="btn btn-danger" onclick="javascript:location.href='../index.php'">
  </div>
</div>

</fieldset>
</form>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/main.js"></script>

</body>
</html>
