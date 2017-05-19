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

$cod = $_GET["cod"];

require_once "../config/init.php";
require_once "../config/functions.php";

receber_proc($link);

// Fecha a conexão com o servidor para poupar recursos de processamento
desconecta($link);

?>
