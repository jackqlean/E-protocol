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

function inserir_arquivos($link){

global $cod, $nome_final;
// Executa a instrução SQL para inserir registros
// O campo código como é chave primária e está marcado na tabela como AUTO_INCREMENT não necessita passar um valor
$sql = "INSERT INTO itens_arq (cod_proc , arquivo) VALUES ('$cod', '$nome_final')";

		if (mysqli_query($link, $sql)) {

		echo "<script language='javascript'>alert('Arquivo inserido com sucesso...!')</script>";

		echo "<script>location.href='../frm/exibir_proc.php'</script>";

		} else {
		    echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}
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
	
	if ($proc_tipo=='PI') $ptipo = "Processo Interno";
	if ($proc_tipo=='PE') $ptipo = "Processo Externo";
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

function update_ob($link){

global $cod, $tipo, $titulo;

$sql = "UPDATE `ob` SET  `tipo` = '".$tipo."', `titulo` = '".$titulo."' WHERE `cod` = ".$cod."";

		if (mysqli_query($link, $sql)) {
    
   			echo "<script language='javascript'>alert('Registro alterado com sucesso...!')</script>";				
			
			echo "<script language='javascript'>window.location.href='/prot/op/listar_ob.php?p=1&cod=$cod'</script>";
			    
		} else {
    echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

}

function update_proc($link){

global $cod, $tipo, $assunto, $descricao, $setor;

$sql = "UPDATE `proc` SET `tipo` = '".$tipo."', `assunto` = '".$assunto."', `descricao` = '".$descricao."',`setor` = '".$setor."' WHERE `cod` = ".$cod."";

	if (mysqli_query($link, $sql)) {
    
    	echo "<script language='javascript'>alert('Registro alterado com sucesso...!')</script>";				

		echo "<script language='javascript'>window.location.href='/prot/op/listar_proc.php?p=1'</script>";

    
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

	echo "<script language='javascript'>window.location.href='/prot/op/listar_req.php?p=1'</script>";
    
		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

}

function insert_ob($link){

	$sql = "INSERT INTO ob (tipo, titulo) VALUES('".$_POST["txtTipo"]."','".$_POST["txtTitulo"]."')";
		if (mysqli_query($link, $sql)) {
		
		echo "<script language='javascript'>alert('Registro cadastrado com sucesso...!')</script>";				

		echo "<script>location.href='../op/listar_ob.php?p=1&cod='</script>";
   
		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

}

function insert_proc($link){

global $cod;

// VARIAVEIS PARA ARMAZENAR A HORA E DATA ATUAIS DO SISTEMA
    $data = date('Y-m-d', time());
    $horas = date('H:i:s', time());

$sql = "INSERT INTO proc (tipo, assunto, descricao ,setor, cod_req,data,horas) VALUES('".$_POST["txtTipo"]."','".$_POST["txtAssunto"]."','".$_POST["txtDescricao"]."','".$_POST["txtSetor"]."','".$cod."','".$data."','".$horas."')";
		
		if (mysqli_query($link, $sql)) {
    
		echo "<script language='javascript'>alert('Registro cadastrado com sucesso...!')</script>";	

		echo "<script>location.href='../frm/exibir_proc.php'</script>";

		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

}

function insert_req($link){

	$sql = "INSERT INTO req (nome, tipo,cpf,sexo,tel,cel,rec,email) VALUES('".$_POST["txtNome"]."','".$_POST["txtTipo"]."','".$_POST["txtCpf"]."','".$_POST["txtSexo"]."','".$_POST["txtTel"]."','".$_POST["txtCel"]."','".$_POST["txtRec"]."','".$_POST["txtEmail"]."')";
		if (mysqli_query($link, $sql)) {
    
    	echo "<script language='javascript'>alert('Registro cadastrado com sucesso...!')</script>";	

    	echo "<script>location.href='../op/pesquisar_req.php?p=1'</script>";

   		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}
}

function insert_setor($link){

$sql = "INSERT INTO setor (setor) VALUES('".$_POST["txtSetor"]."')";
		
		if (mysqli_query($link, $sql)) {
    
		echo "<script language='javascript'>alert('Registro cadastrado com sucesso...!')</script>";

		echo "<script>location.href='../index.php'</script>";	
   
		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}
}

function deleta_ob($link){

global $cod;

$sql = "DELETE FROM ob WHERE cod = '$cod'";
	if (mysqli_query($link, $sql)) {
    
    //confirmar exclusão de dados

    	echo "<script language='javascript'>alert('Requerente excluído com sucesso...!')</script>";				

		echo "<script language='javascript'>window.location.href='/prot/op/listar_ob.php?p=1&cod=$cod'</script>";

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

		echo "<script language='javascript'>window.location.href='/prot/op/listar_proc.php?p=1'</script>";

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

		echo "<script language='javascript'>window.location.href='/prot/op/pesquisar_req.php?p=1'</script>";

    	} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}
}

function encaminhar_proc($link){

//global $cod;

// VARIAVEIS PARA ARMAZENAR A HORA E DATA ATUAIS DO SISTEMA
    $data = date('Y-m-d', time());
    $horas = date('H:i:s', time());

$sql = "INSERT INTO encaminhamento (cod_prenc, cod_rqenc,cod_stdst,data_env, horas_env, obs) VALUES('".$_POST["cod_eProc"]."','".$_POST["cod_eReq"]."','".$_POST["txtStdst"]."','".$data."','".$horas."','".$_POST["txtObservacao"]."')";
		
		if (mysqli_query($link, $sql)) {
    
		echo "<script language='javascript'>alert('Registro encaminhado com sucesso...!')</script>";	

		echo "<script>location.href='../navegacao.php'</script>";

		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}
}

function receber_proc($link){

global $cod,$status;

// VARIAVEIS PARA ARMAZENAR A HORA E DATA ATUAIS DO SISTEMA
    $data = date('Y-m-d', time());
    $horas = date('H:i:s', time());

    $sql = "UPDATE `encaminhamento` SET `data_rec` = '".$data."', `horas_rec` = '".$horas."', `status` = '".$status."' WHERE `cod` = ".$cod."";

	if (mysqli_query($link, $sql)) {
    
		echo "<script language='javascript'>alert('Registro recebido com sucesso...!')</script>";	

		echo "<script>location.href='../navegacao.php'</script>";

		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}
}

?>