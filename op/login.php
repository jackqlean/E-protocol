<?php
// inclui o arquivo de inicialização
require_once"../config/init.php";
require "../config/functions.php"; 
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

<script src="../lib/jquery/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="../lib/animate/animate.min.css">
<script src="../lib/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="../lib/sweetalert2/dist/sweetalert2.min.css">
<script src="../lib/core-js/core.js"></script>
</head>
<body>
  
<?php
// resgata variáveis do formulário
$name = isset($_POST['txt_login']) ? $_POST['txt_login'] : '';
$password = isset($_POST['txt_password']) ? $_POST['txt_password'] : '';
 
if (empty($name))
{
echo"<script>
$(document).ready(function () {
  swal({
  type: 'info',
  title: 'Informe o seu usuário e senha para continuar',
  text: 'a janela irá fechar em 4 segundos.',
  timer: 4000
}).then(
  function () {},
  // handling the promise rejection
  function (dismiss) {
    if (dismiss === 'timer') {
      window.location.href='../frm/form-login.php'
    }
  }
)
});
</script>";
    exit;
}
 
// cria o hash da senha
$passwordHash = make_hash($password);
 
$PDO = db_connect();
 
$sql = "SELECT id, name, s.setor AS setor FROM users, setor s WHERE users.cod_setor = s.cod_setor AND name = :name AND password = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':name', $name);
$stmt->bindParam(':password', $passwordHash);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0)

{
echo"<script>
$(document).ready(function () {
swal({
  type: 'info',
  title: 'Usuário ou senha inválido',
  text: 'a janela irá fechar em 4 segundos.',
  timer: 4000
}).then(
  function () {},
  // handling the promise rejection
  function (dismiss) {
    if (dismiss === 'timer') {
      window.location.href='../frm/form-login.php'
    }
  }
)
});
</script>";
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
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->  
   </body>
</html>