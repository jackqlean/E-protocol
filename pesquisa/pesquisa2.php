<?php

// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);

// =====================================
// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
require_once "../config/init.php";

//recebemos nosso parâmetro vindo do form
$pesquisa = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;

$sql_query = mysqli_query($link, "SELECT * FROM req WHERE nome LIKE '$pesquisa%' ORDER BY nome ASC");

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title></title>
    
</head>
<body>
<?php	
	$msg = "";
	//começamos a concatenar nossa tabela
	$msg .="<table cellpadding='0' cellspacing='0' border='1' bordercolor='#000' class='table'>";
	$msg .="<thead>";
	$msg .="<tr class='header'>";
	$msg .="<th align='center' bgColor='#666666'><font color='#FFF'>Nome</th>";
	$msg .="<th align='center' bgColor='#666666'><font color='#FFF'>Tipo</th>";
	$msg .="<th align='center' bgColor='#666666'><font color='#FFF'>CPF</th>";
	$msg .="<th align='center' bgColor='#666666'><font color='#FFF'>Sexo</th>";
	$msg .="<th align='center' bgColor='#666666'><font color='#FFF'>Telefone</th>";
	$msg .="<th align='center' bgColor='#666666'><font color='#FFF'>Celular</th>";
	$msg .="<th align='center' bgColor='#666666'><font color='#FFF'>Recados</th>";
	$msg .="<th align='center' bgColor='#666666'><font color='#FFF'>Email</th>";
	$msg .="</tr>";
	$msg .="</thead>";
	$msg .="<tbody>";
				
				
	//resgata os dados na tabela
	if(count($sql_query)){
	foreach ($sql_query as $res) {

		if ($res['tipo']=='F') $rtipo = "Pessoa fisica";
        if ($res['tipo']=='J') $rtipo = "Pessoa juridica";
        if ($res['tipo']=='S') $rtipo = "Servidor Publico";

        if ($res['sexo']=='M') $rsexo = "Masculino";
        if ($res['sexo']=='F') $rsexo = "Feminino";

	$msg .="<tr>";
	$msg .="<td width='220' align='center' valign='middle' bgColor='#DDDDDD'>".$res['nome']."</td>";
	$msg .="<td width='120' align='center' valign='middle' bgColor='#DDDDDD'>".$rtipo."</td>";
	$msg .="<td width='120' align='center' valign='middle' bgColor='#DDDDDD'>".$res['cpf']."</td>";
	$msg .="<td width='120' align='center' valign='middle' bgColor='#DDDDDD'>".$rsexo."</td>";
	$msg .="<td width='120' align='center' valign='middle' bgColor='#DDDDDD'>".$res['tel']."</td>";
	$msg .="<td width='120' align='center' valign='middle' bgColor='#DDDDDD'>".$res['cel']."</td>";
	$msg .="<td width='120' align='center' valign='middle' bgColor='#DDDDDD'>".$res['rec']."</td>";
	$msg .="<td width='220' align='center' valign='middle' bgColor='#DDDDDD'>".$res['email']."</td>";
	$msg .="</tr>";

	}	
	}else{
		$msg = "";
		$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="</tbody>";
	$msg .="</table>";
	$msg .="</div>";
	$msg .="</div>";
	//retorna a msg concatenada
	echo $msg;
?>
</body>
</html>
