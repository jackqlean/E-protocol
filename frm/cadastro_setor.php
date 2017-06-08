<?php
session_start();
include "_navegacao.php";
?>
<!DOCTYPE HTML>
 <html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Cadastro de Setores</title>

    <meta name="description" content="">
    <meta name="author" content="Jaquison Quintao Leandro">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
    <!-- Bootstrap -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
          
</head>
<body>

<div class="page-header">
        <h1>Cadastro de Setores</h1>
</div>

<form name="cadastro" id="cadastro" method="POST" action="../op/cadastrar_setor.php" >
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtSetor">Setor</label>  
  <div class="col-md-5">
  <input id="txtSetor" name="txtSetor" type="text" value="" placeholder="Digite o setor" class="form-control input-md" required="">
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
    <script src="../lib/main.js"></script>

</body>
</html>
