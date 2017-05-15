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
    <title>Cadastro de requerentes</title>

    <meta name="description" content="">
    <meta name="author" content="Jaquison Quintao Leandro">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
    <!-- Bootstrap -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
          
</head>
<body>
<?php

$cod = $_GET["cod"];

// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
require_once "../config/init.php";
// Executa a instrução SQL para selectionar todos os registros
// Se quiser retornar campos específicos só é necessário colocar o nome do campo no lugar do *

$sql_query = mysqli_query($link,"SELECT * FROM req WHERE cod = '".$cod."'");

//Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);
?>
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
        <h1>Alteração de Requerentes</h1>
</div>

<form name="cadastro" id="cadastro" method="POST" action="/prot/op/alterar_req.php?cod=<?php echo $cod?>" onsubmit="return validaCampo(); return false;">
<fieldset>
<?php while ($linha = mysqli_fetch_array($sql_query)) { ?>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtNome">Nome</label>  
  <div class="col-md-5">
  <input id="txtNome" name="txtNome" type="text" value="<?php echo $linha["nome"] ?>" placeholder="Nome do usuário" class="form-control input-md" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtTipo">Informe o tipo</label>  
  <div class="col-md-5">
  <select name="txtTipo" id="txtTipo" class="form-control input-md">
        <option>Selecione...</option>
        <option value="F" <?php if ($linha["tipo"]=='F') echo 'selected="selected"'?>> PESSOA FÍSICA</option>
        <option value="J" <?php if ($linha["tipo"]=='J') echo 'selected="selected"'?>> PESSOA JURÍDICA</option>
        <option value="S" <?php if ($linha["tipo"]=='S') echo 'selected="selected"'?>> SERVIDOR PÚBLICO</option>
        </select>
 </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtCpf">CPF</label>  
  <div class="col-md-5">
  <input id="txtCpf" name="txtCpf" type="text" class="form-control input-md" value="<?php echo $linha["cpf"] ?>" onkeypress="return txtBoxFormat(this, '###.###.###-##', event);" required="" onchange="VerificaCPF ()">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtTel">Telefone</label>
  <div class="col-md-5">
    <input type="text" name="txtTel" id="txtTel" value="<?php echo $linha["tel"] ?>" class="form-control input-md" onkeypress="return txtBoxFormat(this, '(##)####-####', event);" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtCel">Celular</label>
  <div class="col-md-5">
    <input type="text" name="txtCel" id="txtCel" value="<?php echo $linha["cel"] ?>" class="form-control input-md" onkeypress="return txtBoxFormat(this, '(##)#####-####', event);" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtRec">Recados</label>
  <div class="col-md-5">
    <input type="text" name="txtRec" id="txtRec" value="<?php echo $linha["rec"] ?>" class="form-control input-md" onkeypress="return txtBoxFormat(this, '(##)#####-####', event);" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtEmail">Email</label>
  <div class="col-md-5">
    <input type="email" name="txtEmail" id="txtEmail" value="<?php echo $linha["email"] ?>" class="form-control input-md"  placeholder="digite seu @email.com.br" required="">
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtSexo">Sexo</label>
  <div class="col-md-5">
    <select id="txtSexo" name="txtSexo" class="form-control">
      <option value="M" <?php if ($linha["sexo"] == 'M') echo 'selected="selected"'?>>Masculino</option>
      <option value="F" <?php if ($linha["sexo"] == 'F') echo 'selected="selected"'?>>Feminino</option>
    </select>
  </div>
</div>
<?php } ?>
<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnEnviar"></label>
  <div class="col-md-8">
    <button type="submit" id="btnEnviar" name="btnEnviar" class="btn btn-primary">Confirmar</button>
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
