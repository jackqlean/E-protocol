<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<title></title>
	<!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../lib/smartpaginator/js/smartpaginator.js" type="text/javascript"></script>
    <link href="../lib/smartpaginator/css/smartpaginator.css" rel="stylesheet" type="text/css" />
	
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#pag-1').smartpaginator({ totalrecords: 50, recordsperpage: 5, datacontainer: 'mt-1', dataelement: 'tr', initval: 0, length: 5, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', go:'Go',theme: 'black' });

            $('#green').smartpaginator({ totalrecords: 10, recordsperpage: 3, datacontainer: 'mt', dataelement: 'tr', initval: 0, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', theme: 'green' });

            $('#red').smartpaginator({ totalrecords: 32, recordsperpage: 4, length: 4, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', theme: 'red', controlsalways: true, onchange: function (newPage) {
                $('#r').html('Page # ' + newPage);
            }
            });
        });
      
    </script>

	</head>
	<body>
		
<?php
	session_start();
    require_once "check.php";
    //recebemos nosso par�metro vindo do form
	$parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
	
	$cod = (int) $parametro;
	$user_id = $_SESSION['user_id'];  

// Realiza a conex�o com o servidor
// Coloca as informa��es da conex�o na vari�vel $link
require_once "../config/init.php";

$sql0_query = mysqli_query($link,"SELECT u.permission AS permissao FROM users u WHERE u.id ='".$user_id."'");

$r0 = mysqli_fetch_array($sql0_query);
       $p0 = $r0["permissao"];

if ($p0 == "0"){
$sql_query = mysqli_query($link,"SELECT p.cod, r.nome, p.tipo, DATE_FORMAT(p.data,'%d/%m/%Y') AS data, p.horas,s.setor AS setor FROM proc p, req r, setor s WHERE p.cod_req = r.cod
AND s.cod_setor = p.setor AND p.user_id = '".$user_id."' ORDER BY cod ASC");
}
else
{
$sql_query = mysqli_query($link,"SELECT p.cod, r.nome, p.tipo, DATE_FORMAT(p.data,'%d/%m/%Y') AS data, p.horas,s.setor AS setor FROM proc p, req r, setor s WHERE p.cod_req = r.cod
AND s.cod_setor = p.setor ORDER BY cod ASC");
}

if ($parametro <> "") $sql_query = mysqli_query($link,"SELECT p.cod, r.nome, p.tipo, DATE_FORMAT(p.data,'%d/%m/%Y') AS data, p.horas,s.setor AS setor FROM proc p, req r, setor s WHERE p.cod_req = r.cod
AND s.cod_setor = p.setor AND p.cod = '".$cod."' ORDER BY cod ASC");
// Fecha a conex�o com o servidor para poupar recursos de processamento
mysqli_close($link);	
?>
<form name="cadastro" id="cadastro" method="POST">
<table id="mt-1" cellpadding="0" cellspacing="0" border="0" class="table">
      <tr>
        <th align='center' valign='middle'  bgColor='#666666'><font color='#FFF'>N. Proc.</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Nome requerente</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Tipo processo</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Data do cadastro</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Horas do cadastro</th>
        <th align='center' bgColor='#666666'><font color='#FFF'>Setor de origem</th>
        <th align='center' bgColor='#666666'><font color='#FFF'></th>
        <th align='center' bgColor='#666666'><font color='#FFF'></th>
      </tr>
        <?php while ($array = mysqli_fetch_array($sql_query)) { 
        
      if ($array["tipo"]=='PI') $ptipo = "Protocolo Interno";
      if ($array["tipo"]=='PE') $ptipo = "Protocolo Externo";
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
        <td><a href='/prot/frm/alteracao_proc.php?cod=<?php echo $cod ?>'><span style="color: #F49522;font-size: 18px;" class="glyphicon glyphicon-pencil" alt='Editar' title='Editar'></span></a></td>
        <td><a href='/prot/frm/detalhe_proc.php?cod=<?php echo $cod ?>'><span style="color: #20D53B;font-size: 18px;" class="glyphicon glyphicon-sunglasses" alt='Detalhar processo' title='Detalhar processo'></span></a></td>
      </tr>
      <?php } ?>
    </table>
</form>
<div id="pag-1" style="margin: auto;"></div>
</body>
</html>