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

$nome = $_POST['txtNome'];
$tipo = $_POST['txtTipo'];
$cpf = $_POST['txtCpf'];
$sexo = $_POST['txtSexo'];
$tel = $_POST['txtTel'];
$cel = $_POST['txtCel'];
$rec = $_POST['txtRec'];
$email = $_POST['txtEmail'];

// Executa a instrução SQL para alterar registros
// O campo código como é chave primária e está marcado na tabela como AUTO_INCREMENT não necessita passar um valor

update_req($link);

// Fecha a conexão com o servidor para poupar recursos de processamento
desconecta($link);

?>

