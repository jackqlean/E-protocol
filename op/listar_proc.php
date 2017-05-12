<!DOCTYPE HTML>
 <html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Listar Processos</title>

<link rel="stylesheet" href="../css/bootstrap.min.css">
<script type="text/javascript" src="js/scripts.js"></script>

</head>
<body>

<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "../config/init.php";
require_once "../config/functions.php";

$p = 1;
if(isset($p)) $p = $_GET["p"];

// ===========================================================================================
// Defina aqui a quantidade máxima de registros por página.
$qnt = 3;
// O sistema calcula o início da seleção calculando: 
// (página atual * quantidade por página) - quantidade por página
$inicio = ($p*$qnt) - $qnt;

$sql_select = "SELECT * FROM proc LIMIT $inicio, $qnt";

$sql_query = mysqli_query($link, $sql_select);

?>

<center> 
	<table border="0" bordercolor="red"> 
	       
		<tr> 
			<td align='center' bgColor="#666666"><font color="#CCCCCC"> <b> CODIGO </b></td>
			<td align='center' bgColor="#666666"><font color="#CCCCCC"> <b> TIPO </b></td>
			<td align='center' bgColor="#666666"><font color="#CCCCCC"> <b> ASSUNTO </b></td>
			<td align='center' bgColor="#666666"><font color="#CCCCCC"> <b> DESCRICAO </b></td> 
			<td align='center' bgColor="#666666"><font color="#CCCCCC"></td>
			<!--<td align='center' bgcolor="#666666"><font color="#CCCCCC"> <b><a href='/prot/frm/cadastro_proc.php'><img width='12' height='13' src='/prot/img/button_insere.png' alt='Cadastrar' title='Cadastrar Processo' border='0' /></a></td>-->
			<td align='center' bgcolor="#666666"><font color="#CCCCCC"></td>              
			<td align='center' bgcolor="#666666"><font color="#CCCCCC"></td> 
		</tr>

	<?php       				       			
	// Cria um while para pegar as informações do BD

	while($array = mysqli_fetch_array($sql_query)) {

	// Variável para capturar o campo 'nome' no banco de dados

		$cod = $array["cod"];
		$tipo = $array["tipo"];
		$assunto = $array["assunto"];
		$descricao = $array["descricao"];
		
		if ($tipo=='PI') $ftipo = "Processo Interno";
		if ($tipo=='PE') $ftipo = "Processo Externo";
		if ($tipo=='OT') $ftipo = "Outros";
	
		?>

		<tr>
			<td width="40" align='center' valign='middle' bgcolor='#DDDDDD'><b> <?php echo $cod ?> </b></td>
			<td width="120" align='center' bgColor="#DDDDDD"><b> <?php echo $ftipo ?></b></td>
			<td width="220" align='center' bgColor="#DDDDDD"><b> <?php echo $assunto ?> </b></td>
			<td width="220" align='center' bgColor="#DDDDDD"><b> <?php echo $descricao ?> </b></td> 
			<td width="20" align='center' valign='middle' bgcolor='#DDDDDD'>
				<a href='/prot/frm/alteracao_proc.php?cod=<?php echo $cod ?>'>
					<img width='12' height='13' src='/prot/img/button_edit.png' alt='Editar' title='Editar' border='0' />
				</a>
			</td>
	        <td width=20 align='center' valign='middle' bgcolor='#DDDDDD'>
	        	<a href='/prot/op/deletar_proc.php?cod=<?php echo $cod ?>'>
	        		<img width='12' height='13' src='/prot/img/button_drop.png' alt='Excluir' title='Excluir' border='0' />
	        	</a>
	        </td>
			<td width=20 align='center' valign='middle' bgcolor='#DDDDDD'>
				<a href='/prot/op/exibir_proc.php?cod=<?php echo $cod ?>'>
					<img width='12' height='13' src='/prot/img/seleciona.png' alt='Selecionar Processo' title='Selecionar Processo' border='0' />
				</a>
			</td>              
		</tr>
	                  
	<?php } ?>

	</table>
</center>

<!-- // Depois que selecionou todos os nome, pula uma linha para exibir os links(próxima, última...) -->
<br />

<?php
// Faz uma nova seleção no banco de dados, desta vez sem LIMIT, 
// para pegarmos o número total de registros
$sql_select_all = "SELECT * FROM proc";
// Executa o query da seleção acimas
$sql_query_all = mysqli_query($link,$sql_select_all);
// Gera uma variável com o número total de registros no banco de dados
$total_registros = mysqli_num_rows($sql_query_all);
// Gera outra variável, desta vez com o número de páginas que será precisa. 
// O comando ceil() arredonda 'para cima' o valor
$pags = ceil($total_registros/$qnt);
// Número máximos de botões de paginação
$max_links = 3;
// Exibe o primeiro link 'primeira página', que não entra na contagem acima(3)
echo "<p align='center'> <a href='listar_proc.php?p=1' target='_self'>primeira p&aacute;gina</a> ";

// Cria um for() para exibir os 3 links antes da página atual
for($i = $p-$max_links; $i <= $p-1; $i++) {
	// Se o número da página for menor ou igual a zero, não faz nada
	// (afinal, não existe página 0, -1, -2..)
	if($i > 0) { echo "<a href='listar_proc.php?p=".$i."' target='_self'>".$i."</a> "; } 
}
// Exibe a página atual, sem link, apenas o número
echo $p." ";
// Cria outro for(), desta vez para exibir 3 links após a página atual
for($i = $p+1; $i <= $p+$max_links; $i++) {
// Verifica se a página atual é maior do que a última página. Se for, não faz nada.
	if($i <= $pags){ echo "<a href='listar_proc.php?p=".$i."' target='_self'>".$i."</a> "; }
}
// Exibe o link "última página"
echo "<a href='listar_proc.php?p=".$pags."' target='_self'>ultima p&aacute;gina</a> ";

?>
</body>
</html>
