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

$cod = $_GET["cod"];

//Consultas "União" das tabelas proc e req (processos e setor).
$sql_query = mysqli_query($link,"SELECT s.cod_setor, s.setor AS desc_setor, p.setor FROM setor s, proc p WHERE s.cod_setor = p.setor AND p.cod = '".$cod."'");

//Consulta todos os registros da tabela proc (processos).
$sql2_query = mysqli_query($link,"SELECT p.cod,  p.tipo, p.assunto, p.descricao, DATE_FORMAT(p.data,'%d/%m/%Y') AS data , p.horas AS horas FROM proc p WHERE p.cod = '".$cod."'");

//Consulta a tabela requentes pelo código do processo
$sql3_query = mysqli_query($link,"SELECT r.nome FROM req r , proc p WHERE r.cod = p.cod_req AND p.cod = '".$cod."'");

//Consulta arquivos pelo código do processo
$sql4_query = mysqli_query($link,"SELECT a.arquivo, p.cod FROM itens_arq a, proc p WHERE a.cod_proc = p.cod AND p.cod = '".$cod."'");

//Consulta horas, data e usuario da tabela proc (processos).
$sql5_query = mysqli_query($link,"SELECT  DATE_FORMAT(p.data,'%d/%m/%Y') AS data , p.horas AS horas, u.name AS usuario FROM proc p, users u WHERE p.user_id = u.id AND p.cod = '".$cod."'");

//Consulta horas de envio, data de envio e usuario de envio do processo na tabela proc,
//.
$sql6_query = mysqli_query($link,"SELECT p.cod , u.name AS usuario_env , s.setor AS setor_env, DATE_FORMAT(e.data_env,'%d/%m/%Y') AS data_env FROM proc p, setor s, users u, encaminhamento e WHERE  e.user_env = u.id AND e.cod_stenv = s.cod_setor AND e.cod_prenc = p.cod AND p.cod ='".$cod."'");

//Consulta horas de recebimento, data do 
// recebimento e usuario de recebimento da tabela proc (processos).
$sql7_query = mysqli_query($link,"SELECT p.cod , u.name AS usuario_rec , s.setor AS setor_dst , DATE_FORMAT(e.data_rec,'%d/%m/%Y') AS data_rec FROM proc p, setor s, users u, encaminhamento e WHERE e.user_rec = u.id AND e.cod_stdst = s.cod_setor AND e.cod_prenc = p.cod AND p.cod='".$cod."'");

$sql8_query = mysqli_query($link,"SELECT p.cod , u.name AS usuario_env , s.setor AS setor_env, DATE_FORMAT(d.data_env,'%d/%m/%Y') AS data_env FROM proc p, setor s, users u, devolucao d WHERE  d.user_env = u.id AND d.cod_storg = s.cod_setor AND d.cod_prdev = p.cod AND p.cod ='".$cod."'");

  $sql9_query = mysqli_query($link,"SELECT p.cod , u.name AS usuario_rec , s.setor AS setor_dst , DATE_FORMAT(d.data_rec,'%d/%m/%Y') AS data_rec FROM proc p, setor s, users u, devolucao d WHERE d.user_rec = u.id AND d.cod_stdev = s.cod_setor AND d.cod_prdev = p.cod AND p.cod='".$cod."'");

$sql10_query = mysqli_query($link,"SELECT e.status AS status FROM encaminhamento e, proc p WHERE e.cod_prenc = p.cod AND p.cod ='".$cod."'");
 
$sql11_query = mysqli_query($link,"SELECT d.status AS status FROM devolucao d, proc p WHERE d.cod_prdev = p.cod AND p.cod ='".$cod."'");
 
// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);
?>

<!DOCTYPE HTML>
 <html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Detalhes do Processo</title>

    <meta name="description" content="">
    <meta name="author" content="Jaquison Quintao Leandro">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
    <!-- Bootstrap -->
        
    <script type="text/javascript">
      $(function () {
        $('[data-toggle="tooltip_imprimir"]').tooltip()
        $('[data-toggle="tooltip_download"]').tooltip()
        $('[data-toggle="tooltip_detalhe_env"]').tooltip()
        $('[data-toggle="tooltip_detalhe_rec"]').tooltip()
      })
    </script>

