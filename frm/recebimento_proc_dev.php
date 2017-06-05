<?php
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);
// =====================================
session_start();
require_once "check.php";
include "_navegacao.php";

//$cod = $_GET["cod"];

// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
require_once "../config/init.php";

// Executa a instrução SQL para selectionar todos os registros
$setor = $_SESSION['user_setor'];

$sql2_query = mysqli_query($link,"SELECT s.cod_setor AS cod_setor FROM setor s WHERE s.setor = '".$setor."'");
$r = mysqli_fetch_array($sql2_query);
$scod = $r["cod_setor"];


$sql_query = mysqli_query($link,"SELECT p.cod AS cod, p.tipo, r.nome AS nome, s.setor, DATE_FORMAT(d.data_env,'%d/%m/%Y') AS data, d.horas_env AS horas FROM  proc p, req r, setor s, devolucao d 
WHERE p.cod = d.cod_prdev AND r.cod = d.cod_rqdev AND s.cod_setor = d.cod_stdev AND d.`status`!='1'AND s.cod_setor = '".$scod."'");

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title></title>
    
    <!-- Bootstrap -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../lib/jquery/jquery-1.12.4.js" type="text/javascript"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../lib/smartpaginator/js/smartpaginator.js" type="text/javascript"></script>
    <link href="../lib/smartpaginator/css/smartpaginator.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#pag-1').smartpaginator({ totalrecords: 50, recordsperpage: 5, datacontainer: 'mt', dataelement: 'tr', initval: 0, length: 5, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', go:'Go',theme: 'black' });

            $('#green').smartpaginator({ totalrecords: 10, recordsperpage: 3, datacontainer: 'mt', dataelement: 'tr', initval: 0, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', theme: 'green' });

            $('#red').smartpaginator({ totalrecords: 32, recordsperpage: 4, length: 4, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', theme: 'red', controlsalways: true, onchange: function (newPage) {
                $('#r').html('Page # ' + newPage);
            }
            });
        });
      
    </script>
    
</head>
<body>
<div class="page-header">
  <h1>Recebimento de Processos Devolvidos</h1>
</div>
<div class="form-group">

<form name="cadastro" id="cadastro" method="POST">
  <label class="col-md-4 control-label" for="txtDescricao"></label>  
     <table id="mt" cellpadding="0" cellspacing="0" border="0" class="table">
      <tr>
        <th align='center' valign='middle'  bgColor='#666666'><font color='#FFF'>Nº Proc.</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Nome requerente</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Tipo processo</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Data do envio</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Horas do envio</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Setor de destino</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Ação</th>
      </tr>
        <?php while ($array = mysqli_fetch_array($sql_query)) { 
        
      if ($array["tipo"]=='PI') $ptipo = "Processo Interno";
      if ($array["tipo"]=='PE') $ptipo = "Processo Externo";
      if ($array["tipo"]=='OT') $ptipo = "Outros";

        $cod = $array["cod"];
        $req = $array["nome"];
        $tipo = $ptipo;
        $data = $array["data"];
        $horas = $array["horas"];
        $setor = $array["setor"];
        ?>
      <tr>
        <td><?php echo $cod ?></td>
        <td><?php echo $req ?></td>
        <td><?php echo $tipo ?></td>
        <td><?php echo $data ?></td>
        <td><?php echo $horas ?></td>
        <td><?php echo $setor ?></td>
        <td><a href='/prot/op/receber_proc_dev.php?cod=<?php echo $cod ?>'><span style="color: #088A08;font-size: 28px;" class="glyphicon glyphicon-ok" alt='Receber' title='Receber processo'></span></a></td>
      </tr>
      <?php } ?>
    </table>
    <div id="pag-1" style="margin: auto;"></div>
    </div>
</div>
</form>
</body>
</html>
