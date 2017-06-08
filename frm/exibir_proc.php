<?php
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);
// =====================================
session_start();
include "_navegacao.php";

// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
require_once "../config/init.php";

//Seleciona o último registro processo cadastrado no 
//banco de dados.
$sqry = mysqli_query($link,"SELECT cod FROM proc ORDER BY cod DESC");
$lcod = mysqli_fetch_array($sqry);
$cod = $lcod["cod"];

//Consultas União tabelas (processos e setor)
$sql_query = mysqli_query($link,"SELECT s.cod_setor, s.setor AS desc_setor, p.setor FROM setor s, proc p WHERE s.cod_setor = p.setor AND p.cod = '".$cod."'");
$sql2_query = mysqli_query($link,"SELECT * FROM proc WHERE cod = '".$cod."'");
$sql3_query = mysqli_query($link,"SELECT r.nome FROM req r , proc p WHERE r.cod = p.cod_req AND p.cod = '".$cod."'");

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);
?>

<!DOCTYPE HTML>
 <html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Cadastro de Processos</title>

    <meta name="description" content="">
    <meta name="author" content="Jaquison Quintao Leandro">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
    <!-- Bootstrap -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            
    <script type="text/javascript">
      $(function () {
        $('[data-toggle="tooltip_imprimir"]').tooltip()
        $('[data-toggle="tooltip_gravar"]').tooltip()
      })
    </script>

</head>
<body>

<div class="page-header">
  <h1>Cadastro de Processos</h1>
</div>

<form name="cadastro" id="cadastro" method="POST" action="../op/insere_arq.php?cod=<?php echo $cod?>" enctype="multipart/form-data">
<?php $linha = mysqli_fetch_array($sql2_query)?>
<fieldset>

<?php $rlinha = mysqli_fetch_array($sql3_query)?>

<div class="form-group">
<label class="col-md-4 control-label" for="txtCod">Protocolo nº</label>
  <label class="col-md-5 control-label" /><span style="font-family: Arial; font-size: 28px; font-style:italic; color:#000000;"><?php echo $linha["cod"] ?></span></label>
  </div>
</div>

<div class="form-group">
<label class="col-md-4 control-label" for="txtRequerente">Nome do requerente</label>
  <div class="col-md-5">
     <input type="text" name="txtRequerente" id="txtRequerente" value="<?php echo $rlinha["nome"] ?>" class="form-control input-md" required="" disabled="">
    </div>
</div>
<!-- Text Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtTipo">Tipo</label>
  <div class="col-md-5">
     <?php 
     if ($linha["tipo"]=='PI') $ptipo = "Processo Interno";
     if ($linha["tipo"]=='PE') $ptipo = "Processo Externo";
     if ($linha["tipo"]=='OT') $ptipo = "Outros";
     ?>
     <input type="text" name="txtTipo" id="txtTipo" value="<?php echo $ptipo ?>" class="form-control input-md" required="" disabled="">
  </div>
</div>
<!-- Select Basic -->
<div class="form-group">
<?php 
  $array = mysqli_fetch_array($sql_query);
  $desc_setor = $array["desc_setor"];
?>
 <label class="col-md-4 control-label" for="txtSetor">Setor de origem</label>
  <div class="col-md-5">
     <input type="text" name="txtSetor" id="txtSetor" value="<?php echo $desc_setor ?>" class="form-control input-md" required="" disabled="">
    </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtAssunto">Assunto</label>  
  <div class="col-md-5">
  <input type="text" name="txtAssunto" id="txtAssunto" value="<?php echo $linha["assunto"] ?>" placeholder="Digite o assunto" class="form-control input-md" required="" disabled="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtDescricao">Descrição</label>  
  <div class="col-md-5">
  <textarea name="txtDescricao" id="txtDescricao" placeholder="Preencha com a descrição aqui" class="form-control input-md" required="" disabled=""><?php echo $linha["descricao"]?></textarea>
  </div>
</div>

<div class="form-group">
<form name="cadastro" id="cadastro" method="POST" action="../op/insere_arq.php?cod=<?php echo $cod?>" enctype="multipart/form-data">
  <label class="col-md-4 control-label" for="txtFile">Selecione arquivo(s)...</label>
  <div class="col-md-5">
    <input type="file" name="arquivo" id="txtFile" value="" class="form-control">
  <button type="submit" id="btnEnviar" name="btnEnviar" class="btn btn-success"><span style="color: #FFF; font-size: 22px;" class="glyphicon glyphicon-floppy-disk
glyphicon glyphicon-flo" alt='Imprimir' data-toggle="tooltip_gravar" title ='Gravar arquivo'></span></button>
  </div>
</div>
</form>

<div id="btn_imprimir">
  <a href='../rel/relat.php?cod=<?php echo $cod ?>' target='_blank'><span style="color: #2E2EFE;font-size: 32px;" class="glyphicon glyphicon-print" alt='Imprimir' data-toggle="tooltip_imprimir" title ='Imprimir capa do processo'></span></a>
</div>
<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-8">
         
    <a href="encaminhamento_proc.php" class="btn btn-warning" role="button" style="position: relative; left:165px;">Encaminhar processo</a>    
     
    <!--<input type="button" id="btnFechar" name="btnFechar" value="Fechar" class="btn btn-danger" onclick="javascript:location.href='../index.php'">-->
  </div>
</div>

</fieldset>

</body>
</html>
