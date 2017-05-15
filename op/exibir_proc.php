<?php
session_start();
require_once "check.php";
?>
<?php 
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
// =====================================

// Consulta 01 - Faz consulta no banco na tabela proc. Traz como resultado os dados do processo através da chave primária do código do processo 'proc.cod'.
require_once"../config/init.php";
require_once"../config/functions.php";

$cod = $_GET["cod"];

$ARRAY_PROCESSO = [];	
$ARRAY_PROCESSO = consultaProcesso($link);
$proc_cod 		= $ARRAY_PROCESSO[0];
$proc_tipo 		= $ARRAY_PROCESSO[1];
$proc_assunto 	= $ARRAY_PROCESSO[2];
$proc_descricao	= $ARRAY_PROCESSO[3];

// Consulta 02 - Faz consulta no banco nas tabelas proc e req. Traz como resultado os dados do requerente através da chave primária do código do processo 'proc.cod'.

$ARRAY_REQ = [];	
$ARRAY_REQ = consultaNome($link);
$req_nome 		= $ARRAY_REQ[0];
$rtipo 		= $ARRAY_REQ[1];
$req_cpf	 	= $ARRAY_REQ[2];
$rsexo 		= $ARRAY_REQ[3];
$req_tel	 	= $ARRAY_REQ[4];
$req_cel	 	= $ARRAY_REQ[5];
$req_rec	 	= $ARRAY_REQ[6];
$req_email	 	= $ARRAY_REQ[7];

// Consulta 03 - Faz consulta no banco nas tabelas ob , itens_proc e proc. Traz como resultado as obrigações de determinado
// processo através da chave primária do código do processo 'proc.cod'.

$sql1_query = mysqli_query($link,"SELECT ob.titulo, ob.tipo FROM proc INNER JOIN itens_proc ON proc.cod = itens_proc.cod_proc INNER JOIN ob ON itens_proc.cod_ob = ob.cod WHERE proc.cod = '".$cod."'");

// Consulta 04 - Faz consulta no banco nas tabelas ob , itens_proc e proc. Traz como resultado as obrigações de determinado
// processo através da chave primária do código do processo 'proc.cod'.

$sql2_query = mysqli_query($link,"SELECT a.* FROM itens_arq a WHERE a.cod_proc = '".$cod."'");

// Fecha a conexão com o servidor para poupar recursos de processamento
desconecta($link);

?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Página de Exibição</title>

    <meta name="description" content="">
    <meta name="author" content="Jaquison Quintao Leandro">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
   	<link rel="stylesheet" href="../css/bootstrap.min.css">
   	<script type="text/javascript" src="../js/bootsrap.min.js"></script>
</head>
<body>

<h2>Protocolo</h2>
	<?php 
	echo "<h1>".$proc_cod. "</h1>"; 
	echo "<br />";
	echo "Tipo: <h2>".$ptipo."</h2>";
	echo "<br />";
	echo "Assunto: <h3>".$proc_assunto."</h3>";
	echo "<br />";
	echo "Descrição: <h3>".$proc_descricao."</h3>";
	?>

<h2>Dados do requerente</h2>
	<table border="1" bordercolor="#000">
		<tr>	
			<td align='center' bgColor="#666666"><font color="#FFF">Nome</td>
			<td align='center' bgColor="#666666"><font color="#FFF">Tipo</td>
			<td align='center' bgColor="#666666"><font color="#FFF">CPF</td>
			<td align='center' bgColor="#666666"><font color="#FFF">Sexo</td>
			<td align='center' bgColor="#666666"><font color="#FFF">Telefone</td>
			<td align='center' bgColor="#666666"><font color="#FFF">Celular</td>
			<td align='center' bgColor="#666666"><font color="#FFF">Recados</td>
			<td align='center' bgColor="#666666"><font color="#FFF">Email</td>
		</tr>
		<tr>	
			<td width="220" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $req_nome ?></td>
			<td width="120" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $rtipo ?></td>
			<td width="120" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $req_cpf ?></td>
			<td width="120" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $rsexo ?></td>
			<td width="120" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $req_tel ?></td>
			<td width="120" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $req_cel ?></td>
			<td width="120" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $req_rec ?></td>
			<td width="220" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $req_email ?></td>
		</tr>
		
	</table>	

	<h2>Obrigações</h2>
	<table border="1" bordercolor="#000">
		<tr>	
			<td align='center' bgColor="#666666"><font color="#FFF">Tipo</td>
			<td align='center' bgColor="#666666"><font color="#FFF">Obrigações</td>
		</tr>
	<?php while ($array = mysqli_fetch_array($sql1_query)) { 
		$ob_tipo = $array["tipo"];
		$ob_titulo = $array["titulo"];
		
		if ($ob_tipo=="D") $obtipo = "Documento";
		if ($ob_tipo=="G") $obtipo = "Guia";
		?>
	<tr>	
			<td width="120" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $obtipo ?></td>
			<td width="120" align='center' valign='middle' bgColor="#DDDDDD"><?php echo $ob_titulo ?></td>
		</tr>
	<?php } ?>
	</table>	

<h3>Anexo de arquivos</h3>

<table border="1" bordercolor="#000">	
	
	<tr>
	<td align='center' bgColor="#666666"><font color="#FFF">Arquivo(s)</font></td>
	<td align='center' bgColor="#666666"><font color="#FFF">Ação</font></td>
	</tr>

	<?php while ($array = mysqli_fetch_array($sql2_query)) { 
		$arquivos = $array["arquivo"];
	?>
	<tr>	
	<td width="120" align='center' valign='middle' bgcolor='#DDDDDD'><?php echo $arquivos ?></td>
	<td width="60" align='center' valign='middle' bgcolor='#DDDDDD'><a href='../uploads/<?php echo $arquivos ?>'>
		<img width='12' height='13' src='/prot/img/download.png' alt='Baixar arquivo' title='Baixar arquivo' border='0' /></a>
	</td>
	</tr>
	<?php } ?>
</table>	

<form name="op_proc" id="op_proc">
	<input type="button" name="btn_01" id="btn_ins" value="Inserir Obrigações" onclick="javascript:location.href='listar_ob.php?p=1&cod=<?php echo $cod ?>'">
	<input type="button" name="btn_02" id="btn_an" value="Anexar arquivos" onclick="javascript:location.href='seleciona_arq.php?cod=<?php echo $cod ?>'">
	<input type="button" name="btn_03" id="btn_imp" value="Imprimir capa do processo" onclick="javascript:location.href='../rel/relat.php?cod=<?php echo $cod ?>'">
	<input type="button" name="btn_04" id="retorno" value="Retornar ao inicio" onclick="javascript:location.href='../index.php'">
</form>

</body>

</html>
