<?php
function consultaProcesso($link){
	
	global $cod;
	global $ptipo;
	
	$sql_query = mysqli_query($link,"SELECT p.cod , p.tipo, p.assunto , DATE_FORMAT(p.data,'%d/%m/%Y') AS data, p.horas FROM proc p WHERE p.cod ='".$cod."'");

	$ARRAY_PROCESSO = [];
	$array = mysqli_fetch_array($sql_query);

	$ARRAY_PROCESSO[0] = $array["cod"];
	$proc_tipo = $array["tipo"];
	$ARRAY_PROCESSO[2] = $array["assunto"];
	$ARRAY_PROCESSO[3] = $array["data"];
	$ARRAY_PROCESSO[4] = $array["horas"];

	if ($proc_tipo=='PI') $ptipo = "Processo Interno";
	if ($proc_tipo=='PE') $ptipo = "Processo Externo";
	if ($proc_tipo=='OT') $ptipo = "Outros";

	$ARRAY_PROCESSO[1] = $ptipo;
	
	return $ARRAY_PROCESSO;
}

function consultaSetor($link){

	global $cod;

	$sql_query = mysqli_query($link,"SELECT s.setor FROM proc p, setor s WHERE p.setor = s.cod_setor AND p.cod = '".$cod."'");
	//while($array = mysqli_fetch_array($sql_query)) {
	//	$st_setor = $array["setor"];
	//}	

	// O retorno da função while está jogando a mesma informação várias vezes sem necessidade, pode retirar o while, assim executa uma única vez
	// Se for usar while deve usar um array para receber as informação diferentes
	// While serve também para verificar se está recebendo alguma informação, neste exemplo se não retornar nada na consulta pode ocorrer de erros
	$array = mysqli_fetch_array($sql_query);
	return $array["setor"];
	
}

function consultaNome($link){

	global $cod;

	$sql_query = mysqli_query($link,"SELECT p.*, r.nome , r.tipo, r.cpf, r.sexo, r.tel, r.cel, r.rec, r.email FROM proc p , req r WHERE p.cod_req = r.cod AND p.cod = '".$cod."'");
	$array = mysqli_fetch_array($sql_query);
	return $array["nome"];	

}

function desconecta($link){
	mysqli_close($link);
}

?>