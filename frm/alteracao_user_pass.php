<?php
session_start();
include "_navegacao.php";
?>
<?php
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);
// =====================================
// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
require_once "../config/init.php";

$user_id = $_SESSION['user_id'];
// Executa a instrução SQL para selectionar todos os registros
$sql_query = mysqli_query($link,"SELECT u.name , u.email FROM users u WHERE u.id ='".$user_id."'");

// Fecha a conexão com o servidor para poupar recursos de processamento

mysqli_close($link);

?>

<!DOCTYPE HTML>
 <html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Alteração de Usuário e Senha</title>
    <meta name="description" content="">
    <meta name="author" content="Jaquison Quintao Leandro">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
    <!-- Bootstrap -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="page-header">
        <h1>Alteração de Usuário / Senha</h1>
</div>

<form name="cadastro" id="cadastro" method="POST" action="/prot/op/alterar_user_pass.php">
<?php while ($linha = mysqli_fetch_array($sql_query)) { ?>
<fieldset>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txt_login">Usuário</label>  
  <div class="col-md-5">
  <input type="text" name="txt_login" id="txt_login" value="<?php echo $linha["name"] ?>" class="form-control input-md">
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtSenhaA">Senha Antiga</label>  
  <div class="col-md-5">
  <input type="password" name="txtSenhaA" id="txtSenhaA" placeholder="Preencha com a senha antiga" class="form-control input-md" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtSenhaN">Nova Senha</label>  
  <div class="col-md-5">
  <input type="password" name="txtSenhaN" id="txtSenhaN" placeholder="Preencha com a nova senha" class="form-control input-md" required="">
  </div>
</div>

<?php } ?>
<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnEnviar"></label>
  <div class="col-md-8">
    <button type="submit" id="btnEnviar" name="btnEnviar" class="btn btn-primary">Confirmar alteração</button>
  </div>
</div>

</fieldset>
</form>
    <script src="../lib/main.js"></script>
</body>
</html>
