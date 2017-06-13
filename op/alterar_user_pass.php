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
<link href="../lib/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="../lib/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href="../lib/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
<script src="../lib/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
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
$senha = mysqli_fetch_row($r);

if($senha[0] == $senhaA){
    $sql2 = "UPDATE users SET `password` = '".$senhaN."' WHERE id = '".$user_id."'";
    
    mysqli_query($link,$sql2);
    
    echo "<script>
        $(document).ready(function () {
        BootstrapDialog.show({
            title: 'Informação do sistema',
            message: 'Usuario e/ou senha alterado com sucesso. Pressione Enter para continuar...',
            onshow: function(dialog) {
                dialog.getButton('button-ok').enable();
            },
            buttons: [{
                id: 'button-ok',
                label: 'Ok',
                hotkey: 13,
                cssClass: 'btn-primary',
                action: function(){
                     window.location.href='../navegacao.php'
                }
            }]
        });
       });
</script>"; 
} else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($link);
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