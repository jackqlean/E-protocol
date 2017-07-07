<?php
/**
 * Conecta com o MySQL usando PDO
 */
function db_connect()
{
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
 
    return $PDO;
}
/**
 * Cria o hash da senha, usando MD5 e SHA-1
 */
function make_hash($str)
{
    return sha1(md5($str));
}
 
 
/**
 * Verifica se o usuário está logado
 */
function isLoggedIn()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
    {
        return false;
    }
 
    return true;
}

function utf8_strtr($str, $from, $to) {
    $keys = array();
    $values = array();
    preg_match_all('/./u', $from, $keys);
    preg_match_all('/./u', $to, $values);
    $mapping = array_combine($keys[0], $values[0]);
    return strtr($str, $mapping);
}

function consultaProcesso($link){
	
	global $cod;
	global $ptipo;
	
	$sql_query = mysqli_query($link,"SELECT p.cod , p.tipo, p.assunto ,p.descricao, DATE_FORMAT(p.data,'%d/%m/%Y') AS data, p.horas FROM proc p WHERE p.cod ='".$cod."'");

	$ARRAY_PROCESSO = [];
	$array = mysqli_fetch_array($sql_query);

	$ARRAY_PROCESSO[0] = $array["cod"];
	$proc_tipo = $array["tipo"];
	$ARRAY_PROCESSO[2] = $array["assunto"];
	$ARRAY_PROCESSO[3] = $array["descricao"];
	
	if ($proc_tipo=='PI') $ptipo = "Protocolo Interno";
	if ($proc_tipo=='PE') $ptipo = "Protocolo Externo";
	if ($proc_tipo=='OT') $ptipo = "Outros";

	$ARRAY_PROCESSO[1] = $ptipo;
	
	return $ARRAY_PROCESSO;
}

function consultaNome($link){

	global $cod;

	$sql_query = mysqli_query($link,"SELECT p.*, r.nome , r.tipo, r.cpf, r.sexo, r.tel, r.cel, r.rec, r.email FROM proc p , req r WHERE p.cod_req = r.cod AND p.cod = '".$cod."'");
	
	$ARRAY_REQ = [];
	
	$array = mysqli_fetch_array($sql_query);

	$ARRAY_REQ[0] = $array["nome"];
	$req_tipo = $array["tipo"];
	$ARRAY_REQ[2] = $array["cpf"];
	$req_sexo = $array["sexo"];
	$ARRAY_REQ[4] = $array["tel"];
	$ARRAY_REQ[5] = $array["cel"];
	$ARRAY_REQ[6] = $array["rec"];
	$ARRAY_REQ[7] = $array["email"];

	if ($req_tipo=='F') $rtipo = "Pessoa fisica";
	if ($req_tipo=='J') $rtipo = "Pessoa juridica";
	if ($req_tipo=='S') $rtipo = "Servidor Publico";

	if ($req_sexo=='M') $rsexo = "Masculino";
	if ($req_sexo=='F') $rsexo = "Feminino";
	
	$ARRAY_REQ[1] = $rtipo;
	$ARRAY_REQ[3] = $rsexo;
	return $ARRAY_REQ;
}

function desconecta($link){
	mysqli_close($link);
}

function update_proc($link){

global $cod;

$sql = "UPDATE `proc` SET `tipo` = '".$_POST["txtTipo"]."', `assunto` = '".$_POST["txtAssunto"]."', `descricao` = '".$_POST["txtDescricao"]."',`setor` = '".$_POST["txtSetor"]."' WHERE `cod` = ".$cod."";

	if (mysqli_query($link, $sql)) {
    
    	echo "<script language='javascript'>alert('Registro alterado com sucesso...!')</script>";				

		echo "<script language='javascript'>window.location.href='../navegacao.php'</script>";

    
			} else {
    		echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

}

function update_req($link){

global $cod, $nome, $tipo, $cpf, $sexo, $tel, $cel, $rec, $email;

$sql = "UPDATE `req` SET `nome` = '".$nome."', `tipo` = '".$tipo."', `cpf` = '".$cpf."', `sexo` = '".$sexo."',`tel` = '".$tel."',`cel` = '".$cel."',
`rec` = '".$rec."', `email` = '".$email."' WHERE `cod` = ".$cod."";

	if (mysqli_query($link, $sql)) {
    
    echo "<script language='javascript'>alert('Registro alterado com sucesso...!')</script>";				

	echo "<script language='javascript'>window.location.href='../navegacao.php'</script>";
    
		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

}

function deleta_proc($link){

global $cod;

$sql = "DELETE FROM proc WHERE cod = '$cod'";
	
		if (mysqli_query($link, $sql)) {
    
		//confirmar exclusão de dados 

		echo "<script language='javascript'>alert('Processo excluído com sucesso...!')</script>";				

		echo "<script language='javascript'>window.location.href='../navegacao.php'</script>";

    	} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

}

function deleta_req($link){

global $cod;

$sql = "DELETE FROM req WHERE cod = '$cod'";
		if (mysqli_query($link, $sql)) {
    	//confirmar exclusão de dados 

		echo "<script language='javascript'>alert('Requerente excluído com sucesso...!')</script>";				

		echo "<script language='javascript'>window.location.href='../navegacao.php'</script>";

    	} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}
}
?>
