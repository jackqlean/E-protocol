<?php
session_start();
include "_navegacao.php";
?>
<?php
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);
// =====================================

$cod = $_GET["cod"];

// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
require_once "../config/init.php";
// Executa a instrução SQL para selectionar todos os registros
$sql_query = mysqli_query($link,"SELECT s.cod_setor AS cod_setor, s.setor AS desc_setor, p.setor FROM setor s, proc p WHERE s.cod_setor = p.setor AND p.cod = '".$cod."'");

$sql2_query = mysqli_query($link,"SELECT * FROM proc WHERE cod = '".$cod."'");

$sql3_query = mysqli_query($link,"SELECT s.* FROM setor s");

// Fecha a conexão com o servidor para poupar recursos de processamento

mysqli_close($link);

?>

<!DOCTYPE HTML>
 <html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Alteração de Processo</title>
    <meta name="description" content="">
    <meta name="author" content="Jaquison Quintao Leandro">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
    <!-- Bootstrap -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

<div class="page-header">
        <h1>Alteração de Processo</h1>
</div>

<form name="cadastro" id="cadastro" method="POST" action="/prot/op/alterar_proc.php?cod=<?php echo $cod?>">
<?php while ($linha = mysqli_fetch_array($sql2_query)) { ?>
<fieldset>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtTipo">Tipo</label>
  <div class="col-md-5">
     <select name="txtTipo" id="txtTipo" class="form-control">
        <option>Selecione...</option>
        <option value="PI" <?php if ($linha["tipo"]=='PI') echo 'selected="selected"'?>>Protocolo Interno</option>
        <option value="PE" <?php if ($linha["tipo"]=='PE') echo 'selected="selected"'?>>Protocolo Externo</option>
        <option value="OT" <?php if ($linha["tipo"]=='OT') echo 'selected="selected"'?>>Outros</option>
        </select>
     </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <?php while ($array = mysqli_fetch_array($sql_query)) { 
        $desc_setor = $array["desc_setor"];
        ?>
  <?php } ?>
  <label class="col-md-4 control-label" for="txtSetor">Setor de origem: -   <span style="font-family: Arial; font-size: 20px; font-style:italic; color:#FF0000;"><?php echo $desc_setor ?></span></label>
  
     <div class="col-md-5">
      <select name="txtSetor" id="txtSetor" class="form-control">
      <option>Selecione...</option>
      <?php while ($array = mysqli_fetch_array($sql3_query)) { 
        $scod = $array["cod_setor"];
        $setor = $array["setor"];
      ?>
         <option value="<?php echo $scod ?>"><?php echo $setor ?></option>
      <?php } ?>
      </select>
   </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtAssunto">Assunto</label>  
  <div class="col-md-5">
  <input type="text" name="txtAssunto" id="txtAssunto" value="<?php echo $linha["assunto"] ?>" placeholder="Digite o assunto" class="form-control input-md" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtDescricao">Descrição</label>  
  <div class="col-md-5">
  <textarea name="txtDescricao" id="txtDescricao" placeholder="Preencha com a descrição aqui" class="form-control input-md" required=""><?php echo $linha["descricao"]?></textarea>
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
