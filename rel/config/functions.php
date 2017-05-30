<?php
function consultaProcRelat($link){
	
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

function consultaSetorRelat($link){

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
function consultaNomeRelat($link){

	global $cod;

	$sql_query = mysqli_query($link,"SELECT p.*, r.nome , r.tipo, r.cpf, r.sexo, r.tel, r.cel, r.rec, r.email FROM proc p , req r WHERE p.cod_req = r.cod AND p.cod = '".$cod."'");
	$array = mysqli_fetch_array($sql_query);
	return $array["nome"];	

}

function consultaDetalhes_Proc_Env($link){
	global $cod;
	global $ptipo;

	$sql_query = mysqli_query($link,"SELECT p.cod , r.nome, p.tipo, p.assunto ,p.descricao AS descricao, u.name AS usuario_env , s.setor AS setor_env, DATE_FORMAT(e.data_env,'%d/%m/%Y') AS data_env, e.horas_env AS horas_env FROM proc p, req r, setor s, users u, encaminhamento e 
	WHERE  r.cod = p.cod_req AND e.user_env = u.id AND e.cod_stenv = s.cod_setor AND e.cod_prenc = p.cod AND p.cod ='".$cod."'");

	$ARRAY_PROCESSO_ENV = [];
	$array = mysqli_fetch_array($sql_query);

	$ARRAY_PROCESSO_ENV[0] = $array["cod"];
	$proc_tipo = $array["tipo"];
	$ARRAY_PROCESSO_ENV[1] = $array["nome"];
	$ARRAY_PROCESSO_ENV[2] = $array["assunto"];
    $ARRAY_PROCESSO_ENV[3] = $array["usuario_env"];
	$ARRAY_PROCESSO_ENV[4] = $array["data_env"];
	$ARRAY_PROCESSO_ENV[5] = $array["horas_env"];
	$ARRAY_PROCESSO_ENV[6] = $array["setor_env"];
	$ARRAY_PROCESSO_ENV[8] = $array["descricao"];

	if ($proc_tipo=='PI') $ptipo = "Processo Interno";
	if ($proc_tipo=='PE') $ptipo = "Processo Externo";
	if ($proc_tipo=='OT') $ptipo = "Outros";
 	
 	$ARRAY_PROCESSO_ENV[7] = $ptipo;
	
	return $ARRAY_PROCESSO_ENV;
}

function consultaDetalhes_Proc_Rec($link){
	global $cod;

	$sql2_query = mysqli_query($link,"SELECT p.cod , u.name AS usuario_rec , s.setor AS setor_dst , DATE_FORMAT(e.data_rec,'%d/%m/%Y') AS data_rec , e.horas_rec AS horas_rec FROM proc p, setor s, users u, encaminhamento e 
	WHERE e.user_rec = u.id AND e.cod_stdst = s.cod_setor AND e.cod_prenc = p.cod AND p.cod ='".$cod."'");

	$ARRAY_PROCESSO_REC = [];
	$array2 = mysqli_fetch_array($sql2_query);

	$ARRAY_PROCESSO_REC[0] = $array2["usuario_rec"];
	$ARRAY_PROCESSO_REC[1] = $array2["setor_dst"];
	$ARRAY_PROCESSO_REC[2] = $array2["data_rec"];
	$ARRAY_PROCESSO_REC[3] = $array2["horas_rec"];
	return $ARRAY_PROCESSO_REC;
}

?>