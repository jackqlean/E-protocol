<?php
// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
$link = mysqli_connect("localhost", "root", "") or die("Erro de conexão, verifique o endereço, usuário e senha");
// Seleciona a base de dados
mysqli_select_db($link, "prot");
mysqli_query($link,"SET NAMES 'utf8'");
mysqli_query($link,'SET character_set_connection=utf8');
mysqli_query($link,'SET character_set_client=utf8');
mysqli_query($link,'SET character_set_results=utf8');

// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'prot');
?>