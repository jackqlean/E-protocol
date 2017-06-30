<?php
session_start();
require_once "check.php";
?>
<?php
	require_once ("../config/init.php");
	$registro = mysqli_query($link,"SELECT * FROM req");
	
	$tabela = "";
	while($row = mysqli_fetch_array($registro)){		
		if ($row['tipo']=='F') $rtipo = "Pessoa física";
        if ($row['tipo']=='J') $rtipo = "Pessoa jurídica";
        if ($row['tipo']=='S') $rtipo = "Servidor público";

        if ($row['sexo']=='M') $rsexo = "Masculino";
        if ($row['sexo']=='F') $rsexo = "Feminino";

		$selecionar = '<a href=\"cadastro_proc.php?cod='.$row['cod'].'\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Seleciona requerente\" class=\"btn btn-success\"><i class=\"fa fa-check-circle-o\" aria-hidden=\"true\"></i></a>';
		
		/*$eliminar = '<a href=\"actionDelete.php?cod='.$row['cod'].'\" onclick=\"return confirm(\'¿Seguro que desea eliminiar este usuario?\')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Eliminar\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';*/
		
		$tabela.='{
				  "nome":"'.$row['nome'].'",
				  "tipo":"'.$rtipo.'",
				  "cpf":"'.$row['cpf'].'",
				  "sexo":"'.$rsexo.'",
				  "telefone":"'.$row['tel'].'",
				  "celular":"'.$row['cel'].'",
				  "recados":"'.$row['rec'].'",
				  "email":"'.$row['email'].'",
				  "ações":"'.$selecionar.'"
				},';		
	}	

	$tabela = substr($tabela,0, strlen($tabela) - 1);

	echo '{"data":['.$tabela.']}';	

?>