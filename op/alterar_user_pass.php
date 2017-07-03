<?php
session_start();
require_once "check.php";
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
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
// =====================================

require_once "../config/init.php";
//require_once "../config/functions.php";

// resgata variáveis do formulário
$name = isset($_POST['txt_login']) ? $_POST['txt_login'] : '';
$passwordA = isset($_POST['txtSenhaA']) ? $_POST['txtSenhaA'] : '';

$passwordN = isset($_POST['txtSenhaN']) ? $_POST['txtSenhaN'] : '';

// cria o hash da senha
$senhaA = make_hash($passwordA);
$senhaN = make_hash($passwordN);

// recupera o id do usuário
$user_id = $_SESSION['user_id'];

$sql = "SELECT u.password FROM users u WHERE u.id = '".$user_id."'";

$r = mysqli_query($link,$sql) or die(mysql_error());
$row = mysqli_fetch_row($r);

if($row[0] == $senhaA){
    $sql2 = "UPDATE users SET `name` = '".$name."', `password` = '".$senhaN."' WHERE id = '".$user_id."'";
    
    mysqli_query($link,$sql2);
    
    echo"<script>
$(document).ready(function () {
swal({
  type: 'success',
  title: 'Usuario e/ou senha alterado com sucesso.',
  text: '',
  timer: 4000
}).then(
  function () {},
  // handling the promise rejection
  function (dismiss) {
    if (dismiss === 'timer') {
      window.location.href='../navegacao.php'
    }
  }
)
});
</script>";
} else {
       
        echo"<script>
$(document).ready(function () {
swal({
  type: 'error',
  title: 'Ocorreu um erro na alteração do registro.,
  text: '',
  timer: 4000
}).then(
  function () {},
  // handling the promise rejection
  function (dismiss) {
    if (dismiss === 'timer') {
      window.location.href='../frm/alteracao_user_pass.php'
    }
  }
)
});
</script>";
        //echo "Erro: " . $sql . "<br>" . mysqli_error($link);
}

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);
?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
   </body>
</html>