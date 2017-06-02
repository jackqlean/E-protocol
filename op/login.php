<?php
// inclui o arquivo de inicialização
require_once"../config/init.php";
require "../config/functions.php"; 

// resgata variáveis do formulário
$email = isset($_POST['txt_login']) ? $_POST['txt_login'] : '';
$password = isset($_POST['txt_password']) ? $_POST['txt_password'] : '';
 
if (empty($email) || empty($password))
{
    echo "Informe email e senha";
    exit;
}
 
// cria o hash da senha
$passwordHash = make_hash($password);
 
$PDO = db_connect();
 
$sql = "SELECT id, name, s.setor AS setor FROM users, setor s WHERE users.cod_setor = s.cod_setor AND email = :email AND password = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $passwordHash);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0)
{
    echo "Email ou senha incorretos";
    exit;
}
 
// pega o primeiro usuário
$user = $users[0];
 
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_setor'] = $user['setor'];

header('Location: ../index.php');

?>