</head>
<body>

<div class="page-header">
  <h1>Detalhes do Processo</h1>
</div>

<form name="cadastro" id="cadastro" method="POST" action="../frm/detalhe_proc.php?cod=<?php echo $cod?>" enctype="multipart/form-data">
<?php $plinha = mysqli_fetch_array($sql2_query)?>
<fieldset>

<?php $rlinha = mysqli_fetch_array($sql3_query)?>

<div class="form-group">
<label class="col-md-4 control-label" for="txtCod">Protocolo nº</label>
  <label class="col-md-5 control-label" /><span style="font-family: Arial; font-size: 28px; font-style:italic; color:#000000;"><?php echo $plinha["cod"] ?></span></label>
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
     if ($plinha["tipo"]=='PI') $ptipo = "Processo Interno";
     if ($plinha["tipo"]=='PE') $ptipo = "Processo Externo";
     if ($plinha["tipo"]=='OT') $ptipo = "Outros";
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
  <label class="col-md-4 control-label" for="txtDtCad">Data do cadastro</label>  
  <div class="col-md-5">
  <input type="text" name="txtDtCad" id="txtDtCad" value="<?php echo $plinha["data"] ?>" class="form-control input-md" required="" disabled="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtAssunto">Assunto</label>  
  <div class="col-md-5">
  <input type="text" name="txtAssunto" id="txtAssunto" value="<?php echo $plinha["assunto"] ?>" placeholder="Digite o assunto" class="form-control input-md" required="" disabled="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtDescricao">Descrição</label>  
  <div class="col-md-5">
  <textarea name="txtDescricao" id="txtDescricao" placeholder="Preencha com a descrição aqui" class="form-control input-md" required="" disabled=""><?php echo $plinha["descricao"]?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="txtFile">Anexo(s)...</label>
  <div class="col-md-5">
<table cellpadding="0" cellspacing="0" border="0" class="table">
      <tr>
      <th align='center' bgColor='#666666'><font color='#FFF'>Arquivo</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Ação</th>
      </tr>
        <?php while ($array = mysqli_fetch_array($sql4_query)) { 
        
        $arquivo = $array["arquivo"];
        ?>
      <tr>
        <td><?php echo $arquivo ?></td>
        <td><a href='/prot/uploads/<?php echo $arquivo ?>' target="_blank"><span style="color: #FF8000;font-size: 28px;" class="glyphicon glyphicon-floppy-save" alt='Download' data-toggle="tooltip_download" title='Download do arquivo'></span></a></td>
      </tr>
      <?php } ?>
    </table>    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" >Histórico do processo</label>
  <div class="col-md-5">
<table cellpadding="0" cellspacing="0" border="0" class="table">
      <tr>
      <th align='center' bgColor='#666666'><font color='#FFF'>Data do cadastro</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Horas do cadastro</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Usuário do cadastro</th>
      </tr>
        <?php $array = mysqli_fetch_array($sql5_query); 
        
        $data = $array["data"];
        $horas = $array["horas"];
        $usuario = $array["usuario"];
        
        ?>
      <tr>
        <td><?php echo $data ?></td>
        <td><?php echo $horas ?></td>
        <td><?php echo $usuario ?></td>
      </tr>
    </table>    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" >Movimentação do processo</label>
  <div class="col-md-5">
