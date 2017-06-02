<?php
session_start();
require 'config/init.php';
require_once "check.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>::. E-Protocol v1.0 .::</title>

    <!-- Bootstrap -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Barra de navegação -->
    <div >
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
       
       
        <li><a href="navegacao.php">Home</a>  </li>
       
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
            <li><a href="frm/cadastro_req.php">Requerentes</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="frm/cadastro_proc.php">Processos</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="frm/cadastro_ob.php">Obrigações</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="frm/cadastro_setor.php">Setores</a></li>
          </ul>
        </li> 
       
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Atendimento<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
            <li><a href="frm/recebimento_proc.php">Receber processo enviado</a>  </li>
            <li role="separator" class="divider"></li>
            <li><a href="frm/recebimento_proc_dev.php">Receber processo devolvido</a>  </li>
            <li role="separator" class="divider"></li>
            <li><a href="frm/consulta_proc.php">Consultar processo</a>  </li>
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
        <li><a href="op/logout.php">Sair</a>  </li>

        </ul>
        </div>

        </div>
      </nav>
    </div>
    <span style="position:absolute; left:60px;">Olá, <?php echo $_SESSION['user_name']; ?>. Seja bem vindo ao sistema.</span>
    <span style="position:absolute; left:350px;">
    O seu setor atual é: <?php echo $_SESSION['user_setor']; ?>
    </span>
   	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>