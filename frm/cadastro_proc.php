<?php
session_start();
require_once "check.php";
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
$sql_query = mysqli_query($link,"SELECT s.* FROM setor s");

mysqli_close($link);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>E-Protocol 1.0</title>
	<!--<link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../lib/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="../lib/datatables/css/dataTables.bootstrap.min.css">
	<script src="../lib/jquery/jquery-1.12.4.js"></script>
  <script src="../lib/jquery/jquery-ui.js"></script>		
	<script src="../lib/jusuario.js"></script>
  <!--<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">-->
	</script>
	<script type="text/javascript" language="javascript" src="../lib/datatables/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" class="init">

$( function() {
    $( "#frmModalPesquisa" ).dialog({
      autoOpen: false,
      height: 500,
      width: 1100,
      modal: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#frmModalPesquisa" ).dialog( "open" );
    });
  } );

	</script>
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
        <h1>Cadastro de Processos</h1>
</div>

<form name="cadastro" id="cadastro" method="POST" action="../op/cadastrar_proc.php?cod=<?php echo $cod?>" enctype="multipart/form-data">
<fieldset>

<div class="form-group">
  <label class="col-md-4 control-label" for="btnReq"></label>
  <div class="col-md-8">
   <!--<button type="button" id="btn" name="btn" value="" class="btn btn-primary" onclick="javascript:location.href='../op/pesquisar_req.php?p=1'">Selecione o Requerente </button>-->
   <button type="button" id="opener" name="btnReq" class="btn btn-info" data-toggle="modal" data-target="#janela">
        Selecione o Requerente
   </button>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtTipo">Tipo</label>
  <div class="col-md-5">
     <select name="txtTipo" id="txtTipo" class="form-control">
        <option>Selecione...</option>
        <option value="PI">Processo Interno</option>
        <option value="PE">Processo Externo</option>
        <option value="OT">Outros</option>
     </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtSetor">Informe o setor de origem</label>
  <div class="col-md-5">
     <select name="txtSetor" id="txtSetor" class="form-control">
      <option value="">Selecione...</option>
        <?php while ($array = mysqli_fetch_array($sql_query)) { 
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
  <input type="text" name="txtAssunto" id="txtAssunto" value="" placeholder="Digite o assunto" class="form-control input-md" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtDescricao">Descrição</label>  
  <div class="col-md-5">
  <textarea name="txtDescricao" id="txtDescricao" placeholder="Preencha com a descrição aqui" class="form-control input-md" required=""></textarea>
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
<div id="frmModalPesquisa" title="Pesquisa de requerentes">
<div>
    <h1>Pesquisar requerentes
        <a href="cadastro_req.php" class="btn btn-primary pull-right menu"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Novo requerente</a>
    </h1>  
</div>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th align='center' bgColor='#666666'><font color='#FFF'>Nome</th>
            <th align='center' bgColor='#666666'><font color='#FFF'>Tipo</th>
            <th align='center' bgColor='#666666'><font color='#FFF'>CPF</th>
            <th align='center' bgColor='#666666'><font color='#FFF'>Sexo</th>
            <th align='center' bgColor='#666666'><font color='#FFF'>Telefone</th>
            <th align='center' bgColor='#666666'><font color='#FFF'>Celular</th>
            <th align='center' bgColor='#666666'><font color='#FFF'>Recados</th>
            <th align='center' bgColor='#666666'><font color='#FFF'>Email</th>               
            <th align='center' bgColor='#666666'><font color='#FFF'>Ações</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        <tr>
            <th width='220' align='center' valign='middle' bgColor='#DDDDDD'>Nome</th>
            <th width='120' align='center' valign='middle' bgColor='#DDDDDD'>Tipo</th>
            <th width='120' align='center' valign='middle' bgColor='#DDDDDD'>CPF</th>
            <th width='120' align='center' valign='middle' bgColor='#DDDDDD'>Sexo</th>
            <th width='120' align='center' valign='middle' bgColor='#DDDDDD'>Telefone</th>
            <th width='120' align='center' valign='middle' bgColor='#DDDDDD'>Celular</th>
            <th width='120' align='center' valign='middle' bgColor='#DDDDDD'>Recados</th>
            <th width='220' align='center' valign='middle' bgColor='#DDDDDD'>Email</th>                   
            <th width='' align='center' valign='middle' bgColor='#DDDDDD'>Ações</th>
        </tr>
        </tfoot>
    </table>    	
</div>

</body>
</html>