<?php
session_start();
require_once "check.php";
$user_id = $_SESSION['user_id'];
require_once "../config/init.php";

$sql_query = mysqli_query($link,"SELECT u.permission AS permissao FROM users u WHERE u.id ='".$user_id."'");

$r = mysqli_fetch_array($sql_query);
       $p = $r["permissao"];

if ($p == "0"){
  $menu_cons = "Meus protocolos";
}else{
  $menu_cons = "Todos os protocolos";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>E-Protocol v1.0</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <!--<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">-->
    <link href="../css/principal.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header>
    <div id="cabecalho">
    </div>
    <div class="container">
        <img id="logotipo" src="../img/logo-left.png" alt="Logotipo">
    </div>
    <div class="container">
        <img id="logotipo-principal" src="../img/logo-principal.png">
    </div>
    </header><!-- /header -->
    <!-- Barra de navegação -->
    <div >
      <nav class="navbar navbar-inverse">
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
       
       
        <li><a href="../navegacao.php">Home</a>  </li>
       
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
            <li><a href="cadastro_req.php">Requerentes</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="cadastro_proc.php">Protocolos</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="cadastro_setor.php">Setores</a></li>
          </ul>
        </li> 
       
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Atendimento<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
             <li><a href="recebimento_proc.php">Receber protocolo</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="recebimento_proc_dev.php">Receber protocolo devolvido</a>  </li>
            <li role="separator" class="divider"></li>
            <li><a href="prot_rec.php">Exibir protocolos recebidos</a>  </li>
           </ul>
        </li> 
        
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultar<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
            <li><a href="consulta_proc.php"><?php echo $menu_cons ?></a>  </li>
          <li role="separator" class="divider"></li>
            <li><a href="consulta_proc_rec.php">Protocolos recebidos</a>  </li>
          </ul>
        </li>
        
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Config<span class="caret"></span>
        </a>  
          <ul class="dropdown-menu">
            <li><a href="alteracao_user_pass.php">Alterar - Usuario / Senha</a>  </li>
          </ul>
        </li>

        <li><a href="#">Sobre</a>  </li>
        <li><a href="../op/logout.php">Sair</a>  </li>

        </ul>
        </div>

        </div>
      </nav>
    </div>
    
  </body>
</html>