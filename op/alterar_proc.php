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

/*require_once "../config/init.php";
require_once "../config/functions.php";*/


$cod = $_GET["cod"];

$tipo = $_POST['txtTipo'];
$assunto = $_POST['txtAssunto'];
$descricao = $_POST['txtDescricao'];
$setor = $_POST['txtSetor'];
// Executa a instrução SQL para alterar registros
// O campo código como é chave primária e está marcado na tabela como AUTO_INCREMENT não necessita passar um valor

update_proc($link);

// Fecha a conexão com o servidor para poupar recursos de processamento
desconecta($link);

?>

