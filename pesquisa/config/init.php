<?php
header('Content-Type: text/html; charset=utf-8');
// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
$link = mysqli_connect("localhost", "root", "") or die("Erro de conexão, verifique o endereço, usuário e senha");
// Seleciona a base de dados
mysqli_select_db($link, "prot");
mysqli_query($link,"SET NAMES 'utf8'");
mysqli_query($link,'SET character_set_connection=utf8');
mysqli_query($link,'SET character_set_client=utf8');
mysqli_query($link,'SET character_set_results=utf8');
?>