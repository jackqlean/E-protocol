<?php
// inclui o arquivo de inicialização
require_once"../config/init.php";
require "../config/functions.php"; 
// resgata variáveis do formulário
  $name=$_POST['login']; //Pegando dados passados por AJAX
  $senha=$_POST['senha'];
 
// cria o hash da senha
$passwordHash = make_hash($senha);
 
$PDO = db_connect();
 
$sql = "SELECT id, name, s.setor AS setor FROM users, setor s WHERE users.cod_setor = s.cod_setor AND name = :name AND password = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':name', $name);
$stmt->bindParam(':password', $passwordHash);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0){
  echo 0;
  exit;
}
echo 1;
// pega o primeiro usuário
$user = $users[0];
 
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_setor'] = $user['setor'];
//header('Location: ../index.php');
?>