<span style="position: absolute; top:80px; left:-30px; color: #088A08;font-size: 26px;" class="glyphicon glyphicon-arrow-right" alt='Enviado' data-toggle="tooltip_detalhe_env" title ='Enviado'></span>
<table cellpadding="0" cellspacing="0" border="0" class="table">
      <tr>
      <th align='center' bgColor='#666666'><font color='#FFF'>Setor de Envio</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Data do envio</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Usuário do envio</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Setor de Destino</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Data do recebimento</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Usuário do recebimento</th>
      <th align='center' bgColor='#666666'><font color='#FFF
      '>Ação</th>
      </tr>
        <?php 
        $m_array = mysqli_fetch_array($sql6_query);         
        $usuario_env = $m_array["usuario_env"];
        $setor_env = $m_array["setor_env"];
        $data_env = $m_array["data_env"];

        $m_array2 = mysqli_fetch_array($sql7_query);         
        $usuario_rec = $m_array2["usuario_rec"];
        $setor_dst = $m_array2["setor_dst"];
        $data_rec = $m_array2["data_rec"];
                
        ?>
        <?php
       $r1 = mysqli_fetch_array($sql10_query);
       $st1 = $r1["status"];
       $permission='disabled = "disabled"';
        
        if ($st1 == "1")
        { $permission = '';
        }else{
          $permission='disabled = "disabled"';
        }
      ?>
      <tr>
        <td><?php echo $setor_env ?></td>
        <td><?php echo $data_env ?></td>
        <td><?php echo $usuario_env ?></td>
        <td><?php echo $setor_dst ?></td>
        <td><?php echo $data_rec ?></td>
        <td><?php echo $usuario_rec ?></td>
        <td><button type="button" class="btn btn-default btn-sm"onclick="window.open('../rel/detalhe.php?cod=<?php echo $cod ?>', '_blank')" <?php echo $permission ?>/> 
        
        <span style="color: #2E2EFE;font-size: 14px;" class="glyphicon glyphicon-print" alt='Imprimir' data-toggle="tooltip_imprimir" title ='Imprimir detalhes do processo'></span>
        </button><td>
      </tr>
      </table>    
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-5">
<span style="position: absolute; top:80px; left:-30px; color: #088A08;font-size: 26px;" class="glyphicon glyphicon-arrow-left" alt='Recebido' data-toggle="tooltip_detalhe_rec" title ='Recebido'></span>
<table cellpadding="0" cellspacing="0" border="0" class="table">
      <tr>
      <th align='center' bgColor='#666666'><font color='#FFF'>Setor de Envio</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Data do envio</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Usuário do envio</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Setor de Destino</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Data do recebimento</th>
      <th align='center' bgColor='#666666'><font color='#FFF'>Usuário do recebimento</th>
      <th align='center' bgColor='#666666'><font color='#FFF
      '>Ação</th>
      </tr>
        <?php 
        $m_array = mysqli_fetch_array($sql8_query);         
        $usuario_env = $m_array["usuario_env"];
        $setor_env = $m_array["setor_env"];
        $data_env = $m_array["data_env"];

        $m_array2 = mysqli_fetch_array($sql9_query);         
        $usuario_rec = $m_array2["usuario_rec"];
        $setor_dst = $m_array2["setor_dst"];
        $data_rec = $m_array2["data_rec"];
      ?>
      <?php
       $r2 = mysqli_fetch_array($sql11_query);
       $st2 = $r2["status"];
       $permission2='disabled = "disabled"';
       
        if ($st2 == "1")
        { $permission2 = '';
        }else{
          $permission2='disabled = "disabled"';
        }
      ?>
      <tr>
        <td><?php echo $setor_env ?></td>
        <td><?php echo $data_env ?></td>
        <td><?php echo $usuario_env ?></td>
        <td><?php echo $setor_dst ?></td>
        <td><?php echo $data_rec ?></td>
        <td><?php echo $usuario_rec ?></td>
        <td>
        <button type="button" class="btn btn-default btn-sm"onclick="window.open('../rel/detalhe_dev.php?cod=<?php echo $cod ?>', '_blank')" 
        <?php echo $permission2 ?>/>
        <span style="color: #2E2EFE;font-size: 14px;" class="glyphicon glyphicon-print" alt='Imprimir' data-toggle="tooltip_imprimir" title ='Imprimir detalhes do processo'></span>
        </button>
        <td>
      </tr>
      </table>    
  </div>
</div>
<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnDevolver_proc"></label>
  <div class="col-md-8">
  
  <!--<button type="submit" id="btnImprimir" name="btnImprimir" class="btn btn-info" onclick="load_Imprimir();">Imprimir capa do processo</button>-->
      
  <input type="button" id="btnFechar" name="btnFechar" value="Fechar" class="btn btn-danger" onclick="javascript:location.href='../index.php'">
  </div>
</div>

</fieldset>
</form>

</body>
</html>
