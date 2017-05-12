<!DOCTYPE HTML>
 <html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Pesquisar requerentes</title>

<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<?php

header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

// ===========================================================================================
// JACK: isset faz uma verificação de variáveis, se não estiver criada aparecerá um erro na tela
// JACK: poderia ser feito tamb�m com "@$pesquisa = $_POST ["pesquisa"]" assim o @ ignora

$pesquisa	= (isset($_POST ["pesquisa"]) ? $_POST ["pesquisa"] : "");
$p_campo	= (isset($_POST ["p_campo"]) ? $_POST ["p_campo"] : "");

require_once "../config/init.php";

$p = 1;
if(isset($p)) $p = $_GET["p"];

// ===========================================================================================
// Defina aqui a quantidade máxima de registros por página.
$qnt = 3;
// O sistema calcula o início da seleção calculando:
// (página atual * quantidade por página) - quantidade por página
$inicio = ($p*$qnt) - $qnt;
// Seleciona no banco de dados com o LIMIT indicado pelos números acima
//if ($pesquisa ==""){
//$sql_select = "SELECT * FROM req LIMIT $inicio, $qnt";
//}else{
//$sql_select = "SELECT * FROM req WHERE $p_campo LIKE '%$pesquisa%' LIMIT $inicio, $qnt";
//}
// JACK: Versão resumida da mesma função acima,
$sql_select = "SELECT * FROM req LIMIT $inicio, $qnt";
if ($pesquisa <> "") $sql_select = "SELECT * FROM req WHERE $p_campo LIKE '%$pesquisa%' LIMIT $inicio, $qnt";
// Executa o Query

$sql_query = mysqli_query($link, $sql_select);

// ===========================================================================================
// JACK: Mais fácil você intercalar os códigos do que colocar tudo como "echo", fica mais fácil ver se não tem problema de aspas faltando
?>
<form id="pesquisar" name="pesquisar" method="post" action="">
	<center>
		<table width="744" border="0">
			<tr>
				<td width="65">
					<span >Pesquisa:</span>
				</td>

				<td width="320">
					<input name="pesquisa" type="text" id="pesquisa" size="45" maxlength="45" class="campos"/>
				</td>

				<td width="190">
					<select name="p_campo" id="p_campo" class="campos">
						<option value="nome">Nome</option>
						<option value="email">E-mail</option>
					</select>
				</td>

				<td width="25"></td>

				<td width="115">
					<input name="btn_pesquisa" type="submit" id="btn_pesquisar" value="Efetuar pesquisa" />
				</td>

				<td width="0"></td>

				<td width="25"></td>

				<td width="115">
					<input name="btn_retornar" type="button" id="btn_retornar" value="Retornar..." onclick="javascript:location.href='../index.php'"/>
				</td>

				<td width="0"></td>
			</tr>
		</table>
	</center>
</form>

<center>
	<table border="0" bordercolor="red">

		<tr>
			<td align='center' bgColor="#666666"><font color="#CCCCCC"> <b> NOME </b></td>
			<td align='center' bgColor="#666666"><font color="#CCCCCC"> <b> TIPO </b></td>
			<td align='center' bgColor="#666666"><font color="#CCCCCC"> <b> EMAIL </b></td>
			<td align='center' bgcolor="#666666"><font color="#CCCCCC"> <b><a href='/prot/frm/cadastro_req.php'><img width='12' height='13' src='/prot/img/button_insere.png' alt='Cadastrar' title='Cadastrar' border='0' /></a></td>
			<td align='center' bgcolor="#666666"><font color="#CCCCCC"> <b> </b></td>
			<td align='center' bgcolor="#666666"><font color="#CCCCCC"> <b> </b></td>
		</tr>

	<?php
	// Cria um while para pegar as informações do BD

	while($array = mysqli_fetch_array($sql_query)) {

	// Variável para capturar o campo 'nome' no banco de dados

		$cod = $array["cod"];
		$nome = $array["nome"];
		$tipo = $array["tipo"];
		$email = $array["email"];

		// ===========================================================================================

		if ($tipo=='F') $ftipo = "Pessoa Fisica";
		if ($tipo=='J') $ftipo = "Pessoa Juridica";
		if ($tipo=='S') $ftipo = "Servidor Publico";

	// Exibe o nome que está no BD e pula uma linha

		
?>

		<tr>
			<td width="320" align='center' bgColor="#DDDDDD"><b> <?php echo $nome ?> </b></td>
			<td width="120" align='center' bgColor="#DDDDDD"><b> <?php echo $ftipo ?></b></td>
			<td width="300" align='center' bgColor="#DDDDDD"><b> <?php echo $email ?> </b></td>
			<td width="20" align='center' valign='middle' bgcolor='#DDDDDD'>
				<a href='/prot/frm/alteracao_req.php?cod=<?php echo $cod ?>'>
					<img width='12' height='13' src='/prot/img/button_edit.png' alt='Editar' title='Editar' border='0' />
				</a>
			</td>
	        <td width=20 align='center' valign='middle' bgcolor='#DDDDDD'>
	        	<a href='/prot/op/deletar_req.php?cod=$cod'>
	        		<img width='12' height='13' src='/prot/img/button_drop.png' alt='Excluir' title='Excluir' border='0' />
	        	</a>
	        </td>
			<td width=20 align='center' valign='middle' bgcolor='#DDDDDD'>
				<a href='/prot/frm/cadastro_proc.php?cod=<?php echo $cod ?>'>
					<img width='12' height='13' src='/prot/img/requerente.png' alt='Inserir cadastro' title='Inserir requerente' border='0' />
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
$sql_select_all = "SELECT * FROM req";
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
echo "<p align='center'> <a href='pesquisar_req.php?p=1' target='_self'>primeira p&aacute;gina</a> ";

// Cria um for() para exibir os 3 links antes da página atual
for($i = $p-$max_links; $i <= $p-1; $i++) {
	// Se o número da página for menor ou igual a zero, não faz nada
	// (afinal, não existe página 0, -1, -2..)
	if($i > 0) { echo "<a href='pesquisar_req.php?p=".$i."' target='_self'>".$i."</a> "; }
}
// Exibe a página atual, sem link, apenas o número
echo $p." ";
// Cria outro for(), desta vez para exibir 3 links após a página atual
for($i = $p+1; $i <= $p+$max_links; $i++) {
// Verifica se a página atual é maior do que a última página. Se for, não faz nada.
	if($i <= $pags){ echo "<a href='pesquisar_req.php?p=".$i."' target='_self'>".$i."</a> "; }
}
// Exibe o link "última página"
echo "<a href='pesquisar_req.php?p=".$pags."' target='_self'>ultima p&aacute;gina</a> ";

?>
</body>
</html>
