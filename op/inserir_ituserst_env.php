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

require_once "../config/init.php";
require_once "../config/functions.php";

$cod = $_GET["cod"];

$sql_query = mysqli_query($link,"SELECT e.cod AS e_cod, e.user_env , e.cod_stenv, p.cod FROM encaminhamento e, proc p WHERE p.cod = '$cod' ORDER BY e.cod DESC ;");

$array = mysqli_fetch_array($sql_query);
$cod_enc = $array["e_cod"];
$cod_user_env = $array["user_env"];
$cod_stenv = $array["cod_stenv"];

// Executa a instrução SQL para inserir registros
// O campo código como é chave primária e está marcado na tabela como AUTO_INCREMENT não necessita passar um valor

encaminhar_itens_user_env_proc($link);

encaminhar_itens_setor_env_proc($link);
// Fecha a conexão com o servidor para poupar recursos de processamento
desconecta($link);

echo "<script>location.href='../navegacao.php'</script>";	

?>